<?php
/*
 * SSO Test File
 */
$host = 'accounts.vaporweb.net';
$op_u = 'operator_username';
$op_p = 'operator_password';
include_once('includes/SSOConnector.php');

$sso = new SSO($op_u, $op_p, $host);
$sso->bind('ping');
$sso->execute();
var_dump($sso->response);
