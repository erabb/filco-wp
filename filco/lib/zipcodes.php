<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

	$zip = $_POST['zip'];

	require_once('../../../../wp-load.php');

	global $wpdb;

	$result = $wpdb->get_results(
		"SELECT * FROM zipcode WHERE zip = $zip"
	);

	echo json_encode($result);

?>