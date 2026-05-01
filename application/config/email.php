<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol']    = 'smtp';
$config['smtp_host']   = 'marlota.co.uk';
$config['smtp_user']   = 'orders@marlota.co.uk';
$config['smtp_pass']   = 'Mancity.123';
$config['smtp_port']   = 465;
$config['smtp_timeout']= 30;

$config['mailtype']    = 'html';
$config['charset']     = 'utf-8';
$config['newline']     = "\r\n";
$config['crlf']        = "\r\n";
$config['wordwrap']    = TRUE;

$config['smtp_crypto'] = 'ssl'; // optional but safe
