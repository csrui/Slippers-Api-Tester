<?php

	$directory = dirname(__FILE__)."/scripts/";
	
    $iterator = new DirectoryIterator($directory);
	$scripts = array();
    foreach ($iterator as $fileinfo) {
        if ($fileinfo->isFile() && strtolower($fileinfo->getExtension()) == 'xml') {
			$scripts[ $fileinfo->getFilename() ] = simplexml_load_file($directory.$fileinfo->getFilename());
        }
    }

?>