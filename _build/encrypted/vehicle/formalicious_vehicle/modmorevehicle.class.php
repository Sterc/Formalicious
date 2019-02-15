<?php
/**
 * @var modX $modx
 */

/**
 * Class modmoreVehicle
 */
class modmoreVehicle extends xPDOObjectVehicle {
    const VERSION = '1.0.0';

    public $class = 'modmoreVehicle';

    /**
     * Put a representation of a MYSQL table and it's data into this vehicle.
     *
     * @param xPDOTransport $transport The transport package hosting the vehicle.
     * @param mixed &$object A reference to the artifact this vehicle will represent.
     * @param array $attributes Additional attributes represented in the vehicle.
     */
    public function put(& $transport, & $object, $attributes = array ()) {
        parent :: put($transport, $object, $attributes);

        $this->payload['object_encrypted'] = $this->encode($this->payload['object']);
        unset ($this->payload['object']);

        if (isset($this->payload['related_objects'])) {
            $this->payload['related_objects_encrypted'] = $this->encode($this->payload['related_objects']);
            unset ($this->payload['related_objects']);
        }
    }

    /**
     * @param $data
     * @return string
     */
    public function encode($data) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $cipher = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, MODMORE_VEHICLE_PRIVATE_KEY, serialize($data), MCRYPT_MODE_CBC, $iv);
        $cipher = $iv . $cipher;
        return base64_encode($cipher);
    }

    /**
     * Install the vehicle artifact into a transport host.
     *
     * @param xPDOTransport &$transport A reference to the transport.
     * @param array $options An array of options for altering the installation
     * of the artifact.
     *
     * @return boolean True if the installation of the vehicle artifact was
     * successful.
     */
    public function install(& $transport, $options) {
        if (!$this->decodePayloads($transport, 'install')) {
            return false;
        }
        return parent::install($transport, $options);
    }

    /**
     * This vehicle implementation does not support uninstall.
     *
     * @param xPDOTransport &$transport A reference to the transport.
     * @param array $options An array of options for altering the uninstallation of the artifact.
     * @return boolean True, always.
     */
    public function uninstall(& $transport, $options) {
        if (!$this->decodePayloads($transport, 'uninstall')) {
            return false;
        }
        return parent::uninstall($transport, $options);
    }


    /**
     * @param xPDOTransport $transport
     * @param string $endpoint
     *
     * @return bool
     */
    public function decodePayloads(xPDOTransport &$transport, $endpoint = 'install')
    {
        $transport->xpdo->log(xPDO::LOG_LEVEL_INFO, 'Decoding package information...');
        $publicKeyFile = MODX_CORE_PATH . 'components/' . $this->payload['namespace'] . '/.pubkey';
        $publicKey = file_exists($publicKeyFile) ? file_get_contents($publicKeyFile) : $this->payload['modmore_public_key'];
        $params = array(
          'public_key' => $publicKey,
          'package' => $this->payload['modmore_package'],
          'object' => urlencode($this->payload['object_encrypted']),
          'related_objects' => (isset($this->payload['related_objects_encrypted'])) ? urlencode($this->payload['related_objects_encrypted']) : '',
          'vehicle_version' => self::VERSION,
        );

        $package = $transport->xpdo->getObject('transport.modTransportPackage', array(
          'signature' => $transport->signature
        ));
        if ($package instanceof modTransportPackage) {
            $provider = $package->getOne('Provider');
            if ($provider instanceof modTransportProvider) {
                /**
                 * @var modRestResponse $response
                 */
                $provider->xpdo->setOption('contentType', 'default');
                $response = $provider->request('package/decode/' . $endpoint, 'POST', $params);
                if ($response->isError()) {
                    $msg = $response->getError();
                    $transport->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Error decoding encrypted data: ' . $msg);

                    return false;
                }

                $data = $response->toXml();
                if (isset($data->object)) {
                    $object = (string)$data->object;
                    $object = base64_decode($object);
                    $object = unserialize($object);
                    $this->payload['object'] = $object;
                } else {
                    $transport->xpdo->log(xPDO::LOG_LEVEL_ERROR,
                      'Decode result did not include the object to install. Please try to install again, and contact support@modmore.com if the problem persists.');

                    return false;
                }
                if (isset($data->related_objects)) {
                    $relatedObjects = (string)$data->related_objects;
                    $relatedObjects = base64_decode($relatedObjects);
                    $relatedObjects = unserialize($relatedObjects);
                    $this->payload['related_objects'] = $relatedObjects;
                }

                return true;

            } else {
                $transport->xpdo->log(xPDO::LOG_LEVEL_ERROR,
                  'Could not find the provider for this package. Please make sure this package was installed with the modmore.com package provider and contact support@modmore.com if you need assistance.');

                return false;
            }
        } else {
            $transport->xpdo->log(xPDO::LOG_LEVEL_ERROR,
              'Could not find the package object for ' . $transport->signature . '.');

            return false;
        }
    }
}