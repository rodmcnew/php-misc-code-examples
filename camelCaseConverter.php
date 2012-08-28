<?php

/*
 * Converts CamelCase to lower-case-hyphens
 *
 * @param string $value the value to convert
 *
 * @return string
 */
function camelToHyphens($value)
{
    return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $value));
}

/*
 * Converts lower-case-hyphens to CamelCase
 *
 * @param string $value the value to convert
 *
 * @return string
 */
function hyphensToCamel($value){
    return preg_replace("/\-(.)/e", "strtoupper('\\1')", $value);
}
