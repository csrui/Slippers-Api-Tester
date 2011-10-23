<div class="container">
	<div class="content">
		<div class="row">	        

			<?php foreach ($this->script as $resource): ?>
				<?php if ($resource['name'] == $_GET['resource']): ?>
					<h2><?php echo strtoupper($resource['name']) ?> <small>resource</small></h2>
				<?php else: continue; endif; ?>
					
				<?php foreach ($resource as $action): ?>
					<?php if ($action['name'] == $_GET['action']): ?>
						<h3>/<?php echo $action['name'] ?> <small><?php echo strtoupper($action['method']) ?></small><h3>
						<p><?php echo $action['description']; ?></p>
					<?php else: continue; endif; ?>

					<h4>Resource URL</h4>
					<p><?php echo $this->script['url'] ?>/<?php echo $resource['name'] ?>/<?php echo $action['name'] ?></p>

		            <!-- A table of some books. -->
		            <table class="zebra-striped">
						<thead>
			                <tr>
			                    <th width="20%">Param</th>
			                    <th>Description</th>
			                </tr>                
						</thead>
						<tbody>
			                <?php foreach ($action as $param): ?>
			                    <tr>
			                        <td>
										<?php if ($param['required'] == true): ?>
											<strong><?php echo $param ?></strong>
											<br />
											<small class="label">required</small>
										<?php else: ?>
											<?php echo $param ?>
										<?php endif; ?>
									</td>
			                        <td>
										<?php echo $param['description']; ?>&nbsp;
									</td>
			                    </tr>
			                <?php endforeach; ?>
	        			</tbody>
		            </table>
		
				<?php endforeach; ?>

			<?php endforeach; ?>			

		</div>
	</div>
</div>