#! /usr/bin/php
<?php
/**
 * Active mailboxes by send a mail with it
 *
 * @copyright   Copyright 2007-2014 Fwolf
 * @author      Fwolf <fwolf.aide+gist@gmail.com>
 * @license     http://opensource.org/licenses/mit-license MIT
 * @since       2007-03-30
 * @version     1.0
 */

use Fwlib\Bridge\PHPMailer;
use Fwlib\Config\GlobalConfig;

require __DIR__ . '/config.default.php';


$globalConfig = GlobalConfig::getInstance();

$toAddress = $globalConfig->get('mailActivate.to');
$mailProvider = $globalConfig->get('mailActivate.provider');

$mailer = new PHPMailer;


foreach ((array)$mailProvider as $provider) {
    $mailer->setHost($provider['host'], $provider['port']);

    foreach ((array)$provider['account'] as $account) {
        // Active mail also send to self
        $mailer->setTo($toAddress . '; ' . $account['name']);
        $mailer->setFrom($account['name']);
        $mailer->setAuth($account['user'], $account['pass']);
        $mailer->setSubject('Activate mail from ' . $account['name']);

        // Get random mail body
        $body = shell_exec('/home/fwolf/.mutt/signature');
        $body = substr($body, strpos($body, "\n"));
        $body = "$body

Send by mail-activate.php
https://gist.github.com/fwolf/8555621
";
        $mailer->setBody($body);

        $sendSuccess = $mailer->send();

        $sendTime = date('Y-m-d H:i:s');
        echo "[$sendTime] Send active mail for {$account['name']}, ";
        echo ($sendSuccess)
            ? 'Successful.'
            : 'Failed: ' . $mailer->getErrorMessage();
        echo "\n";

        sleep(3);
    }
}
