<?php include_once('scripts.php'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>
			API Test
		</title>
		<link rel="stylesheet" href="assets/css/reset.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="assets/css/bootstrap-1.1.1.min.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="assets/css/custom.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<script type="text/javascript" src="assets/js/jquery-1.6.2.min.js">
</script>
		<script type="text/javascript" src="assets/js/main.js">
</script>
	</head>
	<body>

		<!-- TOP BAR -->
		<div class="topbar-wrapper">
			<div class="topbar">
				<div class="fill">
					<div class="container">
						<h3><a href="#">Slippers</a></h3>					
						<ul class="hnav">
							<li><a href="#request">Request</a></li>
							<li><a href="#response">Response</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- END TOP BAR -->


		<div id="content" class="container">
			<div class="row">
				<a name="request"></a>
				<h1 class="span16">
					Request
				</h1>				
				
					<form action="request.php" method="post" enctype="multipart/form-data">
						
						<div class="span8">
							<fieldset>	
								<legend>Source</legend>						
								<div class="clearfix required">
									<label>API</label>
									<div class="input">
										<select name="api" id="select-api">
											<option></option>
											<?php foreach($scripts as $filename => $script): ?>
												<option value="<?php echo $filename; ?>">
													<?php echo $script->attributes()->name; ?>
												</option>
											<?php endforeach; ?>										
										</select>
									</div>
								</div>
							
								<div class="clearfix">
									<label>URL</label>
									<div class="input">
										<input type="text" id="url" name="url" class="disabled">
									</div>
								</div>										
							
								<div class="clearfix required">
									<label>Resources</label>
									<div class="input">
										<select name="resource" id="select-resources">
											<option></option>
										</select>
									</div>
								</div>
								<div class="clearfix required">
									<label>Action</label>
									<div class="input">
										<select name="action" id="select-actions">
											<option></option>
										</select>									
									</div>
								</div>
							</fieldset>
						
							<fieldset>
								<legend>Parameters</legend><div id="fieldset-params">no parameters</div>
							</fieldset>
						
						</div>

						
						<div class="span8">
							<fieldset>
								<legend>Basic Auth</legend>
								<div class="clearfix">
									<label>Username</label> <div class="input"><input type="text" id="username" name="username"></div>
								</div>
								<div class="clearfix">
									<label>Password</label> <div class="input"><input type="password" id="password" name="password"></div>
								</div>
							</fieldset>
							
							<fieldset>
								<div class="clearfix">
									<label>Format</label>
									<div class="input">
										<select name="format">
											<option value="json">
												JSON
											</option>
											<option value="xml">
												XML
											</option>
										</select>
									</div>
								</div>
								<div class="clearfix">
									<label>Type</label>
									<div class="input">
										<select name="type" id="select-type">
											<option value="post">
												POST
											</option>
											<option value="get">
												GET
											</option>
										</select>
									</div>
								</div>
								<div class="clearfix">
									<label>Extra params <sup>(optional)</sup></label>
									<div class="input">
										<textarea cols="50" rows="5" name="extra_params" id="extra-params"></textarea>
										<small class="clearfix">One pair each line</small>
									</div>
								</div>
							</fieldset>
						</div>

						<div class="span16 clearfix">
							<button class="primary btn">Go</button>
						</div>
					</form>

			</div>
		
			<div class="row">
				<a name="response" id="response"></a>
				<h2 class="span16">
					Response
				</h2>
				<div id="response_wrapper">
					<span class="span16">no response</span>
				</div>
			</div>
		
		</div>
		
		<footer class="footer">
	      <div class="container">
	        <p class="pull-right"><a href="#">Back to top</a></p>
	        <p>
	          Slippers was built by <a href="http://ruicruz.com">ruicruz.com</a>
	        </p>
	      </div>
	    </footer>
		
	</body>
</html>
