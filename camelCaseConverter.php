<?php

/*
 * Camel case conversion functions
 *
 * @author    Rod McNew <rodmcnew@gmail.com>
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/*
 * Converts camelCase to lower-case-hyphens
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
 * Converts lower-case-hyphens to camelCase
 *
 * @param string $value the value to convert
 *
 * @return string
 */
function hyphensToCamel($value){
    return preg_replace("/\-(.)/e", "strtoupper('\\1')", $value);
}
