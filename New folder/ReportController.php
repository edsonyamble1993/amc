<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component;
use Cake\Datasource\ConnectionManager;

class ReportController extends AppController{


	public static $load_table_exam;
	public static $load_table_class;
	public static $load_table_subject;
	public static $load_table_user;
	public static $load_table_payment;
	public $getdata_exam;
	public $getdata_payment;
	public $getdata_class;
	public $getdata_subject;
	public $getdata_user;


	public function load_table(){
	ReportController::$load_table_exam=TableRegistry::get('smgt_exam');
	ReportController::$load_table_class=TableRegistry::get('classmgt');
	ReportController::$load_table_subject=TableRegistry::get('smgt_subject');
	ReportController::$load_table_payment=TableRegistry::get('smgt_fees_payment');

	}

	public function failed(){

		$conn=ConnectionManager::get('default');
		$this->load_table();
		$this->getdata_exam=ReportController::$load_table_exam->find();
		$this->set('exam_data',$this->getdata_exam);

		$this->getdata_class=ReportController::$load_table_class->find();
		$this->set('class_data',$this->getdata_class);

		$this->getdata_subject=ReportController::$load_table_subject->find();
		$this->set('subject_data',$this->getdata_subject);


			if(isset($_REQUEST['view_chart'])) {
				$exam_name=$this->request->data('exam_name');
			$class_name=$this->request->data('class_name');
		$rs=$conn->execute("SELECT * , count( student_id ) as count
			FROM smgt_marks as m, smgt_users as u
			WHERE m.marks <40
			AND m.exam_id = '$exam_name'
			AND m.Class_id = '$class_name'
			AND m.student_id = u.user_id
			GROUP BY subject_id");
			$this->set('report_fail',$rs);
}


	}
	public function attendance()
	{

		$this->load_table();
		$conn=ConnectionManager::get('default');
		
		
		if(isset($_REQUEST['view_chart']))
		{
			

				$start_date=$this->request->data('start_date');
				$end_date=$this->request->data('end_date');


			$this->getdata_class=ReportController::$load_table_class->find();
		$this->set('class_data',$this->getdata_class);
		$rs=$conn->execute("SELECT at.class_id, SUM(case when `status` ='Present' then 1 else 0 end) as Present, SUM(case when `status` ='Absent' then 1 else 0 end) as Absent from smgt_attendence as at,classmgt as cl where `attendence_date` BETWEEN '$start_date' AND '$end_date' AND at.class_id = cl.class_id AND at.role_name = 'student' GROUP BY at.class_id");

			$this->set('report_attendence',$rs);
		}



	}
	public function teacher(){
	$conn=ConnectionManager::get('default');	ReportController::$load_table_user=TableRegistry::get('smgt_users');
		ReportController::$load_table_user=TableRegistry::get('smgt_users');

		$this->getdata_user=ReportController::$load_table_user->find();
			$rs=$conn->execute("SELECT sb.sub_name,sb.subid,sb.teacher_id,count(mark.student_id) as count FROM smgt_subject as sb, smgt_marks as mark , smgt_users as u WHERE sb.subid=mark.subject_id AND mark.marks < 40 AND u.user_id = sb.teacher_id group by mark.subject_id");

			$this->set('report_teacher',$rs);
			$this->set('user_data',$this->getdata_user);
	}

	public function feepayment(){

		$this->load_table();
		$conn=ConnectionManager::get('default');
		
		$this->getdata_class=ReportController::$load_table_class->find();
		$this->set('class_data',$this->getdata_class);

		$this->getdata_payment=ReportController::$load_table_payment->find();
		$this->set('payment_data',$this->getdata_payment);
		
		
		if(isset($_REQUEST['view_chart'])){

				$catetable_register=TableRegistry::get('smgt_categories');
				$get_all_data_cat=$catetable_register->find();
					$this->set('get_all_data_cat',$get_all_data_cat);
					
					 $user_table_register=TableRegistry::get('smgt_users');
					 $get_all_user=$user_table_register->find();
						$this->set('get_all_user',$get_all_user);
			
		
			$get_class_id=$this->request->data('class_id');
			$get_fees_id=$this->request->data('fees_id');
			$get_payment_status=$this->request->data('payment_status');
			$start_year=$this->request->data('start_year');
			$end_year=$this->request->data('end_year');

				
				

$rs=$conn->execute("SELECT * from smgt_fees_payment WHERE class_id='$get_class_id' and fees_id='$get_fees_id' and payment_status='$get_payment_status' and  start_year>='$start_year' and end_year<='$end_year' ");
$this->set('fees_data',$rs);



		}

		


	}


}

?>
