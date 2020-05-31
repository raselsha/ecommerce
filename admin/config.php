<?php
	
	require_once "../assets/Facebook/autoload.php";

	$FB = new \Facebook\Facebook([
		'app_id' => '191182801436583',
		'app_secret' => '2baab2248f1a879994cd07f2a31d4357',
		'default_graph_version' => 'v2.11'
	]);

	$helper = $FB->getRedirectLoginHelper();
?>