<?php
/**
 * Bootstrap
 *
 *  - Register ClassLoader
 *  - Load default and user config
 *
 * @copyright   Copyright 2015 Fwolf
 * @license     http://opensource.org/licenses/MIT MIT
 */

// Detect root path
// If used as module, should be in parentRoot/modules/moduleName/ directory.
$pathToRoot = file_exists(__DIR__ . '/../../config.default.php')
    ? __DIR__ . '/../../'
    : __DIR__ . '/';


/** @noinspection PhpIncludeInspection */
$classLoader = require $pathToRoot . 'vendor/autoload.php';


/** @noinspection PhpIncludeInspection */
require $pathToRoot . 'config.default.php';
