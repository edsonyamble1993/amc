<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Network\Session\DatabaseSession;
use Cake\View\Helper\FlashHelper;
use Cake\Event\Event;

class UsersController extends AppController
{

	public $user_table;
	public $get_user_data;
	public $flag;

	public function initialize()
   {
       parent::initialize();

   }

   public function logout(){
   	$session = $this->request->session();
   	$session->destroy();
	//var_dump("sdfd");die;
   	return $this->redirect(['controller' => 'Users','action'=>'login']);

   }

	 // public function index(){
		 // $this->redirect(array('controller'=>'Users','action'=>'login'));
	 // }
	 

	public function login()
	{
		
		$this->viewBuilder()->layout('loginlayout');
		
		$this->user_table=TableRegistry::get('tbl_user');
		
		if($this->request->is('post'))
		{		
			$username=$this->request->data('username');
			$password=md5($this->request->data('password'));

			$query = $this->user_table->find('all',array('conditions' => array('email' => $username, 'password' => $password)));

			$arr=array();

			foreach($query as $data)
			{
				$arr['role']=$data['role'];
				$arr['user_id']=$data['user_id'];
				$arr['image']=$data['photo'];
				$arr['username']=$data['email'];
				$arr['password']=$data['password'];
			}


			$this->flag=0;
						if(isset($arr['username']) && isset($arr['password'])){

							if($username ==  $arr['username'] && $password == $arr['password']){
							$this->flag=1;
								$session_data = $this->request->session();
								$session_data->write('user_name',$arr['username']);
								$session_data->write('user_id',$arr['user_id']);
								$session_data->write('user_image',$arr['image']);
								$session_data->write('user_role',$arr['role']);

								if($arr['role'] == 'admin'){
									return $this->redirect(['controller' => 'Dashboard','action'=>'dashboard']);
								}
								
								if($arr['role'] == 'employee'){
									return $this->redirect(['controller' => 'Dashboard','action'=>'employeedashboard']);
								}
								
								if($arr['role'] == 'client'){
									return $this->redirect(['controller' => 'Dashboard','action'=>'clientdashboard']);
								}

								}else{
									$this->flag=0;
							}

					}

				
					$this->set('flag',$this->flag);
			}

		}
		public function changepassword(){
			
			$this->user_table=TableRegistry::get('tbl_user');
			$current_user_id=$this->request->session()->read('user_id');
			
			$current_user_data=$this->user_table->get($current_user_id);

			if($this->request->is('post')){
				
				$current_user_password=$current_user_data['password'];
				
				$old_password=md5($this->request->data('old_password'));
				$new_password=md5($this->request->data('new_password'));
				
				if($current_user_password == $old_password){
					
					
				        	$query =$this->user_table->query();
                                    $query->update()
                                    ->set(['password' =>$new_password])
                                    ->where(['user_id' =>$current_user_id])
                                    ->execute();
				echo $this->Flash->success('Password Has Been Updated.');
			   return $this->redirect(['controller' => 'Users','action'=>'changepassword']);
					
				}else{
					
					
					echo $this->Flash->error('Old Password Is Not Match.');
					 return $this->redirect(['controller' => 'Users','action'=>'changepassword']);
					
				}
				
				
				
				
				
			
			}
			
				
				
				
				
			
			
			
			
			
		}
	}



?>
