<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;
use Cake\Mailer\Email;



class AjaxController extends AppController{
	public $table_category;
	public $brand_entity;
	public $brand;
	public $category;
	public $category_entity;
	public $unit;
	public $unit_entity;
	public $warehouse;
	public $warehouse_entity;
	public $getproduct_id;
	public $table_product;
	public $amctype;
	public $amctype_entity;
	public $complaint_type;
	public $complaint_entity;
	public $designation;
	public $designation_entity;
	public $tasktype;
	public $tasktype_entity;
	
	public function initialize(){
	
       parent::initialize();
	   $this->loadComponent('Flash');
	   $this->loadComponent('AMCfunction');
	   $this->table_category=TableRegistry::get('category_master');	
	   $this->table_product=TableRegistry::get('tbl_product');
	  
   }

   	public function getproduct(){
   		$this->autoRender = false;
   		if($this->request->is('ajax')){
   			$this->getproduct_id=$_POST['product'];
   			$product_info=$this->table_product->get($this->getproduct_id);
   			echo json_encode($product_info);
   		}
   	}
	public function addsupplier()
	{
		$this->autoRender = false;
		$tbl_supplier=TableRegistry::get('tbl_supplier');
		$newsuplier = $tbl_supplier->newEntity();
		$newsuplier['supplier_code'] = $_POST['supplier_no'];
		$newsuplier['first_name'] = $_POST['first_name'];
		$newsuplier['last_name'] = $_POST['last_name'];
		$newsuplier['address_line'] = $_POST['address_line'];
		$newsuplier['supplier_company'] = $_POST['supplier_company'];
		$newsuplier['city'] = $_POST['city'];
		$newsuplier['state'] = $_POST['state'];
		$newsuplier['country'] = $_POST['country'];
		$newsuplier['zip_code'] = $_POST['zip_code'];
		$newsuplier['email'] = $_POST['email'];
		$newsuplier['mobile_no'] = $_POST['mobile_no'];
		$tbl_supplier->save($newsuplier);
		$supllierrecord = $tbl_supplier->find()->last();
		$suplirdata = array();
		$suplirdata['id'] = $supllierrecord['id'];
		$suplirdata['supplier_code'] = $supllierrecord['supplier_code'];
		$suplirdata['first_name'] = $supllierrecord['first_name'];
		$suplirdata['last_name'] = $supllierrecord['last_name'];
		
		$dataofsuppiler = json_encode($suplirdata);
   	echo $dataofsuppiler;
		
	}
   	public function getservices()
	{	
		$this->autoRender = false;
		if($this->request->is('ajax')){
		$interval = $_POST['interval']; 
		$no_service = $_POST['no_service'];
		
		
		
		$new_interval=$interval;
			
				$new_interval_array=array();
			$no_service_arry=array();
			$get_service_data=date('Y-m-d');
		
		
				$addmonth=(int)$interval;
				for($j=1;$j<=$no_service;$j++){
					
					$no_service_date = date('Y-m-d', strtotime("+".$addmonth." months", strtotime($get_service_data)));
					
					$get_service_data=$no_service_date;
					
					$no_service_arry[$get_service_data]=("$j Service");
					
					?>
					<table class="table" align="center" style="width:80%;">
					<tr class="data_of_type">
						<td class="text-center"><?php echo $j; ?></td>
						<td class="text-center"><input type="text" class="form-control first_width" value="<?php echo $no_service_date; ?>" name="service[service_date][]"></td>
						<td class="text-center"><input type="text" class="form-control second_width" name="service[service_text][]" value="<?php echo $no_service_arry[$get_service_data];?>" ></td>
						</tr>
					</table>
					<?php
				}
				
				
		}	
	}
	public function addbrand(){
		$this->autoRender = false;
   		if($this->request->is('ajax')){
                    $this->brand = $_POST['brand_name'];
                    $check_record=$this->table_category->find()->where(array('title' => $this->brand))->andwhere(array('type'=>'brand'))->count();
                    $this->brand_entity= $this->table_category->newEntity();
                    $this->brand_entity['type']=__('brand');
                    $this->brand_entity['title']=$this->brand;
                    if((int)$check_record == 0){
                       if($this->table_category->save($this->brand_entity)){
                           $brand_id=$this->brand_entity['cat_id'];
                         }
                  echo $brand_id;
                   }else{
                   	echo '0';
                   }

		}
	}




	public function addpurchasestatus(){
		$this->autoRender=false;
		if($this->request->is('ajax')){

  				$addpurchasestatus = $_POST['status_name'];
                    $check_record_status=$this->table_category->find()->where(array('title' =>$addpurchasestatus))->count();
                    $status_entity= $this->table_category->newEntity();
                    $status_entity['type']=__('purchase_status');
                    $status_entity['title']=$addpurchasestatus;
                    if((int)$check_record_status == 0){
                       if($this->table_category->save($status_entity)){
                           $status_id=$status_entity['cat_id'];
                         }
                  		echo $status_id;
                   }else{
                   	echo '0';
                   }

		}
	}
	public function addproduct(){
		$this->autoRender=false;
		
			
			
			
			if($this->request->is('post')){
			
				if($_FILES['image']['name'] != null && !empty($_FILES['image']['name'])){
					$img_default=$_FILES['image']['name'];
				}else{
					$img_default='default.png';
				}
			
				if($this->request->data['image']){
					$image=$this->request->data['image'];
					$store=$this->product_image.$image['name'];
					if(move_uploaded_file($image['tmp_name'], $store)){
					}
				}
					
				$this->product_data=$this->request->data;

				$this->product_data['image']=$img_default;
                
                
            
                
                
               
                
				
				$save_product_data=$this->table_product->patchEntity($this->table_product_entity,$this->product_data);
				
				
				
				if($this->table_product->save($save_product_data)){
                           $status_id=$save_product_data['product_id'];
                        
                  		echo $status_id;
                   }else{
                   	echo '0';
                   }
				
				
				
				
			}
		}
	public function getsupplierdata(){
		$this->autoRender=false;
		
  				
			$supplier_id=$_REQUEST['supplier_id'];
		$suply_table=TableRegistry::get('tbl_supplier');
		$get_cust_record=$suply_table->get($supplier_id);
		
		echo json_encode($get_cust_record);

		
	}
	
	public function addsuppliername(){
		$this->autoRender=false;
		if($this->request->is('ajax')){

  				$addsuppliername = $_POST['supplier_name'];
                    $check_record_sname=$this->table_category->find()->where(array('title' =>$addsuppliername))->count();
                    $supplier_name_entity= $this->table_category->newEntity();
                    $supplier_name_entity['type']=__('supplier_name');
                    $supplier_name_entity['title']=$addsuppliername;
                    if((int)$check_record_sname == 0){
                       if($this->table_category->save($supplier_name_entity)){
                           $supplier_id=$supplier_name_entity['cat_id'];
                         }
                  		echo $supplier_id;
                   }else{
                   	echo '0';
                   }

		}
	}
	
	public function addcategory(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$this->category = $_POST['category_name'];
			$check_record=$this->table_category->find()->where(array('title' => $this->category))->andwhere(array('type'=>'category'))->count();
			$this->category_entity= $this->table_category->newEntity();
			$this->category_entity['type']=__('category');
			$this->category_entity['title']=$this->category;
			if((int)$check_record == 0){
			if($this->table_category->save($this->category_entity)){
				$category_id=$this->category_entity['cat_id'];
			}
			echo $category_id;
			}else{
				echo '0';
			}
		
		}
	}
	
	public function addunit(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$this->unit = $_POST['unit_name'];
			$check_record=$this->table_category->find()->where(array('title' => $this->unit))->andwhere(array('type'=>'unit'))->count();
			$this->unit_entity= $this->table_category->newEntity();
			$this->unit_entity['type']=__('unit');
			$this->unit_entity['title']=$this->unit;
			if((int)$check_record == 0){
			if($this->table_category->save($this->unit_entity)){
				$unit_id=$this->unit_entity['cat_id'];
			}
			echo $unit_id;
			}else{
				echo '0';
			}
	
		}
	}
	public function deleteclient(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
		$id = $_POST['client_id'];
		$client_history =TableRegistry::get('tbl_client_history');
		$row_delete = $client_history->get($id);
		$client_history->delete($row_delete);
		}
	}

	public function deletepurchasestatus(){
		$this->autoRender=false;
		if($this->request->is('ajax')){
			$id=$_POST['status_id'];
			$item_delete=$this->table_category->get($id);
			if($this->table_category->delete($item_delete)){
			}
		}

	}
	
	public function addwarehouse(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$this->warehouse = $_POST['warehouse_name'];
			$check_record=$this->table_category->find()->where(array('title' => $this->warehouse))->andwhere(array('type'=>'warehouse'))->count();
			$this->warehouse_entity= $this->table_category->newEntity();
			$this->warehouse_entity['type']=__('warehouse');
			$this->warehouse_entity['title']=$this->warehouse;
			if((int)$check_record == 0){
			if($this->table_category->save($this->warehouse_entity)){
				$warehouse_id=$this->warehouse_entity['cat_id'];
			}
			echo $warehouse_id;
			}else{
				echo '0';
			}
		}
	}
	

	public function deletebrand($bid = null){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$brandtypeid=$_POST['brand_id'];
			$item_delete=$this->table_category->get($brandtypeid);
			if($this->table_category->delete($item_delete)){
			}
		}
	}
	/*Product Details Ajax*/
	public function addnewrow(){
		$row_id = $_REQUEST['row_id'];
		$table_product = TableRegistry::get('tbl_product');
		$productlist = $table_product->find();
		
		$this->set('productlist',$productlist);
		$this->set('row_id',$row_id);
		
	}
	public function changeamcstatus()
		{
			
				$this->autoRender=false;
			
				$amcstatus['employee_status']=$_REQUEST['status'];
				$id=$_REQUEST['amcid'];
				$amcstatus['is_appove']  = 1;
				$tbl_amc = TableRegistry::get('tbl_amc');
                $tbl_complaint_id = $tbl_amc->get($id);
				 $update = $tbl_amc->patchEntity($tbl_complaint_id, $amcstatus);
                 $tbl_amc->save($update);  
                  
			
				
		}
		public function changedonestatus()
		{
			
				$this->autoRender=false;
			
				$amcstatus['done_status']=$_REQUEST['done_status'];
				$amcstatus['done_date'] = date("Y/m/d");
				
				$id=$_REQUEST['service_mange_id'];
				
				$tbl_manage_service = TableRegistry::get('tbl_manage_service');
				$tbl_manage_service_record = $tbl_manage_service->find()->where(['id'=>$id])->first();
				
				$customerid = $tbl_manage_service_record['customer_id'];
				$servicetitle = $tbl_manage_service_record['title'];
				$service_date = $tbl_manage_service_record['service_date'];
				$customername = $this->AMCfunction->getEmployeerName($customerid);
				$customeremail = $this->AMCfunction->getEmployeerEmail($customerid);
				
				
				//send mail to customer
				$tble_setting = TableRegistry::get('tble_setting');
						$mailformate = $tble_setting->find()->first();
						$sendmail = $mailformate['mail_send'];
						$title_name = $mailformate['title_name'];
				$mail_notification_before_day = TableRegistry::get('tbl_mail_notification');
				$mailformate_before_day = $mail_notification_before_day->find()->where(['notification_for'=>'service_done'])->first();
				$mailformat_before = $mailformate_before_day['notification_text'];
				$serch = array('{ username }','{ systemname }','{ service_title }','{ service_date }');
				$replace = array($customername,$title_name,$servicetitle,$service_date);
				$message_content = str_replace($serch, $replace, $mailformat_before);
				$subject = $mailformate_before_day['subject'];
				$headers = "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8";
				$headers .= 'From:'. $mailformate_before_day['send_from'] . "\r\n";
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
								->to($to)
								->subject($subject)
								->send($message_content);
							}
						}
				
				
                $tbl_complaint_id = $tbl_manage_service->get($id);
				 $update = $tbl_manage_service->patchEntity($tbl_complaint_id, $amcstatus);
                 $tbl_manage_service->save($update);  
                  
			
				
		}
		public function changecomment()
		{
			
				$this->autoRender=false;
			
				$amcstatus['done_discription']=$_REQUEST['comment'];
				$id=$_REQUEST['service_id'];
				
				$tbl_manage_service = TableRegistry::get('tbl_manage_service');
				$tbl_complaint_id = $tbl_manage_service->get($id);
				 $update = $tbl_manage_service->patchEntity($tbl_complaint_id, $amcstatus);
                 if($tbl_manage_service->save($update))
				 {
					 echo 1;
				 }					 
                  
			
				
		}
		public function changesalesservicestatus()
		{
			
				$this->autoRender=false;
			
				$servicestatus['assign_to']=$_REQUEST['employeeid'];
				$id=$_REQUEST['servicesid'];
				
				$tbl_manage_service = TableRegistry::get('tbl_manage_service');
                $tbl_complaint_id = $tbl_manage_service->get($id);
				 $update = $tbl_manage_service->patchEntity($tbl_complaint_id, $servicestatus);
                 $tbl_manage_service->save($update);  
                  
			
				
		}
	public function addnewrowclient(){
		$row_id = $_REQUEST['row_id'];
		$table_product = TableRegistry::get('tbl_client_history');
		$productlist = $table_product->find();
		
		$this->set('productlist',$productlist);
		$this->set('row_id',$row_id);
		
	}

	public function addamcrow(){
		$row_id = $_REQUEST['row_id'];
		$table_product = TableRegistry::get('tbl_product');
		$productlist = $table_product->find();
		$table_warranty=TableRegistry::get('tbl_warranty');
		$warranty_list = $table_warranty->find();
		$this->set('warranty_list',$warranty_list);
		$this->set('productlist',$productlist);
		$this->set('row_id',$row_id);
	}

	
	public function productdetail(){
		$product_id = $_REQUEST['product_id'];
		$table_products = TableRegistry::get('tbl_product');
		$product_data = $table_products->find()->where(['product_id'=>$product_id]);
		$result_arr = array();
		foreach($product_data as $retrive_data)
		{
			$result_arr['price'] = $retrive_data['price'];
			$result_arr['unit_id'] = $this->AMCfunction->get_category_title($retrive_data['unit_id']);
		}
		echo json_encode($result_arr);
		die();
	}
	public function getcust(){
			$this->autoRender=false;
			$cust_record_id=$_REQUEST['row_id'];
		$table_user=TableRegistry::get('tbl_user');
		$get_cust_record=$table_user->get($cust_record_id);
		
		
		if(is_array(json_decode($get_cust_record['address']))){
			 $get_cust_record['address']=implode(",",json_decode($get_cust_record['address'])) ;
		}else{
			$get_cust_record['address']=$get_cust_record['address'];
		}
		
		
	    //$get_cust_record['address']=implode(",",json_decode($get_cust_record['address'])) ;
		
		
		echo json_encode($get_cust_record);
		
	}
	/*End*/
	
	public function getserial(){
		$this->autoRender=false;
		$product_id_data=$_REQUEST['product_idf'];
			
		$table_product=TableRegistry::get('tbl_product');
		$get_product_record=$table_product->get($product_id_data);
		echo json_encode($get_product_record);
	}
	

	
	/*Add Amc type*/
	public function addamctype(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$this->amctype = $_POST['amctype_name'];
			$check_record=$this->table_category->find()->where(array('title' => $this->amctype))->count();
			$this->amctype_entity= $this->table_category->newEntity();
			$this->amctype_entity['type']=__('amctype');
			$this->amctype_entity['title']=$this->amctype;
			if((int)$check_record == 0){
				if($this->table_category->save($this->amctype_entity)){
					$amctype_id=$this->amctype_entity['cat_id'];
				}
				echo $amctype_id;
			}else{
				echo '0';
			}

		}
	}
	
	public function archiveproduct(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$archiveid = $_POST['productid'];
			$data['is_archive'] = 1;
			$table_product=TableRegistry::get('tbl_product');
			$this->row_update=$table_product->get($archiveid);
			$update_data_product=$table_product->patchEntity($this->row_update,$data);
			$table_product->save($update_data_product);
		}
	}
	public function archiveclient(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$clientid = $_POST['clientid'];
			$data['is_archive'] = 1;
			$tbl_user=TableRegistry::get('tbl_user');
			$this->row_update=$tbl_user->get($clientid);
			$update_data_product=$tbl_user->patchEntity($this->row_update,$data);
			$tbl_user->save($update_data_product);
		}
	}
	public function archiveemployee(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$employeeid = $_POST['employeeid'];
			$data['is_archive'] = 1;
			$tbl_user=TableRegistry::get('tbl_user');
			$this->row_update=$tbl_user->get($employeeid);
			$update_data_product=$tbl_user->patchEntity($this->row_update,$data);
			$tbl_user->save($update_data_product);
		}
	}
	public function addcomplainttype(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$this->complaint_type = $_POST['complaint_type_data'];
			$check_record=$this->table_category->find()->where(array('title' => $this->complaint_type))->count();
			$this->complaint_entity= $this->table_category->newEntity();
			$this->complaint_entity['type']=__('complainttype');
			$this->complaint_entity['title']=$this->complaint_type;
			if((int)$check_record == 0){
				if($this->table_category->save($this->complaint_entity)){
					$complaint_id=$this->complaint_entity['cat_id'];
				}
				echo $complaint_id;
			}else{
				echo '0';
			}
	
		}
	}
	
	
	public function savedesignation(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$this->designation = $_POST['designation_data'];
			$check_record=$this->table_category->find()->where(array('title' => $this->designation))->count();
			$this->designation_entity= $this->table_category->newEntity();
			$this->designation_entity['type']=__('designation');
			$this->designation_entity['title']=$this->designation;
			if((int)$check_record == 0){
				if($this->table_category->save($this->designation_entity)){
					$designation_id=$this->designation_entity['cat_id'];
				}
				echo $designation_id;
			}else{
				echo '0';
			}
	
		}
	}
	
	
	
	
	public function addtasktype(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$this->tasktype = $_POST['task_type_data'];
			$check_record=$this->table_category->find()->where(array('title' => $this->tasktype))->count();
			$this->tasktype_entity= $this->table_category->newEntity();
			$this->tasktype_entity['type']=__('tasktype');
			$this->tasktype_entity['title']=$this->tasktype;
			if((int)$check_record == 0){
				if($this->table_category->save($this->tasktype_entity)){
					$tasktype_id=$this->tasktype_entity['cat_id'];
				}
				echo $tasktype_id;
			}else{
				echo '0';
			}
	
		}
	}
	
	
	
	
	

	public function deleteamctype($bid = null){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$amct=$_POST['amctype_id'];
			$item_delete=$this->table_category->get($amct);
			if($this->table_category->delete($item_delete)){
			}
		}
	}

    public function removehistorydata(){
	    $this->autoRender=false;
	    $purchase_history_table=TableRegistry::get("tbl_purchase_history");
	    $get_purchase_history_id=$this->request->data('product_history_id');
        $item_delete=$purchase_history_table->get($get_purchase_history_id);
        if($purchase_history_table->delete($item_delete)){
            echo $get_purchase_history_id;
        }
    }
	public function removeexpenseshistorydata(){
	    $this->autoRender=false;
	    $tbl_expenses_history=TableRegistry::get("tbl_expenses_history");
	    $get_purchase_history_id=$this->request->data('product_history_id');
        $item_delete=$tbl_expenses_history->get($get_purchase_history_id);
        if($tbl_expenses_history->delete($item_delete)){
            echo $get_purchase_history_id;
        }
    }
	
	
	public function getquotationdata(){
		$this->autoRender=false;
		 $table_quotation=TableRegistry::get('tbl_quotation');
	     $table_quotation_history=TableRegistry::get('tbl_quotation_history');
		 $result=array();
		if($this->request->is('ajax')){
			
				$get_request_data=$this->request->data('quotation_id');
				$get_count_data=$table_quotation->find()->where(array('quotation_no'=>$get_request_data))->count();
				if($get_count_data > 0){
					
				   $get_table_data=$table_quotation->find()->where(array('quotation_no'=>$get_request_data))->first();
				   $id=$get_table_data['quotation_id'];
				   $result['quotation']=$get_table_data;
				   //$result['quotation_history'] =$table_quotation_history->find()->where(array('quotation_id'=>$id))->toArray();
				  
				  echo json_encode($result);
					
				}else{
					echo '0';
				}
				
				
			
		}
		
		
		
	}
	public function getRowTax(){
		$this->autoRender=false;
		if($this->request->is('ajax')){
			
				$row_id=$this->request->data('row_id');
				$nwid = $row_id+1;
				$account_tax = TableRegistry::get('tbl_account_tax_rates');
		$accout_tax=$account_tax->find();
   		
				?>
				
				
				<tr class="row_id_<?php echo $nwid  ?>">
							<td>
								<select name="account[tax_name][]" class="form-control tax_change" row_did="<?php echo $nwid;  ?>" required>
									<option value=""><?php echo __('--Select Tax--');?></option>
									<?php  
											if($accout_tax){
									foreach($accout_tax as $accout_taxs){
										?>

			<option value="<?php echo $accout_taxs['acount_tax_name']; ?>"><?php echo $accout_taxs['acount_tax_name']; ?></option>

										<?php
									}
								}
									?>						
								</select>
							</td>
							
							<td>
								<input type="text" name="account[tax][]" class="product form-control tax_name_<?php echo $nwid  ?>"  value=""  readonly='true'>
							</td>
						
							<td>
								<span class="trash_account" data-id="<?php echo $nwid  ?>"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr>
				
			
		
		<?php }
		
		
		
	}
	public function getTax(){
		$this->autoRender=false;
		 $table_tax_rates=TableRegistry::get('tbl_account_tax_rates');
	   
		
		if($this->request->is('ajax')){
			
				$tax=$this->request->data('tax');
				$get_count_data=$table_tax_rates->find()->where(array('acount_tax_name'=>$tax))->count();
				if($get_count_data > 0){
					
				   $get_table_data=$table_tax_rates->find()->where(array('acount_tax_name'=>$tax))->first();
				   $taxdata=$get_table_data['tax'];
				  
				   echo $taxdata;
				  
					
				}else{
					echo '0';
				}
				
				
			
		}
		
		
		
	}
	
	public function getquotationproducts(){
		
		$this->autoRender=true;
		 $table_quotation=TableRegistry::get('tbl_quotation');
	     $table_quotation_history=TableRegistry::get('tbl_quotation_history');
		
		$table_product = TableRegistry::get('tbl_product');
			if($this->request->is('ajax')){
			
				$get_request_data_product=$this->request->data('quotation_id_forproduct');
				$get_count_data=$table_quotation->find()->where(array('quotation_no'=>$get_request_data_product))->count();
				if($get_count_data > 0){
					
				   $get_table_data=$table_quotation->find()->where(array('quotation_no'=>$get_request_data_product))->first();
				   $id=$get_table_data['quotation_id'];
				  $productlist = $table_product->find();
				   $result=$table_quotation_history->find()->where(array('quotation_id'=>$id))->toArray();
				   $this->set('qh_histroy',$result);
				   $this->set('productlist',$productlist);
				  }else{
					echo '0';
				}
				
				
			
		}
		
		
		
		
	}
	
	public function addservicelist(){
		$this->autoRender=true;
		if($this->request->is('ajax')){
			
			$start_date=$this->request->data('get_start_date');
			$end_date=$this->request->data('get_end_date');
			
			$no_service=$this->request->data('get_no_service');
			
			$new_date=$start_date;
			
			$new_date_array=array();
			$no_service_arry=array();
			
			
				
				
				
				$get_service_data=$start_date;
				
				
				$addmonth_point=12/$no_service;
				
				$addmonth=(int)$addmonth_point;
				
				for($j=1;$j<=$no_service;$j++){
					
					$no_service_date = date('Y-m-d', strtotime("+".$addmonth." months", strtotime($get_service_data)));
						
						
						
				$get_service_data=$no_service_date;
					
					if($get_service_data>$end_date){
						break;
					}
					$no_service_arry[$get_service_data]=__("$j Service");
					
				}
				
				
				
				$this->set('service_count',$no_service_arry);
				
			
			
			
			
			
			
			
				
		}
		
		
		
	}


	 public function changeAvatar() 
	 {
		$post = isset($_POST) ? $_POST: array();
        $max_width = "500"; 
        $userId = isset($post['hdn-profile-id']) ? intval($post['hdn-profile-id']) : 0;
		$image_director="img\cropimages";
			
		$path=WWW_ROOT . $image_director;
        //$path = WWW_ROOT .'/web';

        $valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
        $name = $_FILES['photoimg']['name'];
        $size = $_FILES['photoimg']['size'];
        if(strlen($name))
        {
        list($txt, $ext) = explode(".", $name);
        if(in_array($ext,$valid_formats))
        {
        if($size<(1024*1024)) // Image size max 1 MB
        {
        $actual_image_name = 'avatar' .'_'.$userId .'.'.$ext;
        $filePath = $path .'/'.$actual_image_name;
        $tmp = $_FILES['photoimg']['tmp_name'];
        //debug($filePath);die;
        if(move_uploaded_file($tmp, $filePath))
        {
        $width = $this->AMCfunction->getWidth($filePath);
            $height = $this->AMCfunction->getHeight($filePath);
            //Scale the image if it is greater than the width set above
            if ($width > $max_width){
                $scale = $max_width/$width;
                $uploaded = $this->AMCfunction->resizeImage($filePath,$width,$height,$scale);
            }else{
                $scale = 1;
                $uploaded = $this->AMCfunction->resizeImage($filePath,$width,$height,$scale);
            }
        /*$res = saveAvatar(array(
                        'userId' => isset($userId) ? intval($userId) : 0,
                                                'avatar' => isset($actual_image_name) ? $actual_image_name : '',
                        ));*/
                        
        //mysql_query("UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
        //echo "<img id='photo' file-name='".$actual_image_name."' class='' src='".$filePath.'?'.time()."' class='preview'/>";
        echo "<img id='photo' file-name='".$actual_image_name."' class='' src='/amc/img/user/download%20%281%29.jpg' class='preview'/>";
        }
        else
        echo "failed";
        }
        else
        echo "Image file size max 1 MB"; 
        }
        else
        echo "Invalid file format.."; 
        }
        else
        echo "Please select image..!";
        exit;
		
    
  }
	
	
	
}

?>