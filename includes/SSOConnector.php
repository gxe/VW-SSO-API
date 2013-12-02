<?php
/*
 * VaporWeb SSO Service Connector
 * --- Single Sign On ---
 * Author: Nick Wilging (12/1/13)
 * --------------------------------
 * Notes:
 *
 */
define(MAX_BUFFER_SIZE, 2048); # Set buffer to 2048 byte maximum

class SSO {
	
	/*
	 * To instantiate, user must provide their SSO username and password, which will act as the
	 * operator account for the duration of the connection.
	 * @$op_u
	 * @$op_p
	 *
	 * @$ip     =   Host that the SSO server is on. (Defaults to accounts.vaporweb.net)
	 * @$port   =   Port that the SSO server is on. (Defaults to 1560)
	 */
	function __construct($op_u, $op_p, $ip, $port = 1560) {
		$this->sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		$this->ip = $ip;
		$this->port = $port;
		if(!$this->connect()) {
			die('Unable to use provided socket for connection.');
			return; # Slightly redundant, don't you think? ;)
		}
		$this->cmdString = array();
		$this->response = array();
	}

	/*
	 * This will connect us to the SSO server. Using the variable isConnected to
	 * let external applications know whether or not we are connected to the SSO server.
	 */
	public function connect() {
		if(socket_connect($this->sock, $this->ip, $this->port)) {
			# Also let us know if we're connected
			$this->isConnected = true;
			return true;
		} else {
			$this->isConnected = false;
			return false;
		}
	}

	/*
	 * Wipes the command string clean, allowing a new set of commands to be ran on the SSO server.
	 */
	private function _wipe() {
		$this->cmdString = array();
		return;
	}

	private function _write($data) {
		$sock = $this->sock;
		socket_write($sock, $data);
		return;
	}
	private function _read() {
		$sock = $this->sock;
		$content = socket_read($sock, MAX_BUFFER_SIZE);
		return $content;
	}

	/*
	 * This will bind a command to the SSO command string, which will then
	 * be executed when the execute function is called.
	 */
	public function bind($cmd) {
		$this->cmdString[] = $cmd;
	}

	/*
	 * Allows the user to manually wipe the response array.
	 */
	public function clear() {
		$this->_wipe();
		return;
	}

	/*
	 * 'execute' will run all of the commands in the command string identified by cmdString. It will then
	 * organize the responses into an array to return to the user.
	 */
	public function execute() {
		$cmds = $this->cmdString;
		if(empty($cmds) || !is_array($cmds)) {
			die('Command string is empty!');
			return;
		}
		foreach($cmds as $c) {
			$this->_write($c . PHP_EOL);
			$this->response[] = $this->_read();
		}
		$this->_wipe();
	}
}