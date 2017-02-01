<?php
/**
 * @package formalicious
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/formaliciousfield.class.php');
class FormaliciousField_mysql extends FormaliciousField {}
?>