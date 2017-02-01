<?php
/**
 * @package formalicious
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/formaliciousform.class.php');
class FormaliciousForm_mysql extends FormaliciousForm {}
?>