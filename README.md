VW-SSO-API
==========

SSO Connector and example API files for use with the SSO server.
-----------------------------------------------------------------------
<b>Instantiate:</b><br>
	$sso = new SSO($operator_username, $operator_password, $host);<br>
	(Uses port 1560 by default).<br><br>
	
<b>Run Command:</b><br>
	$sso->bind('ping');<br>
	$sso->execute();<br>
	$results = $sso->response;<br>
