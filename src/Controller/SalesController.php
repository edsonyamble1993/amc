<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;
use Cake\Mailer\Email;


class SalesController extends AppController{

	public $table_sales;
	public $table_user;
	public $get_data_user;
	public $table_product;
	public $get_product_list;
	public $sales_table_entity;
	public $save_sales_data;
	public $getlast_record;
	public $table_sales_history;
	public $table_sh_entity;
	public $get_all_sales;
	public $row_delete;
	public $get_update_data;

	
	public function initialize(){
       parent::initialize();
	   $this->loadComponent('AMCfunction');
	   $this->table_user=TableRegistry::get('tbl_user');
       $this->table_product=TableRegistry::get('tbl_product');
       $this->table_sales=TableRegistry::get('tbl_sales');  
	   $this->table_sales_history=TableRegistry::get('tbl_sales_history');
   }
  
   public function index(){
   	$this->redirect(array('controller'=>'Sales','action'=>'viewsales'));
   }

   public function viewsales(){
	   $user_role=$this->request->session()->read('user_role');
	   $user_id=$this->request->session()->read('user_id');
	   if($user_role=='client'){
		   $table_sales =TableRegistry::get('tbl_sales');
		   $saledata = $table_sales->find()->where(['customer_id'=>$user_id]);
		   
		   $this->set('sales_row',$saledata);
	   }
	if($user_role=='admin' || $user_role=='employee'){
	   	$this->get_all_sales=$this->table_sales->find();
		   $this->set('sales_row',$this->get_all_sales);
		   }
   }

   public function updatesales($id){
	   
		$tbl_manage_service =TableRegistry::get('tbl_manage_service');
		$servicesss = $tbl_manage_service->find()->where(['sales_id'=>$id,'type'=>0])->toArray();
		$this->set('sales_services',$servicesss);
		
		$sale_account_tax =TableRegistry::get('sale_account_tax');
		$sale_account = $sale_account_tax->find()->where(['sale_id'=>$id])->toArray();
		$this->set('tax_account',$sale_account);
		
		
		$account_tax = TableRegistry::get('tbl_account_tax_rates');
		$account_tax_list=$account_tax->find();
   		$this->set('accout_tax',$account_tax_list);
		
		
	   	$this->getlast_record= $this->table_sales->find()->select(['sales_id'])->last();
		$quotation_idf=__('S').$this->getlast_record['sales_id'].rand(11,99).date('mY');
		$this->set('sales_idf',$quotation_idf);

		$product_data=$this->table_product->find()->where(array('is_archive'=>0));
		$this->set('product_row',$product_data);
		$client_data=$this->table_user->find()->where(array('role'=>'client','is_archive'=>0));
		$this->set('clinet_info',$client_data);
		// Load Employee
        	$this->load_employee_data=$this->table_user->find()->where(array('role'=>'employee','is_archive'=>0));
        	$this->set('employee_info',$this->load_employee_data);
		$this->get_update_data=$this->table_sales->get($id);
		$this->set('update_row',$this->get_update_data);
		
		$history_record=$this->table_sales_history->find()->where(array('sales_id'=>$id));
			$this->set('sh_histroy',$history_record);
			
			
		if($this->request->is(array('post','put'))){
			
			$update_sales=$this->table_sales->patchEntity($this->get_update_data,$this->request->data);
			$update_sales['assign_to']= $this->request->data('assign_to');
			
				$query = $this->table_sales_history->query();
				$query->delete()->where(['sales_id' => $id])->execute();
				$sale_account_tax=TableRegistry::get('sale_account_tax');
				$dataquery = $sale_account_tax->query();
				$dataquery->delete()->where(['sale_id' => $id])->execute();
			if($query){
				
			
				$product_arr=array();
				$product_arr=$this->request->data('product');
				$productid_Stock = array();
				if(isset($product_arr)){
					
				foreach($product_arr['product_id'] as $key => $value){
					$this->table_sh_entity=$this->table_sales_history->newEntity();
					$data['sales_id']=$id;
					$data['item_name']=$product_arr['product_id'][$key];
					$data['qty']=$product_arr['quantity'][$key];
					$data['price']=$product_arr['price'][$key];
					$data['net_amount']=$product_arr['amount'][$key];
					$productid_Stock[] = $product_arr['product_id'][$key];
					//$data['warehouse_id']=$product_arr['warehouse_id'][$key];
					$add_data_sh=$this->table_sales_history->patchEntity($this->table_sh_entity, $data);
					if($this->table_sales_history->save($add_data_sh)){
					}
				}
				}
				$account_arrya=$this->request->data('account');
				if(!empty($account_arrya))
				{
					foreach($account_arrya['tax_name'] as $key=>$value)
					{
						$sale_account_tax = TableRegistry::get('sale_account_tax');
						$tbl_account_tax_rates_entity=$sale_account_tax->newEntity();
						$acont['sale_id']=$id;
						$acont['tax_name'] = $account_arrya['tax_name'][$key];
						$acont['tax'] = $account_arrya['tax'][$key];
						
						$dataaccount=$sale_account_tax->patchEntity($tbl_account_tax_rates_entity, $acont);
					if($sale_account_tax->save($dataaccount)){
					}
					}
				}
				if(!empty($productid_Stock))
				{
					foreach($productid_Stock as $key => $value)
					{
						$perchasehistory = TableRegistry::get('tbl_purchase_history');
						$perchasehistorycount = $perchasehistory->find()->where(['item_name'=>$value])->hydrate(false)->toArray();
						$total = 0;
						if(count($perchasehistorycount))
						{
							
							foreach($perchasehistorycount as $qty)
							{
								$total += $qty['qty'];
							}
							
						}
						$sales_history = TableRegistry::get('tbl_sales_history');
						$saleshistorycount = $sales_history->find()->where(['item_name'=>$value])->hydrate(false)->toArray();
						$salestotal = 0;
						if(count($saleshistorycount))
						{
							
							foreach($saleshistorycount as $qty)
							{
								$salestotal += $qty['qty'];
							}
							
						}
						$stoketotal=$total-$salestotal;
						$tbl_stoke = TableRegistry::get('tbl_stoke');
						$perchasehistorycount = $tbl_stoke->find()->where(['product_id'=>$value])->hydrate(false)->toArray();
						
						if(count($perchasehistorycount) == 0)
						{
							$this->suplier=$tbl_stoke->newEntity();
							$stoke_p_data['number_of_stoke'] = $stoketotal;
							$stoke_p_data['product_id'] = $value;
							$supply=$tbl_stoke->patchEntity($this->suplier, $stoke_p_data);
							$tbl_stoke->save($supply);
						}else
						{
							
							$row = $tbl_stoke->get($perchasehistorycount[0]['id']);
							$stoke_p_data['number_of_stoke'] = $total;
							$stoke_p_data['product_id'] = $value;
							$supply=$tbl_stoke->patchEntity($row, $stoke_p_data);
							$tbl_stoke->save($supply);
						}
						
						
						
					}
				}
				$stokehistory = TableRegistry::get('tbl_stoke');
				$stokehistorydata = $stokehistory->find()->hydrate(false)->toArray();
				if(!empty($stokehistorydata))
				{
					foreach($stokehistorydata as $stokehistorydatass)
					{
							$no_of_stoke = $stokehistorydatass['number_of_stoke'];
							if($no_of_stoke == 0 || $no_of_stoke<0)
							{
								$stokeid = $stokehistorydatass['id'];
								$deletestoke = $stokehistory->get($stokeid);
								$stokehistory->delete($deletestoke);
							}
							
					}
				}
			}
			$service_manage=TableRegistry::get('tbl_manage_service');
			$servicesallrecord = $service_manage->find()->where(array('sales_id'=>$id))->toArray();
			
			if(!empty($servicesallrecord))
			{
				foreach($servicesallrecord as $servicesallrecords)
				{
					$servicesid = $servicesallrecords['id'];
					$deleteservice=$service_manage->get($servicesid);
					$service_manage->delete($deleteservice);
				}
			}
			
		
			
			
			
				
				$amc_typeid=$this->request->data('amc_typeid');
				if($amc_typeid == 1)
				{
					
				$service_schedule=$this->request->data('service');
				
				$this->service_manage=TableRegistry::get('tbl_manage_service');
				if(isset($service_schedule) && !empty($service_schedule)){
					
					foreach($service_schedule['service_date'] as $key => $value){
						
				    $table_ms_entity = $this->service_manage->newEntity();
					
					$data_ms['assign_to']=$this->request->data('assign_to');
					$data_ms['customer_id']=$this->request->data('customer_id');
					$data_ms['sales_id']=$id;
					$data_ms['service_date']=$service_schedule['service_date'][$key];
					
				
					$data_ms['title']=$service_schedule['service_text'][$key];
					
					$add_data_ms = $this->service_manage->patchEntity($table_ms_entity, $data_ms);
					
					if($this->service_manage->save($add_data_ms)){
						
					}
				
				}
					
					
					
				}
				
				}
		
			if($this->table_sales->save($update_sales)){
				$this->Flash->success(__('Sale Record Updated Successfully'));
				return $this->redirect(array('controller'=>'sales','action'=>'viewsales'));
			}
			
		}
   }
	public function saledetail($id = null){
		$this->autoRender = false;
	   if($this->request->is('ajax')){
		   $id = $_POST['id'];
		$table_sales =TableRegistry::get('tbl_sales');
		 if($id != null)  
		   $saledata = $table_sales->get($id);	
		$table_setting = TableRegistry::get('tble_setting');	   
		$first_data = $table_setting->find()->first();
		$table_history =TableRegistry::get('tbl_sales_history');
		$history_record=$table_history->find()->where(['sales_id'=>$id])->toArray();
		$tax_history =TableRegistry::get('sale_account_tax');
		$tax_record = $tax_history->find()->where(['sale_id'=>$id])->toArray();
		
		$tbl_manage_service = TableRegistry::get('tbl_manage_service');
		$tbl_manage=$tbl_manage_service->find()->where(['sales_id'=>$id])->toArray();
		
		
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
						<h5>Bill Number : <?php echo $saledata->bill_number; ?> </h5>
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
						<h4><?php echo $this->AMCfunction->getcompnysetupname(); ?></h4>
					</td>
					<td align="left" width="25%">
						<h4>Bill To </h4>
					</td>
				</tr>
				<tr>
					<td valign="top" width="75%" align="left">
						<b>Sale By : </b><?php echo $this->AMCfunction->getAdminname(); ?><br>					
						<b>Email: </b><?php echo $this->AMCfunction->getAdminemail(); ?> <br>	
						<b>Address: </b><?php echo $this->AMCfunction->getAdminaddress(); ?> <br></td>
					<td valign="top" width="25%" align="left">
						<b>Company Name :</b><?php echo $this->AMCfunction->getusercompanyname($saledata->customer_id); ?><br><b>Name : </b><?php echo $this->getuser_name($saledata->customer_id); ?><br><b>Mobile : </b><?php echo $saledata->mobile; ?>	<br><b>Email : </b><?php echo $saledata->email; ?>					</td>
				</tr>
			</tbody>
		</table>
		
		
		
		<hr/>
		<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
		<thead>
				<tr>
					<th class="text-center">Item Name</th>
					<th class="text-center"> Quantity</th>
					<th class="text-center">Price (<?php echo $this->AMCfunction->getCurrencyCode(); ?>)</th>
					<th class="text-center">Amount (<?php echo $this->AMCfunction->getCurrencyCode(); ?>)</th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			if(!empty($history_record)){
			foreach($history_record as $history_records){?>
					<tr>
					<td class="text-center"><?php echo  $this->AMCfunction->GetItemName($history_records->item_name); ?></td>
					<td class="text-center"><?php echo  $history_records->qty; ?></td>
					<td class="text-center"><?php echo  $history_records->price; ?></td>
					<td class="text-center"><?php echo  $history_records->net_amount; ?></td>
					
					</tr>
			<?php }
			} ?>		
		  			</tbody>
			
		</table>
		<?php 
		$total_amount_old=0;
		foreach($history_record as $history_records){
			
			$total_amount_old= $total_amount_old+$history_records->net_amount;
		}?>
		<table class="table" style="border:1px solid #ddd"  width="100%" CELLPADDING="10" CELLSPACING="10">
			<tr>
				<td>
					<TABLE BORDER="0" CELLPADDING="3" CELLSPACING="3" class="text-right" align="right">
					   <TD class="custom_field">Total Sale Amount(<?php echo $this->AMCfunction->getCurrencyCode(); ?>):</TD>
					   <TD class="custom_field"><?php echo $total_amount_old; ?></TD>
					   <TR>
					   <TD class="custom_field">Discount (<?php echo $this->AMCfunction->getCurrencyCode(); ?>) :</TD>
					   <TD class="custom_field"><?php echo $this->AMCfunction->GettaxRate($saledata->discount,$total_amount_old).'('.$saledata->discount.'%)'; ?></TD>
					   </TR>
					   <?php
$total_amount = 0;
		$discout = $this->AMCfunction->GettaxRate($saledata->discount,$total_amount_old); 
		
		$total_amount = $total_amount_old - $discout;
		
		
		 ?>
		 <?php
			
			$totaltax = 0;
			if(!empty($tax_record)){
			foreach($tax_record as $tax_records){?>
					<tr>
					<td class="custom_field"><?php echo  $tax_records->tax_name; ?>
					(<?php echo  $tax_records->tax.'%'; ?>) :</td>
					<td class="custom_field"><?php echo  $this->AMCfunction->GettaxRate($tax_records->tax,$total_amount); ?>
					<?php $totaltax += $this->AMCfunction->GettaxRate($tax_records->tax,$total_amount); ?></td>
					</tr>
			<?php }
			}	?>
			<tr>
			<td class="custom_field" colspan='2' align='right'>
			<hr/>
			Total  Amount (<?php echo $this->AMCfunction->getCurrencyCode(); ?>): &nbsp; &nbsp; <?php echo $total_amount+$totaltax; ?>
			</td>
			</tr>
					   </TABLE>
					   
					</TD>
				</td>
				<!--<td colspan="2" class="text-right" align="right"><span style="padding-right:50px;">Total Sale Amount (<?php echo $this->AMCfunction->getCurrencyCode(); ?>): &nbsp; &nbsp; </span><span><?php echo $total_amount_old; ?></span><br/>
				<span style="padding-right:50px;">Discount (<?php echo $this->AMCfunction->getCurrencyCode(); ?>) : &nbsp; &nbsp; </span><span><?php echo $this->AMCfunction->GettaxRate($saledata->discount,$total_amount_old).'('.$saledata->discount.'%)'; ?></span><br/>
			<?php
$total_amount = 0;
		$discout = $this->AMCfunction->GettaxRate($saledata->discount,$total_amount_old); 
		
		$total_amount = $total_amount_old - $discout;
		
		
		 ?>
		 <?php
			
			$totaltax = 0;
			if(!empty($tax_record)){
			foreach($tax_record as $tax_records){?>
					<span style="width:50px;padding-right:50px"><?php echo  $tax_records->tax_name; ?>
					(<?php echo  $tax_records->tax.'%'; ?>) :</span>
					<span><?php echo  $this->AMCfunction->GettaxRate($tax_records->tax,$total_amount); ?>
					<?php $totaltax += $this->AMCfunction->GettaxRate($tax_records->tax,$total_amount); ?></span>
					<br/>
			<?php }
			}	?>
			<hr/>
			Total  Amount (<?php echo $this->AMCfunction->getCurrencyCode(); ?>): &nbsp; &nbsp; <?php echo $total_amount+$totaltax; ?>
		</td>-->
			</tr>
	
		</table><hr/>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
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
					
				</tr>
			</thead>
			<tbody>
			
			<?php
			
			foreach($tbl_manage as $tbl_manages){?>
					<tr>
					<td class="text-center"><?php echo  date($this->AMCfunction->getDateFormat(),strtotime($tbl_manages['service_date'])); ?></td>
					<td class="text-center"><?php echo  $tbl_manages['title']; ?></td>
					
					</tr>
			<?php }
			}?>	
		  			</tbody>
			</table>
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default printbtn" id="" onclick="PrintElem('.data_sales')" ><?php echo __('Print'); ?> </button> 
		<button type="button" class="btn btn-default" data-toggle="collapse" data-dismiss="modal"><?php echo __('Close'); ?></button>
      </div>
		
	 <?php  }
	}
	
	
	public function getuser_name($id){
			
		
			$user_table=TableRegistry::get('tbl_user');
			
			$get_user_count=$user_table->find()->where(array('user_id'=>$id))->count();
			
		if($get_user_count > 0){
			
			$user_name=$user_table->get($id);
			$name=$user_name['first_name'].' '.$user_name['last_name'];
			
			return $name;
			
		}else{
			return 'Invalid';
		}
			
			
		}
	
   public function delete($id){
	   $this->request->is(['post','delete']);
			
			$service_manage=TableRegistry::get('tbl_manage_service');
			$servicesallrecord = $service_manage->find()->where(array('sales_id'=>$id))->toArray();
			
			if(!empty($servicesallrecord))
			{
				foreach($servicesallrecord as $servicesallrecords)
				{
					$servicesid = $servicesallrecords['id'];
					$deleteservice=$service_manage->get($servicesid);
					$service_manage->delete($deleteservice);
				}
			}
			
			
			$service_manage=TableRegistry::get('tbl_manage_service');
			$servicesallrecord = $service_manage->find()->where(array('sales_id'=>$id))->toArray();
			
			if(!empty($servicesallrecord))
			{
				foreach($servicesallrecord as $servicesallrecords)
				{
					$servicesid = $servicesallrecords['id'];
					$deleteservice=$service_manage->get($servicesid);
					$service_manage->delete($deleteservice);
				}
			}
			$tbl_sales_history=TableRegistry::get('tbl_sales_history');
			$tblsalesallrecord = $tbl_sales_history->find()->where(array('sales_id'=>$id))->toArray();
			$productid_Stock = array();
			if(!empty($tblsalesallrecord))
			{
				foreach($tblsalesallrecord as $tblsalesallrecords)
				{
					$service_h_id = $tblsalesallrecords['sales_h_id'];
					$productid_Stock[] = $tblsalesallrecords['item_name'];
					$deleteservice=$tbl_sales_history->get($service_h_id);
					$tbl_sales_history->delete($deleteservice);
				}
			}
			$this->row_delete=$this->table_sales->get($id);
			if($this->table_sales->delete($this->row_delete)){
				if(!empty($productid_Stock))
				{
					foreach($productid_Stock as $key => $value)
					{
						$perchasehistory = TableRegistry::get('tbl_purchase_history');
						$perchasehistorycount = $perchasehistory->find()->where(['item_name'=>$value])->hydrate(false)->toArray();
						$total = 0;
						if(count($perchasehistorycount))
						{
							
							foreach($perchasehistorycount as $qty)
							{
								$total += $qty['qty'];
							}
							
						}
						$tbl_stoke = TableRegistry::get('tbl_stoke');
						$perchasehistorycount = $tbl_stoke->find()->where(['product_id'=>$value])->hydrate(false)->toArray();
						
						if(count($perchasehistorycount) == 0)
						{
							$this->suplier=$tbl_stoke->newEntity();
							$stoke_p_data['number_of_stoke'] = $total;
							$stoke_p_data['product_id'] = $value;
							$supply=$tbl_stoke->patchEntity($this->suplier, $stoke_p_data);
							$tbl_stoke->save($supply);
						}else
						{
							
							$row = $tbl_stoke->get($perchasehistorycount[0]['id']);
							$stoke_p_data['number_of_stoke'] = $total;
							$stoke_p_data['product_id'] = $value;
							$supply=$tbl_stoke->patchEntity($row, $stoke_p_data);
							$tbl_stoke->save($supply);
						}
						
						
						
					}
				}
				$stokehistory = TableRegistry::get('tbl_stoke');
				$stokehistorydata = $stokehistory->find()->hydrate(false)->toArray();
				if(!empty($stokehistorydata))
				{
					foreach($stokehistorydata as $stokehistorydatass)
					{
							$no_of_stoke = $stokehistorydatass['number_of_stoke'];
							if($no_of_stoke == 0 || $no_of_stoke<0)
							{
								$stokeid = $stokehistorydatass['id'];
								$deletestoke = $stokehistory->get($stokeid);
								$stokehistory->delete($deletestoke);
							}
							
					}
				}
				$this->Flash->success(__('Sale Record Deleted Successfully'));

				return $this->redirect(array('controller'=>'sales','action'=>'viewsales'));
			}
		}
   
   

   	public function sales($id=null){
		
		if(isset($id) && !empty($id)){
			
				 $table_quotation=TableRegistry::get('tbl_quotation'); 
                 $table_quotation_history=TableRegistry::get('tbl_quotation_history');
			
			   $get_quotation_data=$table_quotation->get($id);
		       $this->set('set_quotation',$get_quotation_data);
		       $quotation_history_record=$table_quotation_history->find()->where(array('quotation_id'=>$id))->toArray();
			   
			   if(count($quotation_history_record) > 0){
				    $this->set('qh_histroy',$quotation_history_record);
			     }
			    $quatation_account_tax=TableRegistry::get('quatation_account_tax');
			  
			   $quatation_account_tax_record = $quatation_account_tax->find()->where(array('quation_id'=>$id))->toArray();
			   if(count($quatation_account_tax_record) > 0){
				    $this->set('account_history',$quatation_account_tax_record);
			     }
			 
			 
			
			
			
			
			
			
			
			
		}
		
		
		
		$this->table_category=TableRegistry::get('category_master');
		$this->amctype_list=$this->table_category->find()->where(array('type'=>'amctype'))->toArray();
			$this->set('amctypelist',$this->amctype_list);

		
		$this->getlast_record= $this->table_sales->find()->select(['sales_id'])->last();
		$quotation_idf=__('S').$this->getlast_record['sales_id'].rand(11,99).date('mY');
		$this->set('sales_idf',$quotation_idf);
		
		 $table_quotation=TableRegistry::get('tbl_quotation'); 
		 $get_all_quo_record=$table_quotation->find()->order(array('quotation_id'=>'DESC'))->toArray();
		 $get_quotation_no=array();
		 if(count($get_all_quo_record) > 0){
				
				foreach($get_all_quo_record as $key_quotation=>$val_quotation){
						
						
					$get_quotation_no[$key_quotation]=$val_quotation['quotation_no'];
					
				}
			 
				$this->set('quo_no',$get_quotation_no);
			 
		 }
		 
		 
			
		 
		
		
		 // Load Employee
        	$this->load_employee_data=$this->table_user->find()->where(array('role'=>'employee','is_archive'=>0));
        	$this->set('employee_info',$this->load_employee_data);
		
		$this->get_data_user=$this->table_user->find()->where(array('role'=>'client','is_archive'=>0))->toArray();
		$this->set('clinet_info',$this->get_data_user);
		

   		$this->get_product_list=$this->table_product->find()->where(array('is_archive'=>0));
   		$this->set('product_row',$this->get_product_list);
		$account_tax = TableRegistry::get('tbl_account_tax_rates');
		$account_tax_list=$account_tax->find();
   		$this->set('accout_tax',$account_tax_list);
   		$this->sales_table_entity=$this->table_sales->newEntity();
		
			
		
		
		
		
		
		
		
   		if($this->request->is('post')){
				
			$product_arr=array();
			$product_arr=$this->request->data('product');
			$getstock = array();			
			if(isset($product_arr) && !empty($product_arr)){
			foreach($product_arr['product_id'] as $key => $value){
					
					$item = $product_arr['product_id'][$key];
					$quantity = $product_arr['quantity'][$key];
					$getstock[] = $this->AMCfunction->getstockornot($item , $quantity);
				}
				}

				if(in_array(1,$getstock))
				{
					$this->Flash->success(__("You Can't Sale, Out Of Stock!!"));
					return $this->redirect(array('controller'=>'sales','action'=>'sales'));
			
				}else
				{
					$this->save_sales_data=$this->table_sales->patchEntity($this->sales_table_entity,$this->request->data);
   			$this->save_sales_data['assign_to'] = $this->request->data('assign_to');
			if($this->table_sales->save($this->save_sales_data)){
   				$s_id = $this->table_sales->find()->select(['sales_id'])->last();
				$sale_id = $s_id->sales_id;
				$product_arr=array();
				$product_arr=$this->request->data('product');
				
				$amc_typeid=$this->request->data('amc_typeid');
				if($amc_typeid == 1)
				{
					
				$service_schedule=$this->request->data('service');
				$this->service_manage=TableRegistry::get('tbl_manage_service');
				if(isset($service_schedule) && !empty($service_schedule)){
					
					foreach($service_schedule['service_date'] as $key => $value){
						
				    $table_ms_entity = $this->service_manage->newEntity();
					
					$data_ms['sales_id']=$sale_id;
					$data_ms['service_date']=$service_schedule['service_date'][$key];
					$data_ms['title']=$service_schedule['service_text'][$key];
					$data_ms['assign_to']=$this->request->data('assign_to');
					$data_ms['customer_id']=$this->request->data('customer_id');
					
					$add_data_ms = $this->service_manage->patchEntity($table_ms_entity, $data_ms);
					
					if($this->service_manage->save($add_data_ms)){
						
					}
				
				}
					
					
					
				}
				
				}
				
				if(isset($product_arr) && !empty($product_arr)){
				foreach($product_arr['product_id'] as $key => $value){
					$this->table_sh_entity=$this->table_sales_history->newEntity();
					$sh_data['sales_id']=$s_id['sales_id'];
					$sh_data['item_name']=$product_arr['product_id'][$key];
					$sh_data['qty']=$product_arr['quantity'][$key];
					$sh_data['price']=$product_arr['price'][$key];
					$sh_data['net_amount']=$product_arr['amount'][$key];
					$productid_Stock[] = $product_arr['product_id'][$key];
					$add_data_sh=$this->table_sales_history->patchEntity($this->table_sh_entity, $sh_data);
					if($this->table_sales_history->save($add_data_sh)){
					}
				}
				}
				$account_arrya=$this->request->data('account');
				
				if(!empty($account_arrya))
				{
					foreach($account_arrya['tax_name'] as $key=>$value)
					{
						$sale_account_tax = TableRegistry::get('sale_account_tax');
						$tbl_account_tax_rates_entity=$sale_account_tax->newEntity();
						$acont['sale_id']=$sale_id;
						$acont['tax_name'] = $account_arrya['tax_name'][$key];
						$acont['tax'] = $account_arrya['tax'][$key];
						
						$dataaccount=$sale_account_tax->patchEntity($tbl_account_tax_rates_entity, $acont);
					if($sale_account_tax->save($dataaccount)){
					}
					}
				}
				
				if(!empty($productid_Stock))
				{
					foreach($productid_Stock as $key => $value)
					{
						$perchasehistory = TableRegistry::get('tbl_purchase_history');
						$perchasehistorycount = $perchasehistory->find()->where(['item_name'=>$value])->hydrate(false)->toArray();
						$total = 0;
						if(count($perchasehistorycount))
						{
							
							foreach($perchasehistorycount as $qty)
							{
								$total += $qty['qty'];
							}
							
						}
						$sales_history = TableRegistry::get('tbl_sales_history');
						$saleshistorycount = $sales_history->find()->where(['item_name'=>$value])->hydrate(false)->toArray();
						$salestotal = 0;
						if(count($saleshistorycount))
						{
							
							foreach($saleshistorycount as $qty)
							{
								$salestotal += $qty['qty'];
							}
							
						}
						$stoketotal=$total-$salestotal;
						$tbl_stoke = TableRegistry::get('tbl_stoke');
						$perchasehistorycount = $tbl_stoke->find()->where(['product_id'=>$value])->hydrate(false)->toArray();
						
						if(count($perchasehistorycount) == 0)
						{
							$this->suplier=$tbl_stoke->newEntity();
							$stoke_p_data['number_of_stoke'] = $stoketotal;
							$stoke_p_data['product_id'] = $value;
							$supply=$tbl_stoke->patchEntity($this->suplier, $stoke_p_data);
							$tbl_stoke->save($supply);
						}else
						{
							
							$row = $tbl_stoke->get($perchasehistorycount[0]['id']);
							$stoke_p_data['number_of_stoke'] = $total;
							$stoke_p_data['product_id'] = $value;
							$supply=$tbl_stoke->patchEntity($row, $stoke_p_data);
							$tbl_stoke->save($supply);
						}
						
						
						
					}
				}
				$stokehistory = TableRegistry::get('tbl_stoke');
				$stokehistorydata = $stokehistory->find()->hydrate(false)->toArray();
				if(!empty($stokehistorydata))
				{
					foreach($stokehistorydata as $stokehistorydatass)
					{
							$no_of_stoke = $stokehistorydatass['number_of_stoke'];
							if($no_of_stoke == 0 || $no_of_stoke<0)
							{
								$stokeid = $stokehistorydatass['id'];
								$deletestoke = $stokehistory->get($stokeid);
								$stokehistory->delete($deletestoke);
							}
							
					}
				}
				
				$stokehistory = TableRegistry::get('tbl_stoke');
				$stokehistorydata = $stokehistory->find()->hydrate(false)->toArray();
				if(!empty($stokehistorydata))
				{
					foreach($stokehistorydata as $stokehistorydatass)
					{
							$no_of_stoke = $stokehistorydatass['number_of_stoke'];
							if($no_of_stoke == 0 || $no_of_stoke<0)
							{
								$stokeid = $stokehistorydatass['id'];
								$deletestoke = $stokehistory->get($stokeid);
								$stokehistory->delete($deletestoke);
							}
							
					}
				}
				
				
				$sales_lstdata=$this->table_sales->find()->last();
				$id = $sales_lstdata['sales_id'];
				
		$table_sales =TableRegistry::get('tbl_sales');
		 if($id != null)  
		   $saledata = $table_sales->get($id);	
		$table_setting = TableRegistry::get('tble_setting');	   
		$first_data = $table_setting->find()->first();
		$table_history =TableRegistry::get('tbl_sales_history');
		$history_record=$table_history->find()->where(['sales_id'=>$id])->toArray();
		$tax_history =TableRegistry::get('sale_account_tax');
		$tax_record = $tax_history->find()->where(['sale_id'=>$id])->toArray();
		
		$tbl_manage_service = TableRegistry::get('tbl_manage_service');
		$tbl_manage=$tbl_manage_service->find()->where(['sales_id'=>$id])->toArray();
		$this->setting_image=WWW_ROOT.'img';
		
		$message = '<div class="data_sales">
		<hr>
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="75%">
						<img style="max-height:80px;" src="'.$this->setting_image.'/setting/'.$first_data->logo.'">
					</td>
					<td align="left" width="25%">
						<h5>Bill Number : '.$saledata->bill_number.'</h5>
						<h5>Date : '. $saledata->date.'</h5>
						<h5>Status :'. $saledata->status.'</h5>
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
						'.$saledata->address.'					</td>
					<td valign="top" width="25%" align="left">
						<b>Name : </b>'.$this->getuser_name($saledata->customer_id).'<br><b>Remark : </b>'.$saledata->remark.'<br><b>Mobile : </b>'.$saledata->mobile.'<br><b>Email : </b>'. $saledata->email.'					</td>
				</tr>
			</tbody>
		</table>
		
		<br><br>
		
		<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
		<thead>
				<tr>
					<th class="text-center">Item Name</th>
					<th class="text-center"> Quantity</th>
					<th class="text-center">Price </th>
					<th class="text-center">Amount </th>
				</tr>
			</thead>
			<tbody>
			
			';
			if(!empty($history_record)){
			foreach($history_record as $history_records){
					$message .= '<tr>
					<td class="text-center">'.$this->AMCfunction->GetItemName($history_records->item_name).'</td>
					<td class="text-center">'.$history_records->qty.'</td>
					<td class="text-center">'.$this->AMCfunction->getCurrencyCode() . $history_records->price.'</td>
					<td class="text-center">'.$this->AMCfunction->getCurrencyCode() . $history_records->net_amount.'</td>
					
					</tr>';
			 }
			} 	
		  			$message .= '</tbody>
			
		</table>';
		
		$total_amount=0;
		foreach($history_record as $history_records){
			
			$total_amount= $total_amount+$history_records->net_amount;
		}
		
		$message .= '<table class="table" style="border:1px solid #ddd"  width="100%">
			<tr>
				<td colspan="2" class="text-right" align="right">Total Sale Amount</td>
				<td colspan="2" class="text-center" align="center">'.$this->AMCfunction->getCurrencyCode() . $total_amount.'</td>
			
			</tr>
	
		</table><br><br><hr/><br><br>
		
		
		<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
		<thead>
				<tr>
					<th class="text-center">Tax Name</th>
					<th class="text-center"> Tax</th>
					<th class="text-center">Amount </th>
				</tr>
			</thead>
			<tbody>';
			
			
			
			$totaltax = 0;
			if(!empty($tax_record)){
			foreach($tax_record as $tax_records){ 
					$message .= '<tr>
					<td class="text-center">'.$tax_records->tax_name.'</td>
					<td class="text-center">'.$tax_records->tax.'% </td>
					<td class="text-center">'.$this->AMCfunction->getCurrencyCode() . $this->AMCfunction->GettaxRate($tax_records->tax,$total_amount) .'</td>
					</tr>';
			 }
			}
			$totalamoutofsale = 0;
			if(!empty($tax_record)){
			foreach($tax_record as $tax_recordss){ 
$totaltax += $this->AMCfunction->GettaxRate($tax_recordss->tax,$total_amount);	
	}
	$totalamoutofsale = $total_amount + $totaltax;
			}		
		  			$message .= '</tbody>
			
		</table>
		<table class="table" style="border:1px solid #ddd"  width="100%">
			<tr>
				<td colspan="2" class="text-right" align="right">Total Tax Amount</td>
				<td colspan="2" class="text-center" align="center">'.$this->AMCfunction->getCurrencyCode() . $totaltax.'</td>
			
			</tr>
	
		</table>
		<table class="table" style="border:1px solid #ddd"  width="100%">
			<tr>
				<td colspan="2" class="text-right" align="right">Total  Amount:</td>
				<td colspan="2" class="text-center" align="center">'.$this->AMCfunction->getCurrencyCode() .  $totalamoutofsale .'</td>
			
			</tr>
	
		</table>
		<hr/>';
		
		if(!empty($tbl_manage)){ 
		$message .= '<table width="100%" border="0">
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
					
				</tr>
			</thead>
			<tbody>';
			
			
			
			foreach($tbl_manage as $tbl_manages){
					$message .= '<tr>
					<td class="text-center">'.$tbl_manages['service_date'].'</td>
					<td class="text-center">'.$tbl_manages['title'].'</td>
					
					</tr>';
			 }
			}
		  			$message .= '</tbody>
			</table>
			
			
		</div>';
						$tble_setting = TableRegistry::get('tble_setting');
						$mailformate = $tble_setting->find()->first();
						$sendmail = $mailformate['mail_send'];
						$title_name = $mailformate['title_name'];
						
						$tbl_sales = TableRegistry::get('tbl_sales');
						$lastsaledetail = $tbl_sales->find()->last();
						$customerid = $lastsaledetail['customer_id'];
						$create_date = $lastsaledetail['create_date'];
						$customername = $this->AMCfunction->getEmployeerName($customerid);
						$customeremail = $this->AMCfunction->getEmployeerEmail($customerid);
						$mail_notification = TableRegistry::get('tbl_mail_notification');
						$mailformate = $mail_notification->find()->where(['notification_for'=>'seles_notification'])->first();
						$mailformat = $mailformate['notification_text'];
						$subject = $mailformate['subject'];
						$serch = array('{ username }','{ amount }','{ date }','{ invoice }','{ systemname }');
						$replace = array($customername,$totalamoutofsale,$create_date,$message,$title_name);
						$message_content = str_replace($serch, $replace, $mailformat);
						$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From:'. $mailformate['send_from'] . "\r\n";
						//send mail
						
						if($sendmail == 1)
						{
							$remote_add = $_SERVER['REMOTE_ADDR'];
							$server_add = $_SERVER['SERVER_ADDR'];
							if($remote_add != $server_add)
							{
								mail($customeremail,$subject,$message_content,$headers);
							}else{
								$to = $customeremail;
								$email = new Email('default');
								$email->from('das@dasinfomedia.com')
								->emailFormat('html')
								->to($to)
								->subject($subject)
								->send($message_content);
							}
						}
				$this->Flash->success(__('Sale Record Inserted Successfully'));
				$this->redirect(array('controller'=>'Sales','action'=>'viewsales'));
   			}
				}
				
   			
		}
   			
   		
		}
   		
}  	

?>