<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FlashHelper;
use Cake\I18n\Time;
use Cake\Mailer\Email;


class EmployeeController extends AppController{

    public $getlast_record;
    public $table_user;
    public $user_entity;
    public $user_image;
    public $user_data;
    public $save_user_data;
    public $get_employee_data;
    public $row_delete;
    public $row_update;
    public $store_image;
    public $update_row_client;

    public function initialize(){
        $this->user_image=WWW_ROOT.'img/user/';
        $this->table_user=TableRegistry::get('tbl_user');
        $this->loadComponent('AMCfunction');
        $this->loadComponent('Flash');
        
       
        
    }
    

    public function index(){
        $this->redirect(array('controller'=>'Employee','action'=>'employeelist'));
    }

    public function employeelist(){
        $this->get_employee_data=$this->table_user->find()->where(array('role'=>'employee','is_archive'=>0))->toArray();
        $this->set('employee_data',$this->get_employee_data);
    }
	public function archiveemployee(){
        $this->get_employee_data=$this->table_user->find()->where(array('role'=>'employee','is_archive'=>1))->toArray();
        $this->set('employee_data',$this->get_employee_data);
    }

    public function delete($id){
        $this->request->is(['post','delete']);
        $this->row_delete=$this->table_user->get($id);
        if($this->table_user->delete($this->row_delete)){
            $this->Flash->success(__('Employee Record Deleted Successfully'));

            return $this->redirect(array('controller'=>'Employee','action'=>'employeelist'));
        }
    }
	
	
		public function check_update_email($user_data,$userinput){
			
			
				         $get_email_data=$user_data['email'];
						
						
						if($get_email_data == $userinput){
								return true;
						}else if($get_email_data != $userinput){
						   	$chk_email=$this->table_user->find()->where(array('email'=>$userinput))->count();
							if($chk_email > 0){
								return false;
							}else{
								return true;
							}
								
						}
						
						
			
			
		}

    public function addemployee($id=NULL){

        if(isset($id)){
            $user_d=$this->request->data;
            $this->row_update=$this->table_user->get($id);
            $this->set('emp_update_row',$this->row_update);

            if($this->request->is(['post','put'])){
				
				 $get_output=$this->check_update_email($this->row_update,$this->request->data('email'));
							
				if($get_output == true){

                // if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
                    // move_uploaded_file($_FILES['image']['tmp_name'],$this->user_image.$_FILES['image']['name']);
                    // $this->store_image=$_FILES['image']['name'];
                // }else{
                    // $this->store_image=$this->request->data('old_image');
                // }
			
			
				$ext = pathinfo($this->request->data('originaladdedimage'), PATHINFO_EXTENSION);
				$valid_extension = ['gif','png','jpg','jpeg',""];
				if(in_array($ext,$valid_extension) )
				{
				$dataiamge = $this->request->data('client_image');
				if($dataiamge != '')
				{
					$first_name = $this->request->data('first_name');
					$last_name = $this->request->data('last_name');
					$time = time();
					$imagename = $first_name.'_'.$last_name.'_'.$time.'.png';
					
					$source = fopen($dataiamge, 'r');
					$destination = fopen('img/user/'.$imagename, 'w');

					stream_copy_to_stream($source, $destination);

					fclose($source);
					fclose($destination);
				}else
				{
					$imagename = $this->request->data('old_image');
                }
			
                $user_d['photo']=$imagename;
				
				$pw = $this->request->data('password');
				if(!empty($pw))
				{
					$user_d['password']=md5($this->request->data('password'));
				}else
				{
					$recorduser = $table_user->find()->where(['user_id'=>$id])->first();
					$user_d['password'] = $recorduser['password'];
							
				}

				
                $this->update_row_client=$this->table_user->patchEntity($this->row_update,$user_d);

                if($this->table_user->save($this->update_row_client)){
                    $this->Flash->success(__('Employee Record Updated Successfully'));
                    return $this->redirect(array('controller'=>'Employee','action'=>'employeelist'));
                }
				}
				else
				{
					$this->Flash->success(__('Invalid File Attachment'));
					$this->redirect(array('controller'=>'Employee','action'=>'employeelist'));
				}
				
				}else if($get_output == false){
						$this->Flash->error(__('Email Already Exists !'));
					return $this->redirect(array('controller'=>'Employee','action'=>'addemployee',$id));
					}

            }

        }else{

            $this->getlast_record= $this->table_user->find()->select(['user_id'])->last();
            $client_idf=__('E').$this->getlast_record['user_id'].rand(11,99).date('mY');
            $this->set('user_idf',$client_idf);
            $this->user_entity=$this->table_user->newEntity();
			
            if($this->request->is('post')){
				
			$input_email=$this->request->data('email');
			$chk_add_email= $this->table_user->find()->where(array('email'=>$input_email))->count();
				
			if($chk_add_email > 0)
			{
				$this->Flash->error(__('Email Already Exists !'));
				$this->redirect(array('controller'=>'Employee','action'=>'addemployee'));
			}else{
				
			$ext = pathinfo($this->request->data('originaladdedimage'), PATHINFO_EXTENSION);
			$valid_extension = ['gif','png','jpg','jpeg',""];
			if(in_array($ext,$valid_extension) )
			{
				$dataiamge = $this->request->data('client_image');
				if($dataiamge != '')
				{
					$first_name = $this->request->data('first_name');
					$last_name = $this->request->data('last_name');
					$time = time();
					$imagename = $first_name.'_'.$last_name.'_'.$time.'.png';
					
					$source = fopen($dataiamge, 'r');
					$destination = fopen('img/user/'.$imagename, 'w');

					stream_copy_to_stream($source, $destination);

					fclose($source);
					fclose($destination);
				}else
				{
					$imagename='default.png';
				}

                $this->user_data=$this->request->data;
                $this->user_data['photo']=$imagename;
				$this->user_data['password']= md5($this->request->data('password'));
				$fisrtname = $this->request->data('first_name');
				$lastname = $this->request->data('last_name');
				$fullname = $fisrtname." ".$lastname;
				$email = $this->request->data('email');
				
                $data_settings=$this->AMCfunction->GetSettingData();
                $company_title=$data_settings['title_name'];
                $company_email=$data_settings['email'];
                
			    $emp_email_id=$this->request->data('email');
			    $emp_password=$this->request->data('password');
				$this->save_user_data=$this->table_user->patchEntity($this->user_entity,$this->user_data);

                if($this->table_user->save($this->save_user_data)){
						$tble_setting = TableRegistry::get('tble_setting');
						$mailformate = $tble_setting->find()->first();
						$sendmail = $mailformate['mail_send'];
						$title_name = $mailformate['title_name'];
						$mail_notification = TableRegistry::get('tbl_mail_notification');
						$mailformate = $mail_notification->find()->where(['notification_for'=>'customer_add'])->first();
						$mailformat = $mailformate['notification_text'];
						
						$serch = array('{ user_name }','{ system_name }','{ username }','{ password }','{ system_name_regard }','{ role }','{ system_names }');
						$replace = array($fullname,$title_name,$email,$emp_password,'Annual Maintance Contract','Employee',$title_name);
						$message_content = str_replace($serch, $replace, $mailformat);
						$subject = $mailformate['subject'];
						
						
						
						if($sendmail == 1)
						{
							$remote_add = $_SERVER['REMOTE_ADDR'];
							$server_add = $_SERVER['SERVER_ADDR'];
							if($remote_add != $server_add)
							{
								$headers = "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8";
								$headers .= "From:". $mailformate['send_from'] . "\r\n";
								mail($email,$subject,$message_content,$headers);
							}else{
								$to = $this->request->data('email');
								$from = $mailformate['send_from'];
								$email = new Email('default');
								$email->from('das@dasinfomedia.com')
								  ->to($to)
								  ->subject($subject)
								  ->send($message_content);
							}
							
						}
                    $this->Flash->success(__('Employee Record Inserted Successfully'));
                    $this->redirect(array('controller'=>'Employee','action'=>'employeelist'));
                }
			}else{
				$this->Flash->success(__('Invalid File Attachment'));
				$this->redirect(array('controller'=>'Employee','action'=>'addemployee'));
			}
				}
			
            }
        }

    }
	public function viewemployee($id){
		$this->table_complaint=TableRegistry::get('tbl_complaint');
		$this->get_all_complaint_data=$this->table_complaint->find()->where(array('assign_to'=>$id))->order(array('complaint_id'=>'DESC'))->toArray();
		$this->set('get_record_complaint',$this->get_all_complaint_data);
		$view_data =$this->table_user->get($id)->toArray();
        $this->set('viewemployee',$view_data);
    }
	

}

?>

