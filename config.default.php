<?php
/**
 * Default configure file
 *
 * Save a copy as 'config.php' to set user config,  DO NOT remove the last
 * return statement.
 *
 * @copyright   Copyright 2014-2015 Fwolf
 * @license     http://opensource.org/licenses/mit-license MIT
 */

$config['lib.path.fwlib'] = 'fwlib/';
$config['lib.path.phpmailer'] = 'phpmailer/';


// Activate mail destination address
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

return $config;
