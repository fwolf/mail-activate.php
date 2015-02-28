<?php
/**
 * Default configure file
 *
 * @copyright   Copyright 2014-2015 Fwolf
 * @license     http://opensource.org/licenses/mit-license MIT
 */

use Fwlib\Config\GlobalConfig;

if ('config.default.php' == basename(__FILE__)) {
    // Init config data array
    $config = array();


    // Load user config if exists
    if (file_exists($pathToRoot . 'config.php')) {
        /** @noinspection PhpIncludeInspection */
        require $pathToRoot . 'config.php';
    }
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

    // Deal with config, store in GlobalConfig instance
    GlobalConfig::getInstance()->load($config);
}
