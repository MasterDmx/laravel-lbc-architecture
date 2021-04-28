<?php

/**
 * Global functions initialization
 */

/**
 * Get the path to the app\App folder.
 *
 * @param  string  $path
 * @return string
 */
function lbc_app_path (string $path = ''): string
{
    return empty($path) ? app_path('App') : app_path('App' . DIRECTORY_SEPARATOR . $path);
}

/**
 * Get the path to the app\Domain folder.
 *
 * @param  string  $path
 * @return string
 */
function lbc_domain_path (string $path = ''): string
{
    return empty($path) ? app_path('Domain') : app_path('Domain' . DIRECTORY_SEPARATOR . $path);
}

/**
 * Get the path to the app\Support folder.
 *
 * @param  string  $path
 * @return string
 */
function lbc_support_path (string $path = ''): string
{
    return empty($path) ? app_path('Support') : app_path('Support' . DIRECTORY_SEPARATOR . $path);
}
