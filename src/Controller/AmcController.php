<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FlashHelper;
use Cake\I18n\Time;
use Phinx\Db\Table;
use Cake\Datasource\ConnectionManager;


class AmcController extends AppController{

	/*Variable Declaration */
	public $table_amc;
	public $table_user;
	public $table_warranty;
	public $table_product;
    public $table_amc_history;
	public $table_category;
	public $table_ah_entity;
	public $get_last_record;
	public $get_product_list;
	public $get_amc_list;
	public $load_customer_data;
	public $load_warranty_data;
	public $amctype_list;
	public $amc_table_entity;
	public $save_amc_data;
	public $row_delete;
	public $get_update_data;
	public $attach_path;
	public $store;
	public $service_manage;

	/*Default Construct Of Cakephp*/

	public function initialize(){
       parent::initialize();
		$this->attach_path=WWW_ROOT.'img/attachment/';
		 $this->loadComponent('AMCfunction');
   }


	/*Table Register*/
	public function TableAmc(){ $this->table_amc=TableRegistry::get('tbl_amc'); }
	public function TableUser(){ $this->table_user=TableRegistry::get('tbl_user'); }
	public function TableCategory(){ $this->table_category=TableRegistry::get('category_master'); }
	public function TableWarranty(){ $this->table_warranty=TableRegistry::get('tbl_warranty'); }
	public function TableProduct(){ $this->table_product=TableRegistry::get('tbl_product'); }
	public function TableAmcHistory(){ $this->table_amc_history=TableRegistry::get('tbl_amc_history'); }
	public function TableServiceManage(){$this->service_manage=TableRegistry::get('tbl_manage_service');}


   	public function addamc(){
		/*Load Table*/
		$this->TableAmc();
		$this->TableUser();
		$this->TableCategory();
		$this->TableWarranty();
		$this->TableProduct();
		$this->TableAmcHistory();
		$this->TableServiceManage();

		/*Amc No Unique Identification*/

			$this->get_last_record= $this->table_amc->find()->select(['amc_id'])->last();
			$amc_idf=__('AMC').$this->get_last_record['amc_id'].rand(11,99).date('mY');
			$this->set('amc_idf',$amc_idf);
			
			
			/*Load employee Data*/
			$this->load_employee_data=$this->table_user->find()->where(array('role'=>'employee'));
			$this->set('employee_info',$this->load_employee_data);
			
		/* Load Customer Data*/

			$this->load_customer_data=$this->table_user->find()->where(array('role'=>'client'));
			$this->set('client_info',$this->load_customer_data);

		/*Load Product Data*/
			$this->get_product_list=$this->table_product->find();
			$this->set('product_row',$this->get_product_list);


		/*Load Require Data*/
			$this->amctype_list=$this->table_category->find()->where(array('type'=>'amctype'));
			$this->set('amctypelist',$this->amctype_list);

			$this->load_warranty_data=$this->table_warranty->find();
			$this->set('warranty_data',$this->load_warranty_data);
		/*Add Data InTo Amc Table*/

		/*Create Entitry For Table Amc*/
		 	$this->amc_table_entity=$this->table_amc->newEntity();
		if($this->request->is('post')){
			
			$ext = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
			$valid_extension = ['pdf',"csv","doc","docx","txt","xls","xlsx",""];
			if(!in_array($ext,$valid_extension) )
			{
				$this->Flash->success(__('Invalid File Attachment'));
				$this->redirect(array('controller'=>'amc','action'=>'addamc'));
			}
			else
			{
			if($_FILES['attachment']['name'] != null && !empty($_FILES['attachment']['name'])){
				$attachment_default=$_FILES['attachment']['name'];
			}else{
				$attachment_default='default.png';
			}

			if($this->request->data['attachment']){
				$image=$this->request->data['attachment'];
				$store=$this->attach_path.$image['name'];
				if(move_uploaded_file($image['tmp_name'], $store)){
				}
			}

			$amc_data=$this->request->data;
			$amc_data['attachment']=$attachment_default;


			$this->save_amc_data=$this->table_amc->patchEntity($this->amc_table_entity,$amc_data);
			if($this->table_amc->save($this->save_amc_data)){

				$a_id=$this->table_amc->find()->select(['amc_id'])->last();
				$product_arr=array();
				$product_arr=$this->request->data('product');

				foreach($product_arr['product_id'] as $key => $value){
					$this->table_ah_entity=$this->table_amc_history->newEntity();
					$ah_data['amc_id']=$a_id['amc_id'];
					//$ah_data['warranty_id']=$product_arr['warranty'][$key];
					$ah_data['note']=$product_arr['note'][$key];
					$ah_data['item_name']=$product_arr['product_id'][$key];
					
					$add_data_ah=$this->table_amc_history->patchEntity($this->table_ah_entity, $ah_data);
					if($this->table_amc_history->save($add_data_ah)){
					}
				}
				
				
				
				
				$service_schedule=$this->request->data('service');
				
				if(isset($service_schedule) && !empty($service_schedule)){
					
					foreach($service_schedule['service_date'] as $key => $value){
				    $table_ms_entity=$this->service_manage->newEntity();
					
					$data_ms['sales_id']=$a_id['amc_id'];
					$data_ms['type']= 1;
					$data_ms['customer_id']= $this->request->data('customer_id'); 
					$data_ms['assign_to']= $this->request->data('assign_to_id'); 
					$data_ms['service_date']=$service_schedule['service_date'][$key];
					$data_ms['title']=$service_schedule['service_text'][$key];
					$add_data_ms=$this->service_manage->patchEntity($table_ms_entity, $data_ms);
					if($this->service_manage->save($add_data_ms)){
					}
				
				}
					
					
					
				}
			
			
			
			$this->redirect(array('controller'=>'amc','action'=>'viewamc'));
			$this->Flash->success(__('AMC Record Inserted Successfully'));
			}
		}
		}
   	}
	public function amcdetaildata($id = null){
		$this->autoRender = false;
	   if($this->request->is('ajax')){
		   $id = $_POST['id'];
		$table_sales =TableRegistry::get('tbl_amc');
		 if($id != null)  
		   $saledata = $table_sales->get($id);	
		$table_setting = TableRegistry::get('tble_setting');	   
		$first_data = $table_setting->find()->first();
		
		
		
		
		$tbl_manage_service = TableRegistry::get('tbl_manage_service');
		$tbl_manage=$tbl_manage_service->find()->where(['sales_id'=>$id,'type'=>1])->toArray();
		
		
		?>

      
	  <script  type="text/javascript">
	  
		function PrintElem(elem)
			{
					Popup($(elem).html());
			}
			function Popup(data) 
    {
        var mywindow = window.open('', 'Print Expense Invoice', 'height=600,width=800');
       
        mywindow.document.write(data);
       

        mywindow.document.close();
        mywindow.focus();

        mywindow.print();
        mywindow.close();

        return true;
    }
	  
	  </script>
		<div class="data_sales">
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="75%">
						<img style="max-height:80px;" src="../img/setting/<?php echo $first_data->logo; ?>">
					</td>
					<td align="left" width="25%">
						<h5>Amc Number : <?php echo $saledata->amc_no; ?> </h5>
						<h5>Date : <?php echo $saledata->date; ?> </h5>
						<h5>Status :<?php echo $saledata->status; ?></h5>
					</td>
				</tr>
			</tbody>
		</table>
		<hr/>
		
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="75%" align="left">
						<h4>Payment To </h4>
					</td>
					<td align="left" width="25%">
						<h4>Bill To </h4>
					</td>
				</tr>
				<tr>
					<td valign="top" width="75%" align="left">
						<?php echo $saledata->address; ?> 					</td>
					<td valign="top" width="25%" align="left">
						<b>Name : </b><?php echo $this->AMCfunction->getEmployeerName($saledata->customer_id); ?><br><b>Assign To : </b><?php echo $this->AMCfunction->getEmployeerName($saledata->assign_to_id);  ?><br><b>Mobile : </b><?php echo $saledata->mobile; ?>	<br><b>Email : </b><?php echo $saledata->email; ?>					</td>
				</tr>
			</tbody>
		</table>
		
		
		
		
		
		<hr/>
		
		
	
		<?php if(!empty($tbl_manage)){ ?>
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="75%" align="left">
						<h4>Services Details</h4>
					</td>
					
				</tr>
				
			</tbody>
			
		</table>
		<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
		
			<thead>
				<tr>
					<th class="text-center">Services Date</th>
					<th class="text-center">Title</th>
					<th class="text-center">Done By</th>
					<th class="text-center">Done Status</th>
					<th class="text-center">Done Date</th>
					<th class="text-center">Done Descrition</th>
					
				</tr>
			</thead>
			<tbody>
			
			<?php
			
			foreach($tbl_manage as $tbl_manages){?>
					<tr>
					<td class="text-center"><?php echo  $tbl_manages['service_date']; ?></td>
					<td class="text-center"><?php echo  $tbl_manages['title']; ?></td>
					<td class="text-center"><?php echo $this->AMCfunction->getEmployeerName($tbl_manages['assign_to']);  ?></td>
					<td class="text-center"><?php if($tbl_manages['done_date']){ echo  'Done'; }else{ echo "Remain Service"; }   ?></td>
					<td class="text-center"><?php if($tbl_manages['done_date']){ echo  $tbl_manages['done_date']; }else{ echo "-"; }  ?></td>
					<td class="text-center <?php if($tbl_manages['done_date']){ echo  'more'; } ?>"><?php if($tbl_manages['done_date']){ echo  $tbl_manages['done_discription']; }else{ echo "-"; }  ?></td>
					
					</tr>
			<?php }
			}else{
				echo "No Service Added in Amc";
			}?>	
		  			</tbody>
			</table>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
		$(document).ready(function() {
	var showChar = 100;
	var ellipsestext = "...";
	var moretext = "more";
	var lesstext = "less";
	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);

			var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
});
		</script>
		<div class="modal-footer">
		<button type="button" class="btn btn-default printbtn" id="" onclick="PrintElem('.data_sales')" ><?php echo __('Print'); ?> </button> 
		<button type="button" class="btn btn-default" data-toggle="collapse" data-dismiss="modal"><?php echo __('Close'); ?></button>
      </div>
		
	 <?php  }
	}
		public function approvestatus($id = null){
			$this->autoRender = false;
			if($this->request->is('ajax')){
				$apporveid = $_POST['apporveid'];
				
				$tbl_amc =TableRegistry::get('tbl_amc');
				$row = $tbl_amc->get($apporveid);
					
							$stoke_p_data['is_appove'] = 0;
							$stoke_p_data['status'] = $row['employee_status'];
							$supply=$tbl_amc->patchEntity($row, $stoke_p_data);
							if($tbl_amc->save($supply))
							{
								echo 1;
							}
				
			}
		}
		public function declineidstatus($id = null){
			$this->autoRender = false;
			if($this->request->is('ajax')){
				$declineid = $_POST['declineid'];
				
				$tbl_amc =TableRegistry::get('tbl_amc');
				$row = $tbl_amc->get($declineid);
					
							$stoke_p_data['is_appove'] = 0;
							$supply=$tbl_amc->patchEntity($row, $stoke_p_data);
							if($tbl_amc->save($supply))
							{
								echo 1;
							}
				
			}
		}
	public function  index(){
		$this->redirect(array('controller'=>'amc','action'=>'viewamc'));
	}



	public function updateamc($id)
	{
		$this->TableAmc();
		$this->TableProduct();
		$this->TableUser();
		$this->TableAmcHistory();
		$this->TableCategory();
		$this->TableWarranty();


		$tbl_manage_service =TableRegistry::get('tbl_manage_service');
		$servicesss = $tbl_manage_service->find()->where(['sales_id'=>$id,['type'=>1]])->toArray();
		$countservice = $tbl_manage_service->find()->where(['sales_id'=>$id,['type'=>1]])->count();
		$this->set('totalservice',$countservice);
		$this->set('sales_services',$servicesss);
		
		$this->get_last_record= $this->table_amc->find()->select(['amc_id'])->last();
		$amc_idf=__('AMC').$this->get_last_record['amc_id'].rand(11,99).date('mY');
		$this->set('amc_idf',$amc_idf);
			/*Load employee Data*/
			$this->load_employee_data=$this->table_user->find()->where(array('role'=>'employee'));
			$this->set('employee_info',$this->load_employee_data);

		$product_data = $this->table_product->find();
		$this->set('product_row', $product_data);

		$client_data = $this->table_user->find()->where(array('role'=>'client'));
		$this->set('client_info', $client_data);

		$this->load_warranty_data=$this->table_warranty->find();
		$this->set('warranty_data',$this->load_warranty_data);

		$this->get_update_data = $this->table_amc->get($id);
		$this->set('update_row', $this->get_update_data);

		$history_record = $this->table_amc_history->find()->where(array('amc_id' => $id));
		$this->set('ah_histroy', $history_record);

		//$service_manage = $this->service_manage->find()->where(array('sales_id'=>$id))->toArray();
		//$service_manage = $this->service_manage->find()->where(array('sales_id' => $id))->toArray();
		//$this->set('servis_manage', $service_manage);

		$this->amctype_list=$this->table_category->find()->where(array('type'=>'amctype'));
		$this->set('amctypelist',$this->amctype_list);


		if ($this->request->is(array('post', 'put'))) {
			$ext = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
			$valid_extension = ['pdf',"csv","doc","docx","txt","xls","xlsx",""];
			if(!in_array($ext,$valid_extension) )
			{
				$this->Flash->success(__('Invalid File Attachment'));
				$this->redirect(array('controller'=>'amc','action'=>'viewamc'));
			}
			else
			{
			if($_FILES['attachment']['name'] != null && !empty($_FILES['attachment']['name'])){
				move_uploaded_file($_FILES['attachment']['tmp_name'],$this->attach_path.$_FILES['attachment']['name']);
				$this->store=$_FILES['attachment']['name'];
			}else{
				$this->store=$this->request->data('image2');
			}

			$up_data=$this->request->data;
			$up_data['attachment']=$this->store;

			$update_amc = $this->table_amc->patchEntity($this->get_update_data, $up_data);

			$query = $this->table_amc_history->query();
			$query->delete()->where(['amc_id' => $id])->execute();

			if ($query) {

				$product_arr = array();
				$product_arr = $this->request->data('product');

				if (isset($product_arr)) {
					foreach ($product_arr['product_id'] as $key => $value) {
						$this->table_ah_entity = $this->table_amc_history->newEntity();
						$data['amc_id'] = $id;
						$data['note'] = $product_arr['note'][$key];
						
						$data['item_name'] = $product_arr['product_id'][$key];
						
						//$data['warehouse_id']=$product_arr['warehouse_id'][$key];
						$add_data_ah = $this->table_amc_history->patchEntity($this->table_ah_entity, $data);
						if ($this->table_amc_history->save($add_data_ah)) {
						}
					}
				}
			}

			if($this->table_amc->save($update_amc)) {
				$this->Flash->success(__('AMC Record Updated Successfully'));
				return $this->redirect(array('controller' => 'amc', 'action' => 'viewamc'));
			}
		}
		}

	}

	public function viewamc(){
		$this->TableAmc();
		$userid = $this->request->session()->read('user_id');
		
		if($this->request->session()->read('user_role') =='client'){
			$get_amc_list=$this->table_amc->find()->where(array('customer_id'=>$userid))->toArray();
			
		}
		if($this->request->session()->read('user_role') == 'employee'){
			$get_amc_list=$this->table_amc->find()->where(array('assign_to_id'=>$this->request->session()->read('user_id')));
		
			
		}
		if($this->request->session()->read('user_role') =='admin'){
			$get_amc_list=$this->table_amc->find()->order(['is_appove'=>'DESC']);
		}
		
		
		
		$this->set('amclist',$get_amc_list);
	}

	public function amcreminder(){
			$this->TableAmc();
			$this->get_amc_list=$this->table_amc->find();
			$this->set('amclist',$this->get_amc_list);


	}

	public function delete($id){
		$this->TableAmc();
		$this->request->is(['post','delete']);
		$tbl_amc_history=TableRegistry::get('tbl_amc_history');
		
			$amcallrecord = $tbl_amc_history->find()->where(array('amc_id'=>$id))->toArray();
		
			if(!empty($amcallrecord))
			{
				foreach($amcallrecord as $amcallrecords)
				{
					$amcid = $amcallrecords['amc_h_id'];
					$deleteservice=$tbl_amc_history->get($amcid);
					$tbl_amc_history->delete($deleteservice);
				}
			}
		$this->row_delete=$this->table_amc->get($id);
		if($this->table_amc->delete($this->row_delete)){
			$this->Flash->success(__('AMC Record Deleted Successfully'));

			return $this->redirect(array('controller'=>'Amc','action'=>'viewamc'));
		}
			
	}

	public function viewamcservice(){
		$connection = ConnectionManager::get('default');
		$results = $connection->execute('select s.*,c.*,s.date as service_date,s.remark as service_remark,a.amc_no from tbl_service as s,tbl_complaint as c,tbl_amc as a where s.customer_id=c.customer_id or s.customer_id=a.customer_id')->fetchAll('assoc');
		$this->set('service_data',$results);

	}

	public function editviewamcservice(){
		$connection = ConnectionManager::get('default');
		$results = $connection->execute('select s.*,c.*,s.date as service_date,s.remark as service_remark,a.amc_no from tbl_service as s,tbl_complaint as c,tbl_amc as a where s.customer_id=c.customer_id or s.customer_id=a.customer_id and s.service_id=1
')->fetchAll('assoc');
		//var_dump($results);
	}

}
?>
