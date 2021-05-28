<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;


class PurchaseController extends AppController
{

    public $table_purchase;
    public $table_user;
    public $get_data_user;
    public $table_product;
    public $get_product_list;
    public $purchase_table_entity;
    public $save_purchase_data;
    public $getlast_record;
    public $table_purchase_history;
    public $table_ph_entity;
    public $get_all_purchase;
    public $row_delete;
    public $get_update_data;
    public $get_employee_data;


    public function initialize()
    {
        parent::initialize();
        $this->table_user = TableRegistry::get('tbl_user');
        $this->table_product = TableRegistry::get('tbl_product');
        $this->table_purchase = TableRegistry::get('tbl_purchase');
        $this->table_purchase_history = TableRegistry::get('tbl_purchase_history');
        $this->table_category = TableRegistry::get('category_master');
		$this->loadComponent('AMCfunction');
    }

    public function index()
    {
        $this->redirect(array('controller' => 'Purchase', 'action' => 'viewpurchase'));
    }

    public function viewpurchase()
    {
        $this->get_all_purchase = $this->table_purchase->find()->hydrate(false)->toArray();;
        $this->set('purchase_row', $this->get_all_purchase);
    }

public function purchasedetail($id = null){
		$this->autoRender = false;
	   if($this->request->is('ajax')){
		    $id = $_POST['id'];
			$tbl_purchase =TableRegistry::get('tbl_purchase');
		 if($id != null)  
		   $quotationdata = $tbl_purchase->get($id);
		$table_setting = TableRegistry::get('tble_setting');
		$first_data = $table_setting->find()->first();
		$table_history =TableRegistry::get('tbl_purchase_history');
		$history_record=$table_history->find()->where(['purchase_id'=>$id])->toArray();
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
						<strong>Purchase Number : </strong><?php echo $quotationdata->purchase_no; ?> <br>
						
						<strong>Date : </strong> <?php echo date($this->AMCfunction->getDateFormat(),strtotime($quotationdata->created_date)); ?> <br>
						
					</td>
				</tr>
			</tbody>
		</table>
		<hr/>
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td align="left" width="70%">
						<h4>Other information</h4>
					</td>
					<td align="left" width="30%">
						<h4>Supplier Detail</h4>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left" width="70%">
						<b>Contact Person : </b><?php echo $quotationdata->contact_person; ?> <br>					
									
						<b>Billing Address: </b><?php echo $quotationdata->billing_address; ?> <br>	</td>				
					<td valign="top" align="left" width="30%">
						<b>Name : </b><?php echo $this->AMCfunction->getSupplierName($quotationdata->supplier_id); ?><br><b>Email : </b><?php echo $quotationdata->email; ?>					</td>
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
				<td colspan="2" class="text-right" align="right">Grand Total (<?php echo $this->AMCfunction->getCurrencyCode(); ?>): &nbsp; &nbsp;<?php echo $total_amount; ?> </td>
			
			</tr>
	
		</table>
</div>
<div class="modal-footer">
		<button type="button" class="btn btn-default printbtn" id="" onclick="PrintElem('.data_quotation')" ><?php echo __('Print'); ?> </button> 
		<button type="button" class="btn btn-default" data-toggle="collapse" data-dismiss="modal"><?php echo __('Close'); ?></button>
      </div>
	   <?php
	   }
	}
    public function updatepurchase($id)
    {

        $get_all_status=$this->table_category->find()->where(array('type'=>'purchase_status'))->toArray();

        if(count($get_all_status)> 0){
            $this->set('purchase_status',$get_all_status);

        }
		$tbl_supplier = TableRegistry::get('tbl_supplier');
        $get_all_suppliername=$tbl_supplier->find()->toArray();
        if(count($get_all_suppliername) > 0){
            $this->set('supplier_name',$get_all_suppliername);
        }



        $this->get_data_user = $this->table_user->find()->where(array('role' => 'client'));
        $this->set('client_info', $this->get_data_user);

        $this->get_employee_data = $this->table_user->find()->where(array('role' => 'employee'));
        $this->set('employee_info', $this->get_employee_data);


        $this->get_product_list = $this->table_product->find();
        $this->set('product_row', $this->get_product_list);

        $this->get_update_data = $this->table_purchase->get($id);
        $this->set('update_row', $this->get_update_data);

        $history_record = $this->table_purchase_history->find()->where(array('purchase_id' => $id));
        $this->set('ph_histroy', $history_record);


        if ($this->request->is(array('post', 'put'))) {
				
				
            $update_purchase = $this->table_purchase->patchEntity($this->get_update_data, $this->request->data);

            $product_arr = $this->request->data('product');
			
			
			$productid_Stock = array();
            foreach ($product_arr['product_id'] as $key => $value) {

					
                if (!empty($product_arr['ph_id'][$key]) && isset($product_arr['ph_id'][$key])) {

                    $product_history_table = TableRegistry::get('tbl_purchase_history');
                    $ph_update = $product_history_table->get($product_arr['ph_id'][$key]);
                    $ph_update_data['purchase_id'] = $id;
                    $ph_update_data['item_name'] = $product_arr['product_id'][$key];
                    $ph_update_data['qty'] = $product_arr['quantity'][$key];
                    $ph_update_data['price'] = $product_arr['price'][$key];
                    $ph_update_data['net_amount'] = $product_arr['amount'][$key];
					$productid_Stock[] = $product_arr['product_id'][$key];
                    $update = $product_history_table->patchEntity($ph_update, $ph_update_data);
                    $product_history_table->save($update);


                } else {
					
					
                    $product_history_table = TableRegistry::get('tbl_purchase_history');
                    $ph_entity = $product_history_table->newEntity();
                    $ph_insert_data['purchase_id'] = $id;
                    $ph_insert_data['item_name'] = $product_arr['product_id'][$key];
                    $ph_insert_data['qty'] = $product_arr['quantity'][$key];
                    $ph_insert_data['price'] = $product_arr['price'][$key];
                    $ph_insert_data['net_amount'] = $product_arr['amount'][$key];
					$productid_Stock[] = $product_arr['product_id'][$key];
                    $save_data = $product_history_table->patchEntity($ph_entity, $ph_insert_data);
                    $product_history_table->save($save_data);

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
            if ($this->table_purchase->save($update_purchase)) {
                $this->Flash->success(__('Purchase Record Updated Successfully'));
                return $this->redirect(array('controller' => 'Purchase', 'action' => 'viewpurchase'));
            }

        }
    }


   public function delete($id){
	   
				$this->request->is(['post','delete']);
			$tbl_purchase_history=TableRegistry::get('tbl_purchase_history');
			$purchaseallrecord = $tbl_purchase_history->find()->where(array('purchase_id'=>$id))->toArray();
			$productid_Stock = array();
			if(!empty($purchaseallrecord))
			{
				foreach($purchaseallrecord as $purchaseallrecordss)
				{
					$tblequotation = $purchaseallrecordss['purchase_h_id'];
					$deletequoatation=$tbl_purchase_history->get($tblequotation);
					$productid_Stock[] = $purchaseallrecordss['item_name'];
					$tbl_purchase_history->delete($deletequoatation);
				}
			}
			
			$this->row_delete=$this->table_purchase->get($id);
			if($this->table_purchase->delete($this->row_delete)){
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
				$this->Flash->success(__('Record Deleted Successfully'));

				return $this->redirect(array('controller'=>'purchase','action'=>'viewpurchase'));
			}
		}
   
   

   	public function purchase(){
		$supplier = TableRegistry::get('tbl_supplier');
				$get_last_userid= $supplier->find()->select(['id'])->last();
				$this->user_entity=$supplier->newEntity();
				$supplier_idf=__('S').$this->getlast_record['id'].rand(11,99).date('mY');
				$this->set('supplier_idf',$supplier_idf);

	
			$getlast_record= $this->table_product->find()->select(['product_id'])->last();
			$product_idf=__('PR').$getlast_record['product_id'].rand(11,99).date('mY');
			$this->set('productidf',$product_idf);
				
		  
			
			// Brand list
			$this->brand_list=$this->table_category->find()->where(array('type'=>'brand'));
			$this->set('brandlist',$this->brand_list);
			// Category list
			$this->category_list=$this->table_category->find()->where(array('type'=>'category'));
			$this->set('categorylist',$this->category_list);
			//Unit list
			$this->unit_list=$this->table_category->find()->where(array('type'=>'unit'));
			$this->set('unitlist',$this->unit_list);
			//warehouse
			$this->warehouse_list=$this->table_category->find()->where(array('type'=>'warehouse'));
			$this->set('warehouselist',$this->warehouse_list);
		
			$get_all_status=$this->table_category->find()->where(array('type'=>'purchase_status'))->toArray();
			if(count($get_all_status)> 0){
				$this->set('purchase_status',$get_all_status);

			}
			$supplier = TableRegistry::get('tbl_supplier');
			$get_all_suppliername=$supplier->find()->toArray();
			if(count($get_all_suppliername) > 0){
				$this->set('supplier_name',$get_all_suppliername);
			}
			

		$this->getlast_record= $this->table_purchase->find()->select(['purchase_id'])->last();
		$quotation_idf=__('P').$this->getlast_record['purchase_id'].rand(11,99).date('mY');
		$this->set('purchase_idf',$quotation_idf);
		
		$this->get_data_user=$this->table_user->find()->where(array('role'=>'client'));
		$this->set('client_info',$this->get_data_user);

		$this->get_employee_data=$this->table_user->find()->where(array('role'=>'employee'));
		$this->set('employee_info',$this->get_employee_data);
		

   		$this->get_product_list=$this->table_product->find();
   		$this->set('product_row',$this->get_product_list);

	  



   		$this->purchase_table_entity=$this->table_purchase->newEntity();
   		if($this->request->is('post')){
					
   			$this->save_purchase_data=$this->table_purchase->patchEntity($this->purchase_table_entity,$this->request->data);
   			if($this->table_purchase->save($this->save_purchase_data)){
   				$p_id=$this->table_purchase->find()->select(['purchase_id'])->last();
				$product_arr=array();
				$product_arr=$this->request->data('product');
				
				if(isset($product_arr['product_id']) && !empty($product_arr['product_id'])){
					
					$productid_Stock = array();
				foreach($product_arr['product_id'] as $key => $value){
					
					$this->table_ph_entity=$this->table_purchase_history->newEntity();
					$ph_data['purchase_id']=$p_id['purchase_id'];
					$ph_data['item_name']=$product_arr['product_id'][$key];
					$ph_data['qty']=$product_arr['quantity'][$key];
					$ph_data['price']=$product_arr['price'][$key];
					$ph_data['net_amount']=$product_arr['amount'][$key];
					$add_data_ph=$this->table_purchase_history->patchEntity($this->table_ph_entity, $ph_data);
					$productid_Stock[] = $product_arr['product_id'][$key];
					
					
					
					if($this->table_purchase_history->save($add_data_ph)){
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
				
				$this->Flash->success(__('Record Inserted Successfully'));
				return $this->redirect(array('controller'=>'purchase','action'=>'viewpurchase'));
			
   			}
		}
   			
   		
		}
   		
}  	

?>