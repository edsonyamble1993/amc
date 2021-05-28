<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">

                    <li class="">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Stoke List'),array('controller'=>'Stoke','action' => 'Stokes'),array('escape' => false));
						?>

					  </li>

					   <li class="active">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Stoke'),array('controller'=>'Stoke','action' => 'addstock'),array('escape' => false));
						?>

					  </li>

				</ul>
</div>