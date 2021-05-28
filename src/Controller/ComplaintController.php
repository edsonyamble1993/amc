<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;
use Cake\Mailer\Email;

class ComplaintController extends AppController{

	public $table_user;
	public $table_amc;
	public $table_category;
	public $table_product;
	public $table_complaint;
	public $load_customer_data;
	public $load_employee_data;
	public $load_amc_data;
	public $load_product_data;
	public $designation_list;
	public $complainttype_list;
	public $get_last_record;
	public $complaint_entity;
	public $attachment_store;
	public $complaint_data;
	public $save_complaint_data;
	public $get_all_complaint_data;
	public $delete_row;
	public $get_update_data;
	
	
	public function initialize(){
        parent::initialize();
        $this->attachment_store=WWW_ROOT.'img/attachment/';
		$this->loadComponent('AMCfunction');
        }

        public function index(){
				$this->redirect(array('controller'=>'complaint','action'=>'addcomplaint'));
        }
        
        public function TableUser()  { $this->table_user  =  TableRegistry::get('tbl_user'); }
        public function TableAmc()   { $this->table_amc   =   TableRegistry::get('tbl_amc');   }
        public function TableCategory() { $this->table_category = TableRegistry::get('category_master'); }
        public function TableProduct() { $this->table_product=TableRegistry::get('tbl_product'); }
        public function TableComplaint(){$this->table_complaint=TableRegistry::get('tbl_complaint'); }
        
        public function viewcomplaint(){
			
		
		
			
        	$this->TableComplaint();
			$this->TableUser();
			if($this->request->session()->read('user_role') == 'admin'){
        	$this->get_all_complaint_data=$this->table_complaint->find('all', array('order'=>array('tbl_complaint.status'=>'desc')));
			$this->load_employee_data=$this->table_user->find()->where(array('role'=>'employee'));
        	$this->set('employee_info',$this->load_employee_data);
			}else if($this->request->session()->read('user_role') == 'client'){
			$this->get_all_complaint_data=$this->table_complaint->find()->where(array('customer_id'=>$this->request->session()->read('user_id')))->toArray();
			}else if($this->request->session()->read('user_role') == 'employee'){
			$this->get_all_complaint_data=$this->table_complaint->find()->where(array('assign_to'=>$this->request->session()->read('user_id')))->toArray();
			}
			
        	$this->set('get_record_complaint',$this->get_all_complaint_data);	
        }
		 public function updatestatuscomplaint($id)
		{
			$this->set('complaint_id',$id);
			
			if($this->request->is(['post','put'])){
				$complaint  = $this->request->data();
				$complaint['is_appove']  = 1;
				$tbl_complaint = TableRegistry::get('tbl_complaint');
                $tbl_complaint_id = $tbl_complaint->get($id);
				 $update = $tbl_complaint->patchEntity($tbl_complaint_id, $complaint);
                 $tbl_complaint->save($update);  
                  $this->redirect(array("controller" => "Complaint","action" => "viewcomplaint"));
            
			}
				
		}
        
		public function updatestatus(){
			$this->autoRender=false;
				$this->TableComplaint();
			if($this->request->is('ajax')){
				
				$status=$this->request->data('get_status_id');
				$id=$this->request->data('get_record_id');
				
				
				
				$query = $this->table_complaint->query();
                 $result = $query->update()
                    ->set(['status' => $status])
                    ->where(['complaint_id' =>$id])
                    ->execute();
				
				
				
			}
			
			
		}
		public function changestatus($id = null){
			$this->autoRender = false;
			if($this->request->is('ajax')){
				$compain_id = $_POST['compain_id'];
				$employee_id = $_POST['employee_id'];
				$tbl_complaint =TableRegistry::get('tbl_complaint');
				$row = $tbl_complaint->get($compain_id);
					
							$stoke_p_data['assign_to'] = $employee_id;
							$supply=$tbl_complaint->patchEntity($row, $stoke_p_data);
							$tbl_complaint->save($supply);
				
			}
		}
		public function approvestatus($id = null){
			$this->autoRender = false;
			if($this->request->is('ajax')){
				$apporveid = $_POST['apporveid'];
				$tbl_complaint =TableRegistry::get('tbl_complaint');
				$row = $tbl_complaint->get($apporveid);
					
							$stoke_p_data['is_appove'] = 0;
							$stoke_p_data['status'] = $row['employee_status'];
							$supply=$tbl_complaint->patchEntity($row, $stoke_p_data);
							if($tbl_complaint->save($supply))
							{
								//for Admin
						$tble_setting = TableRegistry::get('tble_setting');
						$mailformate = $tble_setting->find()->first();
						$sendmail = $mailformate['mail_send'];
						$title_name = $mailformate['title_name'];
						$mail_notification = TableRegistry::get('tbl_mail_notification');
						$maildata = $mail_notification->find()->where(['notification_for'=>'complaint_resolved'])->first();
						
						$complaintdata = $tbl_complaint->find()->where(['complaint_id'=>$apporveid])->first();
						$complaint_no = $complaintdata['complaint_no'];
						$complaint_date = $complaintdata['complaint_date'];
						$complaint_description = $complaintdata['complaint_description'];
						$employeeid =  $complaintdata['assign_to'];
						$customerid =  $complaintdata['customer_id'];
						$customername = $this->AMCfunction->getEmployeerName($customerid);
						$employeename = $this->AMCfunction->getEmployeerName($employeeid);
						$email = $this->AMCfunction->getEmployeerEmail($customerid);
						$mailfor = $maildata['notification_text'];
						
						$serchkey = array('{ username }','{ complaint_number }','{ complaint_date }','{ employee_name }','{ description }','{ systemname }');
						$replacekey = array($customername,$complaint_no,$complaint_date,$employeename,$complaint_description,$title_name);
						$message_contents = str_replace($serchkey, $replacekey, $mailfor);
						
						$subjects = $maildata['subject'];
						$headerss = "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8";
						$headerss .= 'From:'. $maildata['send_from'] . "\r\n";
						//send mail
						
						if($sendmail == 1)
						{
							$remote_add = $_SERVER['REMOTE_ADDR'];
							$server_add = $_SERVER['SERVER_ADDR'];
							if($remote_add != $server_add)
							{
								mail($email,$subjects,$message_contents,$headerss);
							}else{
								$to = $email;
								$email = new Email('default');
								$email->from('das@dasinfomedia.com')
								->to($to)
								->subject($subjects)
								->send($message_contents);
							}
						}
						
								echo 1;
							}
				
			}
		}
		public function declineidstatus($id = null){
			$this->autoRender = false;
			if($this->request->is('ajax')){
				$declineid = $_POST['declineid'];
				
				$tbl_complaint =TableRegistry::get('tbl_complaint');
				$row = $tbl_complaint->get($declineid);
					
							$stoke_p_data['is_appove'] = 0;
							$supply=$tbl_complaint->patchEntity($row, $stoke_p_data);
							if($tbl_complaint->save($supply))
							{
								echo 1;
							}
				
			}
		}
		public function complaintdetail($id = null){
		$this->autoRender = false;
	   if($this->request->is('ajax')){
		    $id = $_POST['id'];
			$tbl_complaint =TableRegistry::get('tbl_complaint');
		 if($id != null)  
		   $complaintdata = $tbl_complaint->get($id);
		$table_setting = TableRegistry::get('tble_setting');
		$first_data = $table_setting->find()->first();
		
?>
<script  type="text/javascript">
	  
		function PrintElem(elem)
			{
					Popup($(elem).html());
			}
			function Popup(data) 
    {
        var mywindow = window.open('', 'Print Quotation', 'height=600,width=800');
       
        mywindow.document.write(data);
       

        mywindow.document.close();
        mywindow.focus();

        mywindow.print();
        mywindow.close();

        return true;
    }
	  
	  </script>
<div class="data_quotation">
<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="70%">
						<img style="max-height:80px;" src="../img/setting/<?php echo $first_data->logo; ?>">
					</td>
					<td align="left" width="30%">
						<strong>Complaint Number : </strong><?php echo $complaintdata->complaint_no; ?> <br>
						<strong>Complaint Date : </strong> <?php echo date($this->AMCfunction->getDateFormat(),strtotime($complaintdata->complaint_date)); ?> <br>
						<strong>Complaint Type : </strong> <?php echo $this->AMCfunction->getCategoryName($complaintdata->complaint_type_id); ?> <br>
						<strong>Complaint Chargeble : </strong> <?php if($complaintdata->complaint_chargeble == 0){ echo 'No'; }else{ echo 'Yes'; } ?> <br>
						
					</td>
				</tr>
			</tbody>
		</table>
		<hr/>
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td align="left" width="70%">
						<h4>Customer information</h4>
					</td>
					<td align="left" width="30%">
						<h4>Product Detail </h4>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left" width="70%">
						<b>Customer Name : </b><?php echo $this->AMCfunction->GetUserFullname($complaintdata->customer_id); ?> <br>					
						<b>Customer Email : </b><?php echo $complaintdata->email; ?> <br>					
						<b>Customer Mobile Number: </b><?php echo $complaintdata->mobile_no; ?> <br>	</td>				
					<td valign="top" align="left" width="30%">
						<b>Product Name : </b><?php echo $this->AMCfunction->GetItemName($complaintdata->product_id); ?><br>
						
					</td>
				</tr>
			</tbody>
		</table>
		<hr/>
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td align="left">
						<h4>Complaint Discription</h4>
					</td>
					
				</tr>
				<tr>
					<td valign="top" align="left">
						<?php echo $complaintdata->complaint_description; ?> 					</td>
					</tr>
			</tbody>
		</table>
		<hr/>
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td align="left">
						<h4>Product Information</h4>
					</td>
					
				</tr>
				
			</tbody>
		</table><br/>
		<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
		<thead>
				<tr>
					<th class="text-center">Customer Name</th>
					<th class="text-center">Complaint Type</th>
					<th class="text-center">Assign To</th>
					<th class="text-center">Assign Date</th>
					<th class="text-center">Close Date</th>
					<th class="text-center">Complaint Status </th>
					
				</tr>
			</thead>
			<tbody>
			
			
					<tr>
					<td class="text-center"><?php echo  $this->AMCfunction->GetUserFullname($complaintdata->customer_id); ?></td>
					<td class="text-center"><?php echo  $this->AMCfunction->getCategoryName($complaintdata->complaint_type_id); ?></td>
					<td class="text-center"><?php echo  $this->AMCfunction->GetUserFullname($complaintdata->assign_to); ?></td>
					<td class="text-center"><?php echo  date($this->AMCfunction->getDateFormat(),strtotime($complaintdata->assign_date)); ?></td>
					<td class="text-center"><?php if(isset($complaintdata->close_date)){ echo date($this->AMCfunction->getDateFormat(),strtotime($complaintdata->close_date)); }else { echo '-'; }   ?></td>
					
					<td class="text-center"><?php  if($complaintdata->status == 0){
                            echo '<span class="label label-danger">'.__('Closed').'</span>';
                        }else if($complaintdata->status == 1){
                            echo '<span class="label label-success">'.__('Open').'</span>';
                        }else if($complaintdata->status == 2){
                            echo '<span class="label label-info">'.__('Progress').'</span>';
                        } ?></td>
					
					</tr>
				
		  			</tbody>
		</table><hr/>
		
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td align="left">
						<h4>Employer Review</h4>
					</td>
					
				</tr>
				<tr>
					<td valign="top" align="left">
						<?php if(!empty($complaintdata->employer_review)){ echo $complaintdata->employer_review; }else{ echo '-'; }  ?> 					</td>
					</tr>
			</tbody>
		</table><hr/>
		
</div>
<div class="modal-footer">
		<button type="button" class="btn btn-default printbtn" id="" onclick="PrintElem('.data_quotation')" ><?php echo __('Print'); ?> </button> 
		<button type="button" class="btn btn-default" data-toggle="collapse" data-dismiss="modal"><?php echo __('Close'); ?></button>
      </div>
	   <?php
	   }
	}
        public function updatecomplaint($id){
			$this->TableComplaint();
			$this->TableUser();
        	$this->TableAmc();
        	$this->TableCategory();
        	$this->TableProduct();
			/*Load Customer Data*/
			$this->load_customer_data=$this->table_user->find()->where(array('role'=>'client'));
			$this->set('client_info',$this->load_customer_data);
			/*Load anc Code*/
			$this->load_amc_data=$this->table_amc->find();
			$this->set('amc_data',$this->load_amc_data);
			//Load Designation
			$this->designation_list=$this->table_category->find()->where(array('type'=>'designation'));
			$this->set('designationlist',$this->designation_list);
			// Brand list
			$this->complainttype_list=$this->table_category->find()->where(array('type'=>'complainttype'));
			$this->set('complainttypelist',$this->complainttype_list);
			//Load All Product
			$this->load_product_data=$this->table_product->find();
			$this->set('productdatalist',$this->load_product_data);
			// Load Employee
			$this->load_employee_data=$this->table_user->find()->where(array('role'=>'employee'));
			$this->set('employee_info',$this->load_employee_data);
        	$this->get_update_data=$this->table_complaint->get($id);
        	$this->set('update_row',$this->get_update_data);
        	if($this->request->is(['post','put'])){
        		if($_FILES['attachment']['name'] != null && !empty($_FILES['attachment']['name'])){
        			move_uploaded_file($_FILES['attachment']['tmp_name'],$this->attachment_store.$_FILES['attachment']['name']);
        			$store_attach=$_FILES['attachment']['name'];
        		}else{
        			$store_attach=$this->request->data('old_image');
        		}
        		$comp_data=$this->request->data;
        		$comp_data['attachment']=$store_attach;
        		$update_row_comp=$this->table_complaint->patchEntity($this->get_update_data,$comp_data);
        		if($this->table_complaint->save($update_row_comp)){
        			$this->Flash->success(__('Complain Record Updated Successfully'));
        			return $this->redirect(array('controller'=>'Complaint','action'=>'viewcomplaint'));
        		}
        	}
        }
        
        public function delete($id){
        	$this->TableComplaint();
        	$this->delete_row = $this->table_complaint->get($id);
        	
        	$this->request->is(array('post','delete'));
        	
        	if($this->table_complaint->delete($this->delete_row)){
        		$this->Flash->success(__('Complain Record Delete Successfully', null), 'default', array('class' => 'success'));
        			
        	}
        	return $this->redirect(array('controller'=>'complaint','action'=>'viewcomplaint'));
        }
     
        public function addcomplaint(){
			
			
			
        	
			/*Load Tables*/
        	$this->TableUser();
        	$this->TableAmc();
        	$this->TableCategory();
        	$this->TableProduct();
        	$this->TableComplaint();
        	
        	/*Load Customer Data*/
        	$this->load_customer_data=$this->table_user->find()->where(array('role'=>'client'));
        	$this->set('client_info',$this->load_customer_data);
        	/*Load anc Code*/
        	$this->load_amc_data=$this->table_amc->find();
        	$this->set('amc_data',$this->load_amc_data);
        	//Load Designation
        	$this->designation_list=$this->table_category->find()->where(array('type'=>'designation'));
        	$this->set('designationlist',$this->designation_list);
        	// Brand list
        	$this->complainttype_list=$this->table_category->find()->where(array('type'=>'complainttype'));
        	$this->set('complainttypelist',$this->complainttype_list);
        	//Load All Product
        	$this->load_product_data=$this->table_product->find();
        	$this->set('productdatalist',$this->load_product_data);
        	 // Load Employee
        	$this->load_employee_data=$this->table_user->find()->where(array('role'=>'employee'));
        	$this->set('employee_info',$this->load_employee_data);
        	$this->get_last_record= $this->table_complaint->find()->select(['complaint_id'])->last();
        	$complaint_idf=__('C').$this->get_last_record['complaint_id'].rand(11,99).date('mY');
        	$this->set('comp_idf',$complaint_idf);
        	$this->complaint_entity=$this->table_complaint->newEntity();
			if($this->request->session()->read('user_role') == 'admin'){
        	if($this->request->is('post')){
        		
        		$this->complaint_data=$this->request->data;
        		$customerid=$this->request->data('customer_id');
        		$complaint_no=$this->request->data('complaint_no');
				$complaint_date = $this->request->data('complaint_date');
				$complaint_description = $this->request->data('complaint_description');
				$customername = $this->AMCfunction->getEmployeerName($customerid);
				$email = $this->AMCfunction->getEmployeerEmail($customerid);
        		 $this->complaint_data['company_name']=$this->request->data('company_name');
        		 $this->complaint_data['city_name']=$this->request->data('city_name');
        		 $this->complaint_data['close_date']='';
        		
				
				
			
			
        		$this->save_complaint_data=$this->table_complaint->patchEntity($this->complaint_entity,$this->complaint_data);
        		if($this->table_complaint->save($this->save_complaint_data)){
						
						//for customer
						$tble_setting = TableRegistry::get('tble_setting');
						$mailformate = $tble_setting->find()->first();
						$sendmail = $mailformate['mail_send'];
						$title_name = $mailformate['title_name'];
						
						$mail_notification = TableRegistry::get('tbl_mail_notification');
						$mailformate = $mail_notification->find()->where(['notification_for'=>'complaint_mail'])->first();
						$mailformat = $mailformate['notification_text'];
						
						$serch = array('{ username }','{ complaint_number }','{ complaint_date }','{ description }','{ systemname }');
						$replace = array($customername,$complaint_no,$complaint_date,$complaint_description,$title_name);
						$message_content = str_replace($serch, $replace, $mailformat);
						$subject = $mailformate['subject'];
						
						$headers = "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8";

						
						$headers .= 'From:'. $mailformate['send_from'] . "\r\n";
						//send mail
						
						if($sendmail == 1)
						{
							$remote_add = $_SERVER['REMOTE_ADDR'];
							$server_add = $_SERVER['SERVER_ADDR'];
							if($remote_add != $server_add)
							{
								mail($email,$subject,$message_content,$headers);
							}else{
								$to = $email;
								$email = new Email('default');
								$email->from('das@dasinfomedia.com')
								->to($to)
								->subject($subject)
								->send($message_content);
							}
						}
						
						//for Admin
						$tble_setting = TableRegistry::get('tble_setting');
						$mailformate = $tble_setting->find()->first();
						$sendmail = $mailformate['mail_send'];
						$title_name = $mailformate['title_name'];
						
						$mail_notification = TableRegistry::get('tbl_mail_notification');
						$maildata = $mail_notification->find()->where(['notification_for'=>'complaint_mail_admin'])->first();
						$admintable = TableRegistry::get('tbl_user');
						$admindata = $admintable->find()->where(['role'=>'admin'])->first();
						
						$adminfullname = $admindata['first_name'].' '.$admindata['last_name'];
						
						$adminemail = $admindata['email'];
						
						$mailfor = $maildata['notification_text'];
						
						$serchkey = array('{ admin }','{ customer }','{ complaint_number }','{ complaint_date }','{ description }','{ systemname }');
						$replacekey = array($adminfullname,$customername,$complaint_no,$complaint_date,$complaint_description,$title_name);
						$message_contents = str_replace($serchkey, $replacekey, $mailfor);
						
						$subjects = $maildata['subject'];
						$headerss = "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8";
						$headerss .= 'From:'. $maildata['send_from'] . "\r\n";
						//send mail
						
						if($sendmail == 1)
						{
							$remote_add = $_SERVER['REMOTE_ADDR'];
							$server_add = $_SERVER['SERVER_ADDR'];
							if($remote_add != $server_add)
							{
								mail($adminemail,$subjects,$message_contents,$headerss);
							}else{
								$to = $adminemail;
								$email = new Email('default');
								$email->from('das@dasinfomedia.com')
								->to($to)
								->subject($subjects)
								->send($message_contents);
							}
						}

        			$this->Flash->success(__('Complain Record Inserted Successfully'));
        			$this->redirect(array('controller'=>'Complaint','action'=>'addcomplaint'));
        		}
        	}
			}
			if($this->request->session()->read('user_role') == 'client'){
				if($this->request->is('post')){
					
        		
        		$this->complaint_data=$this->request->data;
				$user_id=$this->request->session()->read('user_id');
				$this->complaint_data['customer_id']=$user_id;
				$user = TableRegistry::get('tbl_user');
				$get_count=$user->find()->where(array('user_id'=>$user_id))->first();
				$this->complaint_data['mobile_no'] = (isset($get_count['mobile_no']))?$get_count['mobile_no']:'';
				$this->complaint_data['email'] = (isset($get_count['email']))?$get_count['email']:''; 
				$this->complaint_data['status'] = 1;
				$this->complaint_data['address'] = (isset($get_count['address']))?$get_count['address']:''; 
        		 $this->complaint_data['company_name']=$this->request->data('company_name');
        		 $this->complaint_data['city_name']=$this->request->data('city_name');
        		
				
				
			
			
        		$this->save_complaint_data=$this->table_complaint->patchEntity($this->complaint_entity,$this->complaint_data);
        		if($this->table_complaint->save($this->save_complaint_data)){
        			$this->Flash->success(__('Complain Record Inserted Successfully'));
        			$this->redirect(array('controller'=>'Complaint','action'=>'viewcomplaint'));
        		}
				}
				
			}
     
        }
}  	

?>