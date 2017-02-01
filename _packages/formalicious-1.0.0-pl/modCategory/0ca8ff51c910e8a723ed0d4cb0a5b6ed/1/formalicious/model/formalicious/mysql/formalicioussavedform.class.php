<?php
/**
 * @package formalicious
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/formalicioussavedform.class.php');
class FormaliciousSavedForm_mysql extends FormaliciousSavedForm {}
?>