<?php
/*
	SSO Test page
*/
$host = 'accounts.vaporweb.net';
$op_u = 'api';
$op_pwd = 'Delta94162008aA';

include_once('includes/SSOConnector.php');
$sso = new SSO($op_u, $op_pwd, $host);

$sso->bind('ping');
$sso->execute();
var_dump($sso->response);

