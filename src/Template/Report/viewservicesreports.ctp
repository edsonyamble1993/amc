<?php 

use Cake\Routing\Router;
$action = $this->request->params['action'];

?>
<div class="row panel-body">
<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                       <li class="">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Complaints Reports'),
array('controller'=>'report','action' => 'viewreport'),array('escape' => false));
						?>						  
					  </li>
					  <li class="">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Sales Reports'),
array('controller'=>'report','action' => 'viewsalereport'),array('escape' => false));
						?>						  
					  </li>
					  <li class="active">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Services Reports'),
array('controller'=>'report','action' => 'viewservicesreports'),array('escape' => false));
						?>						  
					  </li>
                    
					 
				</ul>
				<form method="post" accept-charset="utf-8" id="client_form" class="form_horizontal formsize" enctype="multipart/form-data" action="<?php echo $this->Url->build(array('controller'=>'report','action'=>'viewservicesreports'))?>">
					<div class="header">
						<h3><?php echo __('Services Reports'); ?></h3>
					</div><br/><br/>
					<div class="form-group start_end_date">
					<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Start Date'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
						<input type="date" name="start_date" id="start_date1" class="form-control validate[required]" required="required" value="<?php if(isset($start_date)){ echo $start_date; }else{ echo date('Y-m-d'); }?>">
							</div>
						
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('End Date'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
						<input type="date" name="end_date" id="enddate_select1" class="form-control validate[required]" required="required" value="<?php if(isset($end_date)){ echo $end_date; }else{ echo date('Y-m-d',strtotime('+2 year')); }?>">
							</div>

			</div>
					<div class="form-group">
							
							<div class="col-sm-2 label_right">
								<label for="client">Select Client</label> <span class="require-field">*</span>
                            </div>
							<div class="col-sm-4">

									<select class="form-control" name="client_id" required="request">
                                        <option value="all" <?php if(isset($clintdata)){ if($clintdata == 'all'){ echo 'selected'; }} ?>>All</option>
                                        <?php
                                        if(isset($client_info)){
                                            foreach($client_info as $client_row){
                                        ?>
         <option value="<?php echo $client_row['user_id']; ?>" <?php 
                                
                                                if(isset($clintdata)){
                                                    if($clintdata == $client_row['user_id']){
                                                        echo 'selected="selected"';
                                                    }
                                                }
                                                
                 
                 ?> ><?php echo $client_row['first_name'].' '.$client_row['last_name']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                        
                                        
									</select>
						    </div>
					</div>
					
					<div class="form-group">
							
							<div class="col-sm-offset-2 col-sm-10">
							<div class="submit"><input type="submit" name="add" class="btn btn-success" id="save" value="Go"></div>							</div>
				</div>
				<?php
    						if(isset($result_data)){
    						$chart_array=array();
    						$chart_array[] = array(__('Date'),__('Count'));

    						foreach ($result_data as $result) {
							
							$chart_array[] = array(date('M-Y',strtotime($result['service_date'])),(int)$result['count']);
							
							$chart_sum[] = $result['count'];
    						}
							echo "<h6 style='font-weight:bold;font-size:14px;padding-left:30px;text-transform:uppercase;'> <u style='padding-bottom:2px;'>".$start_date."</u> Until <u>".$end_date."</u> : Total ".array_sum($chart_sum)." Services</h6>";
							
    		$options = Array(
			'title' => $title,
			'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
			'legend' =>Array('position' => 'right',
					'textStyle'=> Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans')),

			'hAxis' => Array(
					'title' => $downtitle,
					'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
					'textStyle' => Array('color' => '#222','fontSize' => 10),
					'maxAlternation' => 2


			),
			'vAxis' => Array(
					'title' => $righttitle,
					'minValue' => 0,
					'maxValue' => 5,
					'format' => '#',
					'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
					'textStyle' => Array('color' => '#222','fontSize' => 12)
			),
			'colors' => array('#22BAA0','#f25656')
	);


  include_once WWW_ROOT.'chart'.DS.'GoogleCharts.class.php';
  $GoogleCharts=new GoogleCharts;


?>

  <?php

    	  $chart = $GoogleCharts->load( 'column' , 'chart_div' )->get( $chart_array , $options );

    	  if(count($chart_array) >= 1){
    	  ?>

    	  	 <div id="chart_div" style="width: 100%; height: 500px;"></div>
    	<?php
    }else{
    	?>
    		<div class="alert alert-info"><h2 align="center">Result Not Found !</h2></div>
    	<?php
    }
	}
    ?>


 
</form>
  <!-- Javascript -->
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript">
			<?php echo $chart;?>
		</script>
				

</div>
<script>
$(function(){

	jQuery('#date,#start_date,#enddate_select').datepicker({
		dateFormat: "yy-mm-dd",
		  changeMonth: true,
	        changeYear: true,
	        yearRange:'-65:+15',
	             
                });


		
	});
</script>