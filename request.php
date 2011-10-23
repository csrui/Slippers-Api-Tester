<?php

include_once('libs/pretify.php');
include_once('libs/http_codes.php');

# SETUP DATA
$data = $_GET;

$url = sprintf('%s/%s/%s', $data['url'], $data['resource'], $data['action']);

# HANDLE PARAMS
$params = array();
if (!empty($data['params'])) {
	foreach($data['params'] as $key => $param) {
		if ($param['url'] == "true") {
			$url .= '/' . $param['value'];
		} else {
			$params[$key] = $param['value'];
		}
	}
}

$url .= '.' . $data['format'];

if (!empty($data['extra_params'])) {
	$extra_params = explode("\n", $data['extra_params']);
	if (is_array($extra_params)) {
		foreach($extra_params as $key => $param) {
			$key_val = explode('=', $param);
			$tmp[$key_val[0]] = $key_val[1];
		}
		$extra_params = $tmp;
		unset($tmp);
		$params = array_merge($params, $extra_params);
	}
}

# START REQUEST

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

# HANDLE AUTH
if (!empty($data['username']) && !empty($data['password'])) {
	
	curl_setopt($ch, CURLOPT_USERPWD, $data['username'] . ":" . $data['password']);
	unset($data['username']);
	unset($data['password']);	
	
}

if ($data['type'] != 'get') {
	
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($data['type']));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	
} else {
	
	$url .= '?' . http_build_query($params);
	
}

curl_setopt($ch, CURLOPT_URL, $url);
$response = curl_exec($ch);

if (!curl_errno($ch)) {

	echo '<div class="span8"><pre>';
	$info = curl_getinfo($ch);
	echo "URL: {$info['url']}\n";
	echo "Response code: {$codes[$info['http_code']]}\n";
	echo "Content type: {$info['content_type']}\n";
	echo "Time elapsed: {$info['total_time']} seconds\n";
	echo '</pre></div>';
	
	echo '<div class="span8"><pre>';
	if (!empty($params)) {
		foreach($params as $key => $value) {
			echo sprintf("%s : <strong>%s</strong>\n", $key, $value);
		}
	} else {
		echo 'no params';
	}
	echo '</pre></div>';
	
	if ($data['format'] == 'json') {
		$response = pretifyJson($response);
		$geshi_format = 'javascript';
	} else {
		$geshi_format = $data['format'];
	}

	echo '<div class="span16">';
	include_once('assets/vendors/geshi/geshi.php');
	$geshi = new GeSHi($response, $geshi_format);
	$geshi->enable_classes();
	$geshi->set_header_type(GESHI_HEADER_DIV);
	echo sprintf('<style type="text/css">%s</style>', $geshi->get_stylesheet());
	echo $geshi->parse_code();
	echo '</div>';	

}

?>