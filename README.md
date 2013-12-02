VW-SSO-API
==========

SSO Connector and example API files for use with the SSO server.
-----------------------------------------------------------------------
Instantiate:
	$sso = new SSO($operator_username, $operator_password, $host);
	(Uses port 1560 by default).
	
Run Command:
	$sso->bind('ping');
	$sso->execute();
	$results = $sso->response;
