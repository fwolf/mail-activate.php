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

use Fwlib\Config\GlobalConfig;

// Detect root path
// If used as module, should be in parentRoot/modules/moduleName/ directory.
$pathToRoot = file_exists(__DIR__ . '/../../config.default.php')
    ? __DIR__ . '/../../'
    : __DIR__ . '/';


/** @noinspection PhpIncludeInspection */
{
    $classLoader = require $pathToRoot . 'vendor/autoload.php';


    $defaultConfig = require $pathToRoot . 'config.default.php';

    // Load user config if exists
    $userConfig = file_exists($pathToRoot . 'config.php')
        ? (require $pathToRoot . 'config.php')
        : [];
}

// Overwrite default config with user config, store in GlobalConfig
GlobalConfig::getInstance()->load(array_merge($defaultConfig, $userConfig));
