<?php

// require_once 'scripts.php';

// Load the Savant3 class file and create an instance.
require_once 'libs/Savant3-3.0.1/Savant3.php';
$tpl = new Savant3();

$tpl->filename = $_GET['api'];
$tpl->script = simplexml_load_string(file_get_contents($_GET['api']));
$tpl->title = sprintf('%s - version %s', $tpl->script['name'], $tpl->script['version']);

$tpl->display('templates/header.tpl.php');

if (!isset($_GET['action'])) {
	$tpl->display('templates/default_index.tpl.php');
} else {

	$tpl->display('templates/default_view.tpl.php');
}
$tpl->display('templates/footer.tpl.php');



class Script {

	private $script = null;

	public function __contruct($script) {
		
		$this->script = $script;
		
	}
	
	public function getResources() {
		return $this->script;
	}
	
	public function getResource($name) {
		
		foreach ($this->script as $resource)
		
			if ($resource['name'] == $name)
		
				return $resource;
		
	}
	
	public function getAction($resource, $name) {
		
		$resource = $this->getResource($resource);
		
		foreach ($resource as $action)
		
			if ($action['name'] == $name)
		
				return $action;			
		
	}
	
}

?>