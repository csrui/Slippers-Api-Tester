		<div class="container">
			<div class="content">
				<div class="row">	        
			        <?php if (is_object($this->script)): ?>
			
						<h1 id="title"><?php echo $this->script['name']; ?> <small>version <?php echo $this->script['version']; ?></small></h1>
						<p><?php echo $this->script['url'] ?></p>

						<?php foreach ($this->script as $resource): ?>

							<h2><?php echo strtoupper($resource['name']) ?> <small>resource</small></h2>

				            <!-- A table of some books. -->
				            <table class="zebra-striped">
								<thead>
					                <tr>
										<th width="10%">&nbsp;</th>
					                    <th width="40%">Action</th>
					                    <th>Description</th>
					                </tr>                
								</thead>
								<tbody>
					                <?php foreach ($resource as $action): ?>
					                    <tr>
											<td><?php echo strtoupper((empty($action['method'])) ? 'get' : $action['method']) ?></td>
					                        <td>
												<strong><a href="<?php echo sprintf('?api=%s&amp;resource=%s&amp;action=%s', $this->filename, $resource['name'], $action['name']) ?>"><?php echo $resource['name'] ?>/<?php echo $action['name'] ?></a></strong>
											</td>
					                        <td><?php echo $action['description']; ?>&nbsp;</td>
					                    </tr>
					                <?php endforeach; ?>
	                			</tbody>
				            </table>
            
						<?php endforeach; ?>

			        <?php endif; ?>
		
				</div>
			</div>
		</div>
