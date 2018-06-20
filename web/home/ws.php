<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";

$admin = new LTE\Admin;
$admin->title("Home");
echo $admin;

?>
<script>
// https://www.html5rocks.com/en/tutorials/websockets/basics/
$(function(){
	
	console.info('connectin');
	
	var connection = new WebSocket('ws://html5rocks.websocket.org/echo', ['soap', 'xmpp']);

	// When the connection is open, send some data to the server
	connection.onopen = function () {
	  console.info('connection is open');
	  connection.send('Ping'); // Send the message 'Ping' to the server
	};

	// Log errors
	connection.onerror = function (error) {
	  console.log('WebSocket Error ' + error);
	};

	// Log messages from the server
	connection.onmessage = function (e) {
	  console.log('Server: ' + e.data);
	};	

});

</script>