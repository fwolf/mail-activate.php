#! /usr/bin/php
<?php
/**
 * Active all my mailbox by send a boring mail to it self
 *
 * @package		fwolfbin
 * @copyright	Copyright 2007-2008, Fwolf
 * @author		Fwolf <fwolf.aide+fwolfbin@gmail.com>
 * @since		2007-03-30
 * @version		$Id$
 */

define('P2R', dirname(__FILE__) . '/');
require_once(P2R . 'config.default.php');

require_once(FWOLFLIB . 'func/config.php');
require_once(FWOLFLIB . 'func/env.php');

// Address will active mail send to
$to = GetCfg('mail_activer.to');

// Mailboxes to active
// $mail[i]['mail']['name'] is also From address
$mail = GetCfg('mail_activer.account');

require_once(FWOLFLIB . 'class/mailsender.php');
$mailer = new Mailsender;
//$mailer->SMTPDebug = true;

//$mailer->SetTo($to);
foreach ($mail as $host)
{
	$mailer->SetHost($host['host'], $host['port']);
	foreach ($host['mail'] as $account)
	{
		// Active also mail to self
		$mailer->SetTo($to . ';' . $account['name']);
		$mailer->SetFrom($account['name']);
		$mailer->SetAuth($account['user'], $account['pass']);

		// Subject
		$mailer->SetSubject('Msg from ' . $account['name'] . ' .');

		// Get random mail body
		$b = shell_exec('/home/fwolf/.mutt/signature');
		$b = substr($b, strpos($b, "\n"));
		$mailer->SetBody($b);

		$rs = $mailer->Send();
		if (false == $rs)
			echo $mailer->mErrorMsg . "\n";
		$rs = ($rs) ? 'Successful' : 'Failed';
		$date = date('Y-m-d H:i:s');
		echo("[$date] $rs active mail for " . $account['name'] . " !\n");
		sleep(3);
	}
}
?>
