<?php
/**
 * FormaliciousGetSessionValue
 *
 * Snippet for getting specified field key from Formalicious session
 * Useful for when using $hook->setValue in a custom prehook in combination with Formalicious
 *
 * Example usage for getting a checkbox value:
 * [[!FormaliciousGetSessionValue?
 * &sessionkey=`[[!+sessionkey]]`
 * &field=`[[!+fieldname]]`
 * &value=`[[!+name]]`
 * &output=`checked="checked"`
 * ]]
 *
 * @var string $sessionkey
 * @var string $field
 * @var string $value
 * @var string $output
 * @var modX $modx
 *
 * @package formalicious
 */
if (isset($sessionkey, $field, $_SESSION[$sessionkey][$field])) {
    $input = $_SESSION[$sessionkey][$field];
}
// If value from session is equal to specified value, return output.
if (isset($input, $value, $output) && $input == $value) {
    return $output;
}
// By default, return empty.
return;