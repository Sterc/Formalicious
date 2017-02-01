<?php
/**
 * @package formalicious
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/formaliciouscategory.class.php');
class FormaliciousCategory_mysql extends FormaliciousCategory {}
?>