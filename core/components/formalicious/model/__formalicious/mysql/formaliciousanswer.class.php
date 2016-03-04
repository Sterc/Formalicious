<?php
/**
 * @package formalicious
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/formaliciousanswer.class.php');
class FormaliciousAnswer_mysql extends FormaliciousAnswer {}
?>