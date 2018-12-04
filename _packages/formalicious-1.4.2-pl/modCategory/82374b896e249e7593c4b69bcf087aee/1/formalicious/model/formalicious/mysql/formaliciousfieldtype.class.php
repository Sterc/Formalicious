<?php
/**
 * @package formalicious
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/formaliciousfieldtype.class.php');
class FormaliciousFieldType_mysql extends FormaliciousFieldType {}
?>