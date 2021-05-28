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

					  <li>
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart fa-lg')) . " Attendance Report",array('controller'=>'report','action' => 'attendance'),array('escape' => false));
						?>
					  </li>

					    <li class="active">
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
			<?php echo $this->Form->Create('form1',['id'=>'formID','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'addexam']]);?>
<?php

$chart_array=array();

$chart_array[] = array(__('Teacher'),__('fail'));
						foreach($report_teacher as $result):

							foreach($user_data as $user_info){
								if($result['teacher_id'] == $user_info['user_id']){
									$teacher_name=$user_info['first_name'];
								}
							}


							$teacher_name =$teacher_name;
							$chart_array[] = array("$teacher_name",(int)$result['count']);

						endforeach;

						$options = Array(
				'title' => __('Teacher Perfomance Report'),
				'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
				'legend' =>Array('position' => 'right',
						'textStyle'=> Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans')),

				'hAxis' => Array(
						'title' =>  __('Teacher Name'),
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

			if(isset($report_teacher)){
					$chart = $GoogleCharts->load( 'column' , 'chart_div' )->get( $chart_array , $options );
			}
			 ?>
			<div id="chart_div" style="width: 100%; height: 500px;"></div>






			<?php $this->Form->end(); ?>

		</div>
</div>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
		<?php echo $chart;?>
	</script>
