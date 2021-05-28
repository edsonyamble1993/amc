<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FlashHelper;



class TaskController extends AppController{
	
	public $table_user;
	public $table_task;
	public $task_table_entity;
	public $task_data;
	public $get_all_task_data;
	public $table_category;
	public $load_customer_data;
	public $load_employee_data;
	public $tasktype_list;
	public $attachment_store;
	public $save_task_data;
	public $delete_row;
	public $row_update;
	


	public function initialize(){
       parent::initialize();
       $this->attachment_store=WWW_ROOT.'img/attachment/';
       
   }
	
	    public function TableUser()  { $this->table_user  =  TableRegistry::get('tbl_user'); }
        public function TableCategory() { $this->table_category = TableRegistry::get('category_master'); }
        public function TableTask(){ $this->table_task=TableRegistry::get('tbl_task'); }

 		 public function index(){
   				$this->redirect(array('controller'=>'Task','action'=>'viewtask'));
   			}
			
			
			public function updatestatus(){
				$this->TableTask();
				$this->autoRender=false;
				if($this->request->is('ajax')){
					
					$status_id= $this->request->data('get_status_id');
					
					$task_id =$this->request->data('get_record_id');
					
					
					$update_status = $this->table_task->query();
                    $update_status->update()
                    ->set(['employee_status' =>$status_id,'is_appove'=>1])
                    ->where(['task_id' => $task_id])
                    ->execute();
					
					
				}
				
				
			}
			public function approvestatus($id = null){
			$this->autoRender = false;
			if($this->request->is('ajax')){
				$apporveid = $_POST['apporveid'];
				
				$tbl_task =TableRegistry::get('tbl_task');
				$row = $tbl_task->get($apporveid);
					
							$stoke_p_data['is_appove'] = 0;
							$stoke_p_data['status'] = $row['employee_status'];
							$supply=$tbl_task->patchEntity($row, $stoke_p_data);
							if($tbl_task->save($supply))
							{
								echo 1;
							}
				
			}
		}
		public function declineidstatus($id = null){
			$this->autoRender = false;
			if($this->request->is('ajax')){
				$declineid = $_POST['declineid'];
				
				$tbl_task =TableRegistry::get('tbl_task');
				$row = $tbl_task->get($declineid);
					
							$stoke_p_data['is_appove'] = 0;
							$supply=$tbl_task->patchEntity($row, $stoke_p_data);
							if($tbl_task->save($supply))
							{
								echo 1;
							}
				
			}
		}

   public function addtask($id=NULL){
		$this->TableUser();
		$this->TableCategory();
		$this->TableTask();
	   		
	   		/*Load Customer Data*/
			$this->load_customer_data=$this->table_user->find()->where(array('role'=>'client'));
			$this->set('client_info',$this->load_customer_data);
			/*Load employee Data*/
			$this->load_employee_data=$this->table_user->find()->where(array('role'=>'employee'));
			$this->set('employee_info',$this->load_employee_data);
			/*Load Tasktype Data*/
			$this->tasktype_list=$this->table_category->find()->where(array('type'=>'tasktype'));
			$this->set('tasktypelist',$this->tasktype_list);
			
			
			$this->task_table_entity=$this->table_task->newEntity();
			
			if(isset($id)){
				$update_data=$this->request->data;
			
				$this->row_update=$this->table_task->get($id);
				$this->set('get_row_update',$this->row_update);
				if($this->request->is(['post','put'])){
					$ext = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
			$valid_extension = ['pdf',"csv","doc","docx","txt","xls","xlsx",""];
			if(!in_array($ext,$valid_extension) )
			{
				$this->Flash->success(__('Invalid File Attachment'));
				return $this->redirect(['controller'=>'Task','action'=>'viewtask']);
			}
			else
			{
						if(isset($_FILES['attachment']['name']) && !empty($_FILES['attachment']['name'])){
					$store=$this->attachment_store.$_FILES['attachment']['name'];
					if(move_uploaded_file($_FILES['attachment']['tmp_name'], $store)){
						$attach=$_FILES['attachment']['name'];
					}
				}else{
					$attach=$this->request->data('old_image');
				}
				$update_data['attachment']=$attach;
				$update_data['employee_status']=$this->request->data('status');
				
				
					$update_data_task=$this->table_task->patchEntity($this->row_update,$update_data);
						
					if($this->table_task->save($update_data_task)){
						$this->Flash->success(__('Task Record Updated Successfully'));
						return $this->redirect(['controller'=>'Task','action'=>'viewtask']);
					}
				}
				}
			}else{
			
			
			if($this->request->is('post')){
				
			$ext = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
			$valid_extension = ['pdf',"csv","doc","docx","txt","xls","xlsx",""];
			if(!in_array($ext,$valid_extension) )
			{
				$this->Flash->success(__('Invalid File Attachment'));
				$this->redirect(array('controller'=>'Task','action'=>'addtask'));
			}
			else
			{
				if($_FILES['attachment']['name'] != null && !empty($_FILES['attachment']['name'])){
					$store=$this->attachment_store.$_FILES['attachment']['name'];
					if(move_uploaded_file($_FILES['attachment']['tmp_name'], $store)){
						$attach=$_FILES['attachment']['name'];
					}
				}
				$this->task_data=$this->request->data;
				$this->task_data['attachment']=$attach;
				$this->task_data['employee_status']=$this->request->data('status');
				
				
				
				$this->save_task_data=$this->table_task->patchEntity($this->task_table_entity,$this->task_data);
				if($this->table_task->save($this->save_task_data)){
					$this->Flash->success(__('Task Record Inserted Successfully'));
					$this->redirect(array('controller'=>'Task','action'=>'addtask'));
				}
			}
			}	
			}
				
   }
   
   public function delete($id){
   	$this->TableTask();
   	$this->delete_row = $this->table_task->get($id);
   	$this->request->is(array('post','delete'));
   	 
   	if($this->table_task->delete($this->delete_row)){
   		$this->Flash->success(__('Task Record Delete Successfully', null), 'default', array('class' => 'success'));
   		 
   	}
   	return $this->redirect(array('controller'=>'task','action'=>'viewtask'));
   	
   }
   
	public function viewtask(){
			$this->TableTask();
			
			if($this->request->session()->read('user_role') == 'admin'){
				$this->get_all_task_data=$this->table_task->find();
			    $this->set('taskdatalist',$this->get_all_task_data);	
	        }else if($this->request->session()->read('user_role') == 'employee'){
				$this->get_all_task_data=$this->table_task->find()->where(array('assign_to'=>$this->request->session()->read('user_id')))->order(array('task_id'=>'DESC'))->toArray();
				
				 $this->set('taskdatalist',$this->get_all_task_data);
		
	        }
			
			
			
	}
}

?>