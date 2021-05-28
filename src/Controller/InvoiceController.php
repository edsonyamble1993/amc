<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;



class InvoiceController extends AppController{

	public $table_invoice;
	public $table_user;
	public $get_data_user;
	public $table_product;
	public $get_product_list;
	public $invoice_table_entity;
	public $save_invoice_data;
	public $getlast_record;
	public $table_invoice_history;
	public $table_ih_entity;
	public $get_all_invoice;
	public $row_delete;
	public $get_update_data;

	
	public function initialize(){
       parent::initialize();
	    $this->loadComponent('AMCfunction');
	   $this->table_user=TableRegistry::get('tbl_user');
       $this->table_product=TableRegistry::get('tbl_product');
       $this->table_invoice=TableRegistry::get('tbl_invoice');  
	   $this->table_invoice_history=TableRegistry::get('tbl_invoice_history');
   }
   
   public function index(){
   	$this->redirect(array('controller'=>'Invoice','action'=>'viewinvoice'));
   }

   public function viewinvoice(){
	    $user_role=$this->request->session()->read('user_role');
	   $user_id=$this->request->session()->read('user_id');
	    if($user_role=='client'){
		   $table_invoice =TableRegistry::get('tbl_invoice');
		   $invoicedata = $table_invoice->find()->where(['customer_id'=>$user_id]);
		   
		   $this->set('invoice_row',$invoicedata);
	   }
	   if($user_role=='admin' || $user_role=='employee'){
	   	$this->get_all_invoice=$this->table_invoice->find();
		   $this->set('invoice_row',$this->get_all_invoice);
	   }
   }

   public function updateinvoice($id){

	   	$this->getlast_record= $this->table_invoice->find()->select(['invoice_id'])->last();
		$invoice_idf=__('I').$this->getlast_record['invoice_id'].rand(11,99).date('mY');
		$this->set('invoice_idf',$invoice_idf);

		$product_data=$this->table_product->find();
		$this->set('product_row',$product_data);
		$client_data=$this->table_user->find();
		$this->set('clinet_info',$client_data);

		$this->get_update_data=$this->table_invoice->get($id);
		$this->set('update_row',$this->get_update_data);
		
		$history_record=$this->table_invoice_history->find()->where(array('invoice_id'=>$id));
			$this->set('ih_histroy',$history_record);
				
		if($this->request->is(array('post','put'))){
			$update_invoice=$this->table_invoice->patchEntity($this->get_update_data,$this->request->data);
		
				$query = $this->table_invoice_history->query();
				$query->delete()->where(['invoice_id' => $id])->execute();
			
			if($query){
				$product_arr=array();
				$product_arr=$this->request->data('product');
			
				if(isset($product_arr)){
				foreach($product_arr['product_id'] as $key => $value){
					$this->table_ih_entity=$this->table_invoice_history->newEntity();
					$data['invoice_id']=$id;
					$data['item_name']=$product_arr['product_id'][$key];
					$data['qty']=$product_arr['quantity'][$key];
					$data['price']=$product_arr['price'][$key];
					$data['net_amount']=$product_arr['amount'][$key];
					//$data['warehouse_id']=$product_arr['warehouse_id'][$key];
					$add_data_ih=$this->table_invoice_history->patchEntity($this->table_ih_entity, $data);
					if($this->table_invoice_history->save($add_data_ih)){
					}
                    }
				}
			}


			if($this->table_invoice->save($update_invoice)){
				$this->Flash->success(__('Invoice Record Updated Successfully'));
				return $this->redirect(array('controller'=>'invoice','action'=>'viewinvoice'));
			}			
		}
   }

   public function delete($id){
	   $this->request->is(['post','delete']);
			$this->row_delete=$this->table_invoice->get($id);
			if($this->table_invoice->delete($this->row_delete)){
				$this->Flash->success(__('Invoice Record Deleted Successfully'));
				return $this->redirect(array('controller'=>'invoice','action'=>'viewinvoice'));
			}
		}
   
   public function invoicedetail($id = null){
	   $this->autoRender = false;
	    if($this->request->is('ajax')){
			$id = $_POST['id'];
			$table_invoice =TableRegistry::get('tbl_invoice');
			 if($id != null) 
			$invoicedata = $table_invoice->get($id);
		$table_setting = TableRegistry::get('tble_setting');	   
		$first_data = $table_setting->find()->first();
		$table_history =TableRegistry::get('tbl_invoice_history');
		$history_record=$table_history->find()->where(['invoice_id'=>$id])->toArray();
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
		<div class="data_invoice">
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="70%">
						<img style="max-height:80px;" src="../img/setting/<?php echo $first_data->logo; ?>">
					</td>
					<td align="right" width="24%">
						<h5>Invoice Number : <?php echo $invoicedata->invoice_no; ?> </h5>
						<h5>Invoice For : <?php echo $invoicedata->invoice_for; ?> </h5>
						<h5>Date : <?php echo $invoicedata->date; ?> </h5>
						<h5>Status :<?php echo $invoicedata->status; ?></h5>
					</td>
				</tr>
			</tbody>
		</table>
		<hr/>
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td align="left">
						<h4>Other information</h4>
					</td>
					<td align="right">
						<h4>Invoice To </h4>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
						<b>Contact Person : </b><?php echo $invoicedata->contact_person; ?> <br>					
						<b>Reference Number : </b><?php echo $invoicedata->reference_no; ?> <br>					
						<b>Billing Address: </b><?php echo $invoicedata->address; ?> <br>	</td>				
					<td valign="top" align="right">
						<b>Name : </b><?php echo $this->AMCfunction->GetUserFullname($invoicedata->customer_id); ?><br><b>Subject	 : </b><?php echo $invoicedata->subject; ?><br><b>Mobile : </b><?php echo $invoicedata->mobile; ?>	<br><b>Email : </b><?php echo $invoicedata->email; ?>					</td>
				</tr>
			</tbody>
		</table>
		<hr/>
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
			}else
			{ ?>
		
				No Data Available
			<?php }				?>		
		  			</tbody>
		</table>
		<?php 
		$total_amount=0;
		foreach($history_record as $history_records){
			
			$total_amount= $total_amount+$history_records->net_amount;
		}?>
		<table class="table" style="border:1px solid #ddd"  width="100%">
			<tr>
				<td colspan="2" class="text-right" align="right"><?php echo __('Grand Total:'); ?></td>
				<td colspan="2" class="text-center" align="center"><?php echo $total_amount; ?></td>
			
			</tr>
	
		</table>
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default printbtn" id="" onclick="PrintElem('.data_invoice')" ><?php echo __('Print'); ?> </button> 
		<button type="button" class="btn btn-default" data-toggle="collapse" data-dismiss="modal"><?php echo __('Close'); ?></button>
      </div>
		<?php }
   }

   	public function addinvoice(){

		$this->getlast_record= $this->table_invoice->find()->select(['invoice_id'])->last();
		$invoice_idf=__('I').$this->getlast_record['invoice_id'].rand(11,99).date('mY');
		$this->set('invoice_no',$invoice_idf);
		
		$this->get_data_user=$this->table_user->find();
		$this->set('clinet_info',$this->get_data_user);
		

   		$this->get_product_list=$this->table_product->find();
   		$this->set('product_row',$this->get_product_list);

   		$this->invoice_table_entity=$this->table_invoice->newEntity();
        
   		if($this->request->is('post')){
					
   			$this->save_invoice_data=$this->table_invoice->patchEntity($this->invoice_table_entity,$this->request->data);
   			if($this->table_invoice->save($this->save_invoice_data)){
   				$i_id=$this->table_invoice->find()->select(['invoice_id'])->last();
				$product_arr=array();
				$product_arr=$this->request->data('product');
				
				
				foreach($product_arr['product_id'] as $key => $value){
					$this->table_ih_entity=$this->table_invoice_history->newEntity();
					$ih_data['invoice_id']=$i_id['invoice_id'];
					$ih_data['item_name']=$product_arr['product_id'][$key];
					$ih_data['qty']=$product_arr['quantity'][$key];
					$ih_data['price']=$product_arr['price'][$key];
					$ih_data['net_amount']=$product_arr['amount'][$key];
					$add_data_ih=$this->table_invoice_history->patchEntity($this->table_ih_entity, $ih_data);
					if($this->table_invoice_history->save($add_data_ih)){
					}
				}
				$this->Flash->success(__('Invoice Record Inserted Successfully'));
   			}
		}
   			
   		
		}
   		
}  	

?>