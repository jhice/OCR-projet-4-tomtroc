<?php

/**
 * helper functions
 */

/**
 * HTML escape (anti-XSS)
 */
function e(string $string) {
    return strip_tags($string);
}