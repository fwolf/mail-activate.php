<?php
/**
 * Default configure file
 *
 * @copyright   Copyright 2014, Fwolf
 * @author      Fwolf <fwolf.aide+gist@gmail.com>
 * @since       2014-01-22
 */


use Fwlib\Base\ClassLoader;
use Fwlib\Config\GlobalConfig;

if ('config.default.php' == basename(__FILE__)) {
    // Record running start time, usefull for count total process time cost,
    // as of PHP 5.4.0, $_SERVER['REQUEST_TIME_FLOAT'] is build-in.
    if (0 > version_compare(PHP_VERSION, '5.4.0')) {
        list($msec, $sec) = explode(' ', microtime(false));
        $_SERVER['REQUEST_TIME_FLOAT'] = $sec . substr($msec, 1);
    }


    // Init config data array
    $config = array();


    // Load user config if exists
    // If use as git submodule, commonly this is put in vendor/ directory,
    // will try to load config of parent repository.
    if (file_exists(__DIR__ . '/../../config.php')) {
        require __DIR__ . '/../../config.php';
    } elseif (file_exists(__DIR__ . '/config.php')) {
        require __DIR__ . '/config.php';
    }
    $userConfig = $config;
}


/***********************************************************
 * Config define area
 *
 * Use $configUser to compute value if needed.
 *
 * In config.php, code outside this area can be removed.
 **********************************************************/


$config['lib.path.fwlib'] = 'fwlib/';
$config['lib.path.phpmailer'] = 'phpmailer/';


// Activer mail destination address
$config['mailActivate.to'] = 'mailActivate_to@domain.com';

/* Config template for each mail account
$i = 0; $j = 0;
$config["mailActivate.provider.$i.host"] = 'smtp.domain1.com';
$config["mailActivate.provider.$i.port"] = 25;
$config["mailActivate.provider.$i.account.$j.name"] = 'user1@domain1.com';
$config["mailActivate.provider.$i.account.$j.user"] = 'user1';
$config["mailActivate.provider.$i.account.$j.pass"] = 'pass1';
$j ++;
$config["mailActivate.provider.$i.account.$j.name"] = 'user2@domain1.com';
$config["mailActivate.provider.$i.account.$j.user"] = 'user2';
$config["mailActivate.provider.$i.account.$j.pass"] = 'pass2';
$i ++; $j = 0;
$config["mailActivate.provider.$i.host"] = 'ssl://smtp.domain2.com';
$config["mailActivate.provider.$i.port"] = 465;
$config["mailActivate.provider.$i.account.$j.name"] = 'user1@domain2.com';
$config["mailActivate.provider.$i.account.$j.user"] = 'user1';
$config["mailActivate.provider.$i.account.$j.pass"] = 'pass1';
unset($i); unset($j;
*/


/***********************************************************
 * Config define area end
 **********************************************************/


if ('config.default.php' == basename(__FILE__)) {
    // Overwrite default config with user config
    $config = array_merge($config, $userConfig);

    // Include autoloader of Fwlib, need before other library
    require $config['lib.path.fwlib'] . 'autoload.php';

    // Deal with config, store in GlobalConfig instance
    GlobalConfig::getInstance()->load($config);


    // Register autoload of other external library, $classLoader is declared
    // in autoload.php of Fwlib, can use below.


    // PHPMailer, use its own autoloader
    require $config['lib.path.phpmailer'] . 'PHPMailerAutoload.php';
}
