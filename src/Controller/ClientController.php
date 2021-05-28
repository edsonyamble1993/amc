<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;
use Cake\Mailer\Email;
use Cake\I18n\Time;


class ClientController extends AppController{

	public $getlast_record;
	public $table_user;
	public $user_entity;
	public $user_image;
	public $user_data;
	public $save_user_data;
	public $get_client_data;
	public $row_delete;
	public $row_update;
	public $store_image;
	public $update_row_client;
	


	public function initialize(){
		$this->user_image=WWW_ROOT.'img/user/';
		$this->table_user=TableRegistry::get('tbl_user');
        parent::initialize();
		
   }

		public function index(){
			$this->redirect(array('controller'=>'Client','action'=>'clientlist'));
		}

	     public function clientlist(){
			$user_role=$this->request->session()->read('user_role');
			$user_id=$this->request->session()->read('user_id');
			 if($user_role=='client'){
				 $this->get_client_data=$this->table_user->find()->where(array('role'=>'client','user_id'=>$user_id))->toArray();
			 	
			 }else
			 {
				$this->get_client_data=$this->table_user->find()->where(array('role'=>'client','is_archive'=>0))->toArray();
			 }
				$this->set('client_data',$this->get_client_data);
	     }
		 public function archiveclient(){
				$this->get_client_data=$this->table_user->find()->where(array('role'=>'client','is_archive'=>1))->toArray();
			 	$this->set('client_data',$this->get_client_data);
	     }

		public function delete($id){
			$this->request->is(['post','delete']);
			$this->row_delete=$this->table_user->get($id);
			if($this->table_user->delete($this->row_delete)){
				$this->Flash->success(__('Client Record Deleted Successfully'));
				return $this->redirect(array('controller'=>'client','action'=>'clientlist'));
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
		
		
		public function updateclient($id){
			$user_d=$this->request->data;
				$this->row_update=$this->table_user->get($id);
				$this->set('client_update_row',$this->row_update);
				
				$client = TableRegistry::get('tbl_company_detail');
				$data = $client->find()->where(['client_id'=>$id])->toArray();
                   
            
				$this->set('client_data',$data);
				
				$client_history = TableRegistry::get('tbl_client_history');
				$history_record=$client_history->find()->where(['client_id'=>$id])->toArray();
            
				$table_user=TableRegistry::get('tbl_user');
				
                
            
				
				$this->set('client_histroy',$history_record);
				
				if($this->request->is(['post','put'])){
					
					
						 $get_output=$this->check_update_email($this->row_update,$this->request->data('email'));
							
							if($get_output == true){
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
									$this->store_image = $imagename;
									$source = fopen($dataiamge, 'r');
									$destination = fopen('img/user/'.$imagename, 'w');

									stream_copy_to_stream($source, $destination);

									fclose($source);
									fclose($destination);
								
								}else{
									$this->store_image=$this->request->data('old_image');
								}

					$user_d['photo']=$this->store_image;
                    $user_d['address']=json_encode($this->request->data('address'));
						$pw = $this->request->data('user_password');
					if(!empty($pw))
					{
						$user_d['password']=md5($this->request->data('user_password'));
					}else
					{
						$recorduser = $table_user->find()->where(['user_id'=>$id])->first();
						$user_d['password'] = $recorduser['password'];
								
					}

					
						$this->update_row_client=$this->table_user->patchEntity($this->row_update,$user_d);

						if($this->table_user->save($this->update_row_client)){
							
							
						$client_id = $id;
						$company_data = $this->request->data;
						$company_data['client_id'] = $client_id;
						$company_tbl = TableRegistry::get('tbl_company_detail');
						$history_record=$company_tbl->find()->where(['client_id'=>$id])->toArray();
						
						
						foreach($history_record as $history_records)
						{
							$dataid=$history_records->id;
						}
						
						
						$new_compny = $company_tbl->get($dataid);
						$company_save_data = $company_tbl->patchEntity($new_compny,$company_data);
						$company_tbl->save($company_save_data);
							$contact_arr =$this->request->data('contact_person');
							
							if(!empty($contact_arr)){
							
							
							foreach($contact_arr['name'] as $key => $value)
							{
							$dataid = $contact_arr['id'][$key];
							if($dataid!= '')
							{
								
							$client = TableRegistry::get('tbl_client_history');
							$client_update = $client->get($dataid);
							$client_data['client_id'] = $id;
							$client_data['contact_name'] = $value;
							$client_data['mobile'] = $contact_arr['mobile'][$key];
                            $client_data['designation'] = $contact_arr['designation'][$key];
							$update = $client->patchEntity($client_update,$client_data);
							$client->save($update);
							
							}else{
								$client = TableRegistry::get('tbl_client_history');
								$cliet_new_data = $client->newEntity();
								$client_data['client_id'] = $id;
								$client_data['contact_name'] = $value;
								$client_data['mobile'] = $contact_arr['mobile'][$key];
                                $client_data['designation'] = $contact_arr['designation'][$key];
								$save_data =$client->patchEntity($cliet_new_data,$client_data);
								$client->save($save_data);
							
								}
							}
						}
							
							$this->Flash->success(__('Client Record Updated Successfully'));
							return $this->redirect(array('controller'=>'Client','action'=>'clientlist'));
						}
								}	
							else{
								$this->Flash->success(__('Invalid File Attachment'));
								$this->redirect(array('controller'=>'client','action'=>'addclient'));
							}
							
							}else if($get_output == false){
								$this->Flash->error(__('Email Already Exists !'));
							return $this->redirect(array('controller'=>'Client','action'=>'updateclient',$id));
							}
						

				}
		}
	
public function addclient($id=NULL){
	$this->getlast_record= $this->table_user->find()->select(['user_id'])->last();
	$this->user_entity=$this->table_user->newEntity();
	$client_idf=__('C').$this->getlast_record['user_id'].rand(11,99).date('mY');
	$this->set('user_idf',$client_idf);

	if($this->request->is('post'))
	{
		$remote_add = $_SERVER['REMOTE_ADDR'];
		$server_add = $_SERVER['SERVER_ADDR'];
		
		//debug($this->request->data);die;
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
			//$img = $_POST['img']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';

			$this->user_data=$this->request->data;
			$this->user_data['photo']=$imagename;
			$this->user_data['address']=json_encode($this->request->data('address'));
			$this->user_data['password']=md5($_POST['user_password']);
			$fisrtname = $this->request->data('first_name');
			$lastname = $this->request->data('last_name');
			$fullname = $fisrtname." ".$lastname;
			$email = $this->request->data('email');
			$to = $this->request->data('email');
			

			$this->save_user_data=$this->table_user->patchEntity($this->user_entity,$this->user_data);
			if($this->table_user->save($this->save_user_data)){
				//For Customer
				$tble_setting = TableRegistry::get('tble_setting');
				$mailformate = $tble_setting->find()->first();
				$sendmail = $mailformate['mail_send'];
				$title_name = $mailformate['title_name'];
				
				$mail_notification = TableRegistry::get('tbl_mail_notification');
				$mailformate = $mail_notification->find()->where(['notification_for'=>'customer_add'])->first();
				$mailformat = $mailformate['notification_text'];
				$serch = array('{ user_name }','{ system_name }','{ username }','{ password }','{ system_name_regard }','{ role }','{ system_names }');
				$replace = array($fullname,$title_name,$email,$_POST['user_password'],$title_name,'Customer',$title_name);
				$message_content = str_replace($serch, $replace, $mailformat);
				$subject = $mailformate['subject'];
				
				if($sendmail == 1)
				{
					$script = $_SERVER['SCRIPT_FILENAME'];
					
					if($remote_add != $server_add && strpos($script, ':') == false)
					{
						$headers = "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8";
						$headers .= 'From:'. $mailformate['send_from'] . "\r\n";
						mail($email,$subject,$message_content,$headers);
					}
					else
					{
						$from = $mailformate['send_from'];
						$email = new Email('default');
						   $email->from('das@infomedia.com')
						  ->to($to)
						  ->subject($subject)
						  ->send($message_content);
					}
					
				}
				
				$this->getlast_record= $this->table_user->find()->select(['user_id'])->last();
				$client_id = $this->getlast_record['user_id'];
				
				$company_data = $this->request->data;
				$company_data['client_id'] = $client_id;
				$company_tbl = TableRegistry::get('tbl_company_detail');
				$new_compny = $company_tbl->newEntity();
				$company_save_data = $company_tbl->patchEntity($new_compny,$company_data);
				$company_tbl->save($company_save_data);
				
				$contact_arr =$this->request->data('contact_person');
				
				if(!empty($contact_arr)){
					foreach($contact_arr['name'] as $key => $value)
					{
						$this->getlast_record= $this->table_user->find()->select(['user_id'])->last();
						$client_id = $this->getlast_record['user_id'];
						$clienthistory = TableRegistry::get('tbl_client_history');
						$user_entity=$clienthistory->newEntity();
						$client['client_id'] = $client_id;
						$client['contact_name'] = $value;
						$client['mobile'] = $contact_arr['mobile'][$key];
						$client['designation'] = $contact_arr['designation'][$key];
						$saveclient=$clienthistory->patchEntity($user_entity,$client);
						$clienthistory->save($saveclient);
						
					  
						
					}
				}
				
				$this->Flash->success(__('Client Record Inserted Successfully'));
				$this->redirect(array('controller'=>'client','action'=>'clientlist'));
			}
		}
		else
		{
			$this->Flash->success(__('Invalid File Attachment'));
			$this->redirect(array('controller'=>'client','action'=>'addclient'));
		}	
	}
}
	
	
	public function checkemail(){
	$this->autoRender = false;
		$table_user=TableRegistry::get('tbl_user');
		if($this->request->is('ajax')){
		
				$get_email=$this->request->data('email_text');
				echo $get_email_client=$table_user->find()->where(array('email'=>$get_email))->count();
				
		}
	
	}
	
	
   	
	

	
	public function Viewclient($id){
            
        $table_sale=TableRegistry::get('tbl_sales');
        $table_sale_history=TableRegistry::get('tbl_sales_history');
        
		$view_data=$this->table_user->get($id)->toArray();
		$this->set('viewclients',$view_data);
        
        $table_sales =TableRegistry::get('tbl_sales');  
		$sale_detail = $table_sales->find()->where(['customer_id'=>$id])->toArray();		
        $this->set('saledetail',$sale_detail);
		
		 $tbl_quotation =TableRegistry::get('tbl_quotation');  
		$quotation_detail = $tbl_quotation->find()->where(['customer_id'=>$id])->toArray();		
        $this->set('quotationdetail',$quotation_detail);
		
		 $tbl_complaint =TableRegistry::get('tbl_complaint');  
		$complaint_detail = $tbl_complaint->find()->where(['customer_id'=>$id])->toArray();		
        $this->set('complaintdetail',$complaint_detail);
    }



}  	

?>