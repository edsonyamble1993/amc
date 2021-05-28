<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FlashHelper;
use Cake\I18n\Time;
use Cake\Console\ConsoleOutput;
use Cake\Mailer\Email;

class QuotationController extends AppController{

	public $table_product;
	public $table_user;
	public $getlast_record;
	public $quotation_entity;
	public $table_quotation;
	public $quotation_data;
	public $save_quotation_data;
	public $table_quotation_history;
	public $table_qh_entity;
	public $get_quotation_data;
	public $get_update_data;
	public $delete_row;


	public function initialize(){
		parent::initialize();
		 $this->loadComponent('AMCfunction');
	}
	
	public function TableProduct(){$this->table_product=TableRegistry::get('tbl_product');	}
	public function TableClient(){ $this->table_user=TableRegistry::get('tbl_user'); }
	public function TableQuotation(){ $this->table_quotation=TableRegistry::get('tbl_quotation'); }
	public function TableQuotationHistory(){ $this->table_quotation_history=TableRegistry::get('tbl_quotation_history'); }
	

	public function quotationlist(){
		  $user_role=$this->request->session()->read('user_role');
	   $user_id=$this->request->session()->read('user_id');
		$this->TableQuotation();
		 if($user_role=='client'){
		   $table_quotation =TableRegistry::get('tbl_quotation');
		   $quotation = $table_quotation->find()->where(['customer_id'=>$user_id]);
		   
		   $this->set('quotation_info',$quotation);
	   }
			if($user_role=='admin' || $user_role=='employee'){
		$this->get_quotation_data=$this->table_quotation->find();
		$this->set('quotation_info',$this->get_quotation_data);
			}

        
	}

	public function delete($id){
   			$this->TableQuotation();
   			  $this->delete_row = $this->table_quotation->get($id);

    		$this->request->is(array('post','delete'));

    		if($this->table_quotation->delete($this->delete_row)){
				$this->Flash->success(__('Quotation Record Delete Successfully', null), 'default', array('class' => 'success'));
			
		}
		
			$tbl_quotation_history=TableRegistry::get('tbl_quotation_history');
			$tblquotationallrecord = $tbl_quotation_history->find()->where(array('quotation_id'=>$id))->toArray();
			
			if(!empty($tblquotationallrecord))
			{
				foreach($tblquotationallrecord as $tblquotationallrecords)
				{
					$tblequotation = $tblquotationallrecords['quotation_history_id'];
					$deletequoatation=$tbl_quotation_history->get($tblequotation);
					$tbl_quotation_history->delete($deletequoatation);
				}
			}
		return $this->redirect(array('controller'=>'quotation','action'=>'quotationlist'));
	
	}

	public function index(){
		$this->redirect(array('controller'=>'quotation','action'=>'quotationlist'));
	}
	
 public function updatequotation($id){

		$this->TableProduct();
		$this->TableClient();
		$this->TableQuotation();
		$this->TableQuotationHistory();
		$product_data=$this->table_product->find()->where(array('is_archive'=>0));
		$this->set('product_row',$product_data);
		$client_data=$this->table_user->find()->where(array('role'=>'client'));
		$this->set('clinet_info',$client_data);
		$this->get_update_data=$this->table_quotation->get($id);
		$this->set('update_row',$this->get_update_data);
		$history_record=$this->table_quotation_history->find()->where(array('quotation_id'=>$id));
		$this->set('qh_histroy',$history_record);
			$sale_account_tax =TableRegistry::get('quatation_account_tax');
		$sale_account = $sale_account_tax->find()->where(['quation_id'=>$id])->toArray();
		$this->set('tax_account',$sale_account);
			$account_tax = TableRegistry::get('tbl_account_tax_rates');
		$account_tax_list=$account_tax->find();
   		$this->set('accout_tax',$account_tax_list);
		if($this->request->is(array('post','put'))){
			$update_quotation=$this->table_quotation->patchEntity($this->get_update_data,$this->request->data);
			
			
				$query = $this->table_quotation_history->query();
				$query->delete()->where(['quotation_id' => $id])->execute();
				$sale_account_tax=TableRegistry::get('quatation_account_tax');
				$dataquery = $sale_account_tax->query();
				$dataquery->delete()->where(['quation_id' => $id])->execute();
			
			if($query){
				
			
				$product_arr=array();
				$product_arr=$this->request->data('product');
			
				if(isset($product_arr)){
				foreach($product_arr['product_id'] as $key => $value){
					$this->table_qh_entity=$this->table_quotation_history->newEntity();
					$data['quotation_id']=$id;
					$data['item_name']=$product_arr['product_id'][$key];
					$data['qty']=$product_arr['quantity'][$key];
					$data['price']=$product_arr['price'][$key];
					$data['net_amount']=$product_arr['amount'][$key];
					//$data['warehouse_id']=$product_arr['warehouse_id'][$key];
					$add_data_qh=$this->table_quotation_history->patchEntity($this->table_qh_entity, $data);
					if($this->table_quotation_history->save($add_data_qh)){
					}
				}
				}
			}
$account_arrya=$this->request->data('account');
				if(!empty($account_arrya))
				{
					foreach($account_arrya['tax_name'] as $key=>$value)
					{
						$sale_account_tax = TableRegistry::get('quatation_account_tax');
						$tbl_account_tax_rates_entity=$sale_account_tax->newEntity();
						$acont['quation_id']=$id;
						$acont['tax_name'] = $account_arrya['tax_name'][$key];
						$acont['tax'] = $account_arrya['tax'][$key];
						
						$dataaccount=$sale_account_tax->patchEntity($tbl_account_tax_rates_entity, $acont);
					if($sale_account_tax->save($dataaccount)){
					}
					}
				}

			if($this->table_quotation->save($update_quotation)){
				$this->Flash->success(__('Quotation Record Updated Successfully'));
				return $this->redirect(array('controller'=>'quotation','action'=>'quotationlist'));
			}
			
		}
			
			
			
			
		
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
	
	public function quotationdetail($id = null){
		$this->autoRender = false;
	   if($this->request->is('ajax')){
		    $id = $_POST['id'];
			$table_quotation =TableRegistry::get('tbl_quotation');
		 if($id != null)  
		   $quotationdata = $table_quotation->get($id);
		$table_setting = TableRegistry::get('tble_setting');
		$first_data = $table_setting->find()->first();
		$quatation_account_tax =TableRegistry::get('quatation_account_tax');
		$tax_record = $quatation_account_tax->find()->where(['quation_id'=>$id])->toArray();
		$table_history =TableRegistry::get('tbl_quotation_history');
		$history_record=$table_history->find()->where(['quotation_id'=>$id])->toArray();
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
						<strong>Quotation Number : </strong><?php echo $quotationdata->quotation_no; ?> <br>
						<strong>Date : </strong> <?php echo date('Y-m-d',strtotime($quotationdata->quotation_date)); ?> <br>
						</td>
				</tr>
			</tbody>
		</table>
		<hr/>
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td align="left" width="70%">
						<h4><?php echo $this->AMCfunction->getcompnysetupname(); ?></h4>
					</td>
					<td align="left" width="30%">
						<h4>Quotation To </h4>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left" width="70%">
						<b>Quotation By : </b><?php echo $this->AMCfunction->getAdminname(); ?><br>					
						<b>Email: </b><?php echo $this->AMCfunction->getAdminemail(); ?> <br>	
						<b>Address: </b><?php echo $this->AMCfunction->getAdminaddress(); ?> <br>	
						</td>				
					<td valign="top" align="left" width="30%">
						<b>Company Name :</b><?php echo $this->AMCfunction->getusercompanyname($quotationdata->customer_id); ?><br><b>Name : </b><?php echo $this->getuser_name($quotationdata->customer_id); ?><br><b>Email : </b><?php echo $quotationdata->email; ?>		<br><b>Mobile : </b><?php echo $quotationdata->mobile; ?></td>
				</tr>
			</tbody>
		</table>
		<hr/>
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td align="left">
						<h4>Message</h4>
					</td>
					
				</tr>
				<tr>
					<td valign="top" align="left">
						<?php echo $quotationdata->message; ?> 					</td>
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
					<th class="text-center" width="50%">Item Name</th>
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
				<td colspan="2" class="text-right" align="right">Total Quotation Amount (<?php echo $this->AMCfunction->getCurrencyCode(); ?>): &nbsp; &nbsp<?php echo $total_amount; ?> <br/>
				<?php
			
			$totaltax = 0;
			if(!empty($tax_record)){
			foreach($tax_record as $tax_records){?>
					
					<?php echo  $tax_records->tax_name; ?>
					(<?php echo  $tax_records->tax.'%'; ?>) : &nbsp; &nbsp;	
					<?php echo  $this->AMCfunction->GettaxRate($tax_records->tax,$total_amount); ?>
					<?php $totaltax += $this->AMCfunction->GettaxRate($tax_records->tax,$total_amount); ?>
					<br/>
			<?php }
			} ?>
			<hr/>
				
				Total  Amount (<?php echo $this->AMCfunction->getCurrencyCode(); ?>): &nbsp; &nbsp; <?php echo $total_amount+$totaltax; ?>
				</td>
			
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
	
	public function addquotation($id = NULL){
		
		$this->TableProduct();
		$this->TableClient();
		$this->TableQuotation();
		$this->TableQuotationHistory();
		$product_data=$this->table_product->find()->where(array('is_archive'=>0));
		$this->set('product_row',$product_data);
		$client_data=$this->table_user->find()->where(array('role'=>'client'));
		$this->set('clinet_info',$client_data);
		$account_tax = TableRegistry::get('tbl_account_tax_rates');
		$account_tax_list=$account_tax->find();
   		$this->set('accout_tax',$account_tax_list);

		$this->getlast_record= $this->table_quotation->find()->select(['quotation_id'])->last();
		$quotation_idf=__('Q').$this->getlast_record['quotation_id'].rand(11,99).date('mY');
		$this->set('quotation_id',$quotation_idf);
		
		if($this->request->is(array('post'))){
			$this->quotation_entity=$this->table_quotation->newEntity();
			$this->quotation_data=$this->request->data;
			$this->save_quotation_data=$this->table_quotation->patchEntity($this->quotation_entity,$this->quotation_data);

            //debug($this->quotation_data);
           
			if($this->table_quotation->save($this->save_quotation_data)){
				
				$q_id=$this->table_quotation->find()->select(['quotation_id'])->last();
				//$quatation_id = $q_id['quotation_id'];
				$quatation_id = $this->save_quotation_data->quotation_id;
				$product_arr=array();
				$product_arr=$this->request->data('product');
                
                 if(!empty($product_arr['product_id'][0])){
                      foreach($product_arr['product_id'] as $key => $value){
				 $this->table_qh_entity=$this->table_quotation_history->newEntity();
				 $qh_data['quotation_id']=$q_id['quotation_id'];
				 $qh_data['item_name']=$product_arr['product_id'][$key];
				 $qh_data['qty']=$product_arr['quantity'][$key];
				 $qh_data['price']=$product_arr['price'][$key];
				 $qh_data['net_amount']=$product_arr['amount'][$key];
				 $add_data_qh=$this->table_quotation_history->patchEntity($this->table_qh_entity, $qh_data);
				 if($this->table_quotation_history->save($add_data_qh)){
					 
					
                        }
                      }
                  }
				 $account_arrya=$this->request->data('account');
				
				if(!empty($account_arrya))
				{
					foreach($account_arrya['tax_name'] as $key=>$value)
					{
						$sale_account_tax = TableRegistry::get('quatation_account_tax');
						$tbl_account_tax_rates_entity=$sale_account_tax->newEntity();
						$acont['quation_id']=$quatation_id;
						$acont['tax_name'] = $account_arrya['tax_name'][$key];
						$acont['tax'] = $account_arrya['tax'][$key];
						
						$dataaccount=$sale_account_tax->patchEntity($tbl_account_tax_rates_entity, $acont);
					if($sale_account_tax->save($dataaccount)){
					}
					}
				}
		$lastqueationid = $this->getlast_record['quotation_id'];
		$table_quotation =TableRegistry::get('tbl_quotation');
		$quotationdata = $table_quotation->get($quatation_id);
		$table_setting = TableRegistry::get('tble_setting');
		$first_data = $table_setting->find()->first();
		$table_history =TableRegistry::get('tbl_quotation_history');
		$history_record=$table_history->find()->where(['quotation_id'=>$quatation_id])->toArray();
		$message = '<div class="data_quotation">
		<br/><br/>
		<hr/>
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="70%">
						<img style="max-height:80px;" src="../img/setting/'.$first_data->logo.'">
					</td>
					<td align="left" width="30%">
						<strong>Quotation Number : </strong>'.$quotationdata->quotation_no.'<br>
						<strong>Date : </strong> '.date($this->AMCfunction->getDateFormat(),strtotime($quotationdata->quotation_date)).'<br>
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
						<h4>Quotation To </h4>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left" width="70%">
						<b>Contact Person : </b>'.$quotationdata->contact_person.'<br>					
						<b>Reference Number : </b>'.$quotationdata->reference_no.'<br>					
						<b>Billing Address: </b>'.$quotationdata->address.'<br>	</td>				
					<td valign="top" align="left" width="30%">
						<b>Name : </b>'.$this->getuser_name($quotationdata->customer_id) .'<br><b>Subject	 : </b>'.$quotationdata->subject.'<br><b>Mobile : </b>'.$quotationdata->mobile.'<br><b>Email : </b>'.$quotationdata->email.'</td>
				</tr>
			</tbody>
		</table>
		<hr/>
		
		
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td align="left">
						<h4>Message</h4>
					</td>
					
				</tr>
				<tr>
					<td valign="top" align="left">
						'.$quotationdata->message.'</td>
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
					<th class="text-center">Price </th>
					<th class="text-center">Amount </th>
				</tr>
			</thead>
			<tbody>';
			
			
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
				<td colspan="2" class="text-right" align="right">Grand Total</td>
				<td colspan="2" class="text-center" align="center">'.$this->AMCfunction->getCurrencyCode().$total_amount.'</td>
			
			</tr>
	
		</table>
		<hr/>
		</div>';
		$tble_setting = TableRegistry::get('tble_setting');
						$mailformate = $tble_setting->find()->first();
						$sendmail = $mailformate['mail_send'];
						$title_name = $mailformate['title_name'];
		$tbl_quotation = TableRegistry::get('tbl_quotation');
						$lastsaledetail = $tbl_quotation->find()->last();
						$customerid = $lastsaledetail['customer_id'];
						$create_date = $lastsaledetail['quotation_date'];
						$customername = $this->AMCfunction->getEmployeerName($customerid);
						$customeremail = $this->AMCfunction->getEmployeerEmail($customerid);
						$mail_notification = TableRegistry::get('tbl_mail_notification');
						$mailformate = $mail_notification->find()->where(['notification_for'=>'queotation_mail'])->first();
						$mailformat = $mailformate['notification_text'];
						$subject = $mailformate['subject'];
						$serch = array('{ username }','{ date }','{ invoice }','{ systemname }');
						$replace = array($customername,$create_date,$message,$title_name);
						$message_content = str_replace($serch, $replace, $mailformat);
			
		$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:'. $mailformate['from'] . "\r\n";
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

				$this->Flash->success(__('Quotation Record Inserted Successfully'));
				$this->redirect(array('controller'=>'Quotation','action'=>'quotationlist'));
			
		}
	}
		
	
		
	}
	
}

?>

