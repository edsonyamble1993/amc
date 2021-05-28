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

                       <li class="active">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart fa-lg')) . "Student Failed Report ",array('controller'=>'report','action' => 'failed'),array('escape' => false));
						?>


					  </li>

					  <li>
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

<div class="row">
		<div class="panel-body">
			<?php echo $this->Form->Create('form1',['id'=>'formID','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'failed']]);?>



			<div class="col-md-3">
								<div class="form-group">
    								<label for="exam_id">Select Exam<span class="require-field">*</span></label>
                    	 		<select class="form-control validate[required]" name="exam_name">
                					<option value="">Select Exam Name</option>

                					<?php foreach($exam_data as $exam_info):?>
                					<option value="<?php echo $exam_info['exam_id']; ?>"><?php echo $exam_info['exam_name']; ?></option>
                                      <?php endforeach; ?>
					                </select>
    </div>
	</div>

	<div class="col-md-3">
    <div class="form-group">
    								<label for="exam_id">Class Name<span class="require-field">*</span></label>
                    	 <select class="form-control validate[required]" name="class_name">
                	<option value=" ">Select Class Name</option>

                	<?php foreach($class_data as $class_info):?>
                	<option value="<?php echo $class_info['class_id'];?>"><?php echo $class_info['class_name']; ?></option>
                <?php endforeach;?>

					                </select>
    						</div>

							</div>


							<div class="col-md-3">
								<div class="form-group">
									<?php echo $this->Form->label('');?>
									<?php	echo $this->Form->input('GO',array('type'=>'submit','class'=>'btn btn-info','name'=>'view_chart','style'=>''));?>
													</div>
												</div>

    						<?php



    						echo $this->Form->input('GO',array('type'=>'submit','class'=>'btn btn-info','name'=>'view_chart','style'=>'visibility:hidden'));
    						if(isset($report_fail)){
    						$chart_array=array();
    						$chart_array[] = array( __('Class'),__('No. of Student Fail'));

    						foreach ($report_fail as $result) {

    							foreach($subject_data as $subject_info){

    								if($result['subject_id'] == $subject_info['subid']){
    									$subject_name=$subject_info['sub_name'];
    								}

    						}


    						$subject =$subject_name;
							$chart_array[] = array("$subject",(int)$result['count']);
    						}

    						$options = Array(
		'title' => __('Exam Failed Report'),
		'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
		'legend' =>Array('position' => 'right',
				'textStyle'=> Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans')),

		'hAxis' => Array(
				'title' =>  __('Subject'),
				'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
				'textStyle' => Array('color' => '#222','fontSize' => 10),
				'maxAlternation' => 2
		),
		'vAxis' => Array(
				'title' =>  __('No of Student'),
				'minValue' => 0,
				'maxValue' => 5,
				'format' => '#',
				'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
				'textStyle' => Array('color' => '#222','fontSize' => 12)
		),
		'colors' => array('#22BAA0')
);


  include_once WWW_ROOT.'chart'.DS.'GoogleCharts.class.php';
  $GoogleCharts=new GoogleCharts;



?>
<div class="col-md-12">
    	  <?php

    	  if(isset($report_fail))
    	  	{ 		$chart = $GoogleCharts->load( 'column' , 'chart_div' )->get( $chart_array , $options );


    	  if(count($chart_array) > 1){
    	  	?>
    	  	 <div id="chart_div" style="width: 100%; height: 500px;"></div>
    	  <?php
    	  }else{
    	  	echo '<div class="alert alert-info"><h2 align="center">Result Not Found !</h2></div>';
    	  }
    	}
 		?>

</div>

    	<?php }
    	?>
  <!-- Javascript -->
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript">
			<?php echo $chart;?>
		</script>










			<?php $this->Form->end(); ?>

		</div>
</div>
