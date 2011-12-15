<!DOCTYPE html>
<html>

    <head>
        <title><?php echo $this->title ?></title>
		<link rel="icon" type="image/png" href="assets/img/favicon.png">
		<link rel="stylesheet" href="assets/css/reset.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="assets/css/bootstrap-1.3.0.min.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="assets/css/custom.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="assets/css/print.css" type="text/css" media="print" title="no title" charset="utf-8" />
    </head>

    <body>
	
		<div class="topbar">
	      <div class="fill">
	        <div class="container">
	          <a href="#" class="brand">Slippers</a>
	          <ul class="nav">
				<li><a href="index.php?schema=<?php echo $_GET['schema'] ?>#request">Request</a></li>
				<li><a href="index.php?schema=<?php echo $_GET['schema'] ?>#response">Response</a></li>
				<li id="nav-item-docs"><a href="docs.php?schema=<?php echo $_GET['schema'] ?>">Docs</a></li>
	          </ul>
			  <form class="pull-right"><button id="btn-go" class="primary btn">Make request</button></form>
	        </div>
	      </div>
	    </div>