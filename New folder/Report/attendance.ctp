<?php

		use Cake\ORM\TableRegistry;

		$user_id=$this->request->session()->read('user_id');

			$class_user = TableRegistry::get('smgt_users');
			$query=$class_user->find()->where(['user_id'=>$user_id]);

			$get_role='';

			foreach($query as $role){
					$get_role=$role['role'];
			}

	?>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">

                       <li>

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart fa-lg')) . "Student Failed Report ",array('controller'=>'report','action' => 'failed'),array('escape' => false));
						?>


					  </li>

					  <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart fa-lg')) . " Attendance Report",array('controller'=>'report','action' => 'attendance'),array('escape' => false));
						?>
					  </li>

					    <li>
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart fa-lg')) . " Teacher Performance Report",array('controller'=>'report','action' => 'teacher'),array('escape' => false));
						?>
					  </li>

					    <li style="display:<?php if($get_role == 'teacher'){echo 'none';}else{echo 'block';}?>">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart fa-lg')) . " Fee Payment Report",array('controller'=>'report','action' => 'feepayment'),array('escape' => false));
						?>
					  </li>


				</ul>
</div>
<script>
	$(function(){

		$('#start_date').datepicker({
			 changeMonth: true,
      		 changeYear: true,
      		 dateFormat:"yy-mm-dd",
		});
    		$('#end_date').datepicker({
			 changeMonth: true,
      		 changeYear: true,
      		  dateFormat:"yy-mm-dd",
		});
	});
</script>

<div class="row">
		<div class="panel-body">
			<?php echo $this->Form->Create('form1',['id'=>'formID','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'attendacne']]);?>


<div class="col-md-3">
			<div class="form-group">
    		<label for="exam_id">Start Date<span class="require-field">*</span></label>
             <input type="text" class="form-control" id="start_date" name="start_date" value="<?php if(isset($_REQUEST['view_chart'])){echo $_REQUEST['start_date'];}?>">
    </div>

	</div>

	<div class="col-md-3">
    <div class="form-group">
    				<label for="exam_id">End Date<span class="require-field">*</span></label>
                    	 <input type="text" class="form-control" id="end_date" name="end_date" value="<?php if(isset($_REQUEST['view_chart'])){echo $_REQUEST['end_date'];}?>">
    	</div>

		</div>

		<div class="col-md-3">
			  <div class="form-group">
						<?php echo $this->Form->label('');?>
						<?php echo $this->Form->input('GO',array('type'=>'submit','class'=>'btn btn-info','name'=>'view_chart','style'=>'')); ?>
				</div>
		</div>


	<?php echo $this->Form->input('GO',array('type'=>'submit','class'=>'btn btn-info','name'=>'view_chart','style'=>'visibility:hidden')); ?>



    						<?php
    						if(isset($report_attendence)){
    						$chart_array=array();
    						$chart_array[] = array(__('Class'),__('Present'),__('Absent'));

    						foreach ($report_attendence as $result) {

    							foreach ($class_data as $class_info) {
    								if( $result['class_id'] == $class_info['class_id']){
    									$class_name=$class_info['class_name'];
    								}
    							}

    						$class_id =$class_name;
							$chart_array[] = array("$class_id",(int)$result['Present'],(int)$result['Absent']);
    						}



    		$options = Array(
			'title' => __('Attendance Report','school-mgt'),
			'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
			'legend' =>Array('position' => 'right',
					'textStyle'=> Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans')),

			'hAxis' => Array(
					'title' =>  __('Class','school-mgt'),
					'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
					'textStyle' => Array('color' => '#222','fontSize' => 10),
					'maxAlternation' => 2


			),
			'vAxis' => Array(
					'title' =>  __('No of Student','school-mgt'),
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
<div class="col-md-12">
  <?php

    	  $chart = $GoogleCharts->load( 'column' , 'chart_div' )->get( $chart_array , $options );

    	  if(count($chart_array) > 1){
    	  ?>

    	  	 <div id="chart_div" style="width: 100%; height: 500px;"></div>
    	<?php
    }else{
    	?>
    		<div class="alert alert-info"><h2 align="center">Result Not Found !</h2></div>
    	<?php
    }
    ?>


  <!-- Javascript -->
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript">
			<?php echo $chart;?>
		</script>


</div>



			<?php
}
			$this->Form->end(); ?>

		</div>
</div>
