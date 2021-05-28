<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;
use Cake\Routing\Route\Route;

class StokeController extends AppController
{
	 public function initialize()
    {
        parent::initialize();
		$this->loadComponent('AMCfunction');
	}
	public function stokes()
    {
		$tbl_stoke=TableRegistry::get('tbl_stoke');
		$stokelist=$tbl_stoke->find();
		$this->set('stokelist',$stokelist);
    }
	 public function delete($id){
	   
	   $this->request->is(['post','delete']);
	   $tbl_stoke=TableRegistry::get('tbl_stoke');
			$this->row_delete=$tbl_stoke->get($id);
			if($tbl_stoke->delete($this->row_delete)){
				$this->Flash->success(__('Stock Record Deleted Successfully'));

				return $this->redirect(array('controller'=>'stoke','action'=>'stokes'));
			}
		}
		public function stokedetail($id = null){
		$this->autoRender = false;
	   if($this->request->is('ajax')){
		    $id = $_POST['id'];
			 
			$tbl_stoke =TableRegistry::get('tbl_stoke');
		 if($id != null)  
		   
		$stokedata = $tbl_stoke->find()->where(['id'=>$id])->first();
		$productid = $stokedata['product_id'];
		
		$tbl_purchase_history =TableRegistry::get('tbl_purchase_history');
		$history_record = $tbl_purchase_history->find()->where(['item_name'=>$productid])->toArray();;
		
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
					
				</tr>
			</tbody>
		</table>
		<hr/>
		
		
		
		
		<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
		<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Product Code</th>
					<th class="text-center">Product Name</th>
					
					<th class="text-center">Purchase Date </th>
					<th class="text-center">Supplier Name</th>
					<th class="text-center">Quantity </th>
					
				</tr>
			</thead>
			<tbody>
			
			<?php
			if(!empty($history_record)){
				$i = 1;
			foreach($history_record as $history_records){?>
					<tr>
					<td class="text-center"><?php echo  $i; ?></td>
					<td class="text-center"><?php echo  $this->AMCfunction->GetItemCode($history_records->item_name); ?></td>
					<td class="text-center"><?php echo  $this->AMCfunction->GetItemName($history_records->item_name); ?></td>
					<td class="text-center"><?php echo date($this->AMCfunction->getDateFormat(), strtotime($history_records->create_date)); ?></td>
					<td class="text-center"><?php echo  $this->AMCfunction->GetsupplierNameFrompurchase($history_records->purchase_id); ?></td>
					<td class="text-center"><?php echo  $history_records->qty; ?></td>
					
					</tr>
					
			<?php $i++; }
			}else
			{ ?>
		
				No Data Available
			<?php }				?>		
		  			</tbody>
		</table>
		<?php 
		$total_amount=0;
		if(!empty($history_record)){
		foreach($history_record as $history_records){
			
			$total_amount= $total_amount+$history_records->qty;
		}
		}?>
		<table class="table" style="border:1px solid #ddd"  width="100%">
			<tr>
				<td colspan="2" class="text-right" align="right">Total Stock: &nbsp; &nbsp; <?php echo $total_amount; ?></td>
			
			</tr>
	
		</table>
		<table class="table" style="border:1px solid #ddd"  width="100%">
			<tr>
				<td colspan="2" class="text-right" align="right">Sell Product: &nbsp; &nbsp; <?php echo $this->AMCfunction->GetSellProduct($id); ?></td>
			
			</tr>
	
		</table>
		<table class="table" style="border:1px solid #ddd"  width="100%">
			<tr>
				<?php $curent_stoke = $total_amount - $this->AMCfunction->GetSellProduct($id); ?>
				<td colspan="2" class="text-right" align="right">current Stoke: &nbsp; &nbsp; <?php echo $curent_stoke; ?></td>
			
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
}