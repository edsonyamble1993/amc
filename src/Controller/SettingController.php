<?php
namespace App\Controller;

use Cake\ORM\TableRegistry; 
use App\Controller\AppController;
use Cake\View\Helper\FlashHelper;
use Cake\Datasource\ConnectionManager;

class SettingController extends AppController
{
	public function initialize(){
		$this->setting_image=WWW_ROOT.'img/setting/';
       parent::initialize();     
   }
   public function setting()
    {
		$table_setting = TableRegistry::get('tble_setting');
		$fetch_data=$table_setting->find()->toArray();
		if(empty($fetch_data)){
		
		$table_setting_entity = $table_setting->newEntity();
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			$ext = pathinfo($_FILES['icon_image']['name'], PATHINFO_EXTENSION);
			$valid_extension = ['ico',""];
			if(!in_array($ext,$valid_extension) )
			{
				$this->Flash->success(__('Please Select Icon'));
				return $this->redirect(array('action'=>'setting'));
			}
			else
			{
			$ext1 = pathinfo($this->request->data('originaladdedimage'), PATHINFO_EXTENSION);
			$valid_extension1 = ['gif','png','jpg','jpeg',""];
			if(in_array($ext1,$valid_extension1) )
			{
			if($_FILES['icon_image']['name'] != null && !empty($_FILES['icon_image']['name'])){
							move_uploaded_file($_FILES['icon_image']['tmp_name'],$this->setting_image.$_FILES['icon_image']['name']);
							$this->store_icon=$_FILES['icon_image']['name'];
						}else{
							$this->store_icon=$this->request->data('old_image');
						}
			$data['icon']=$this->store_icon;
			// if($_FILES['logo_image']['name'] != null && !empty($_FILES['logo_image']['name'])){
							// move_uploaded_file($_FILES['logo_image']['tmp_name'],$this->setting_image.$_FILES['logo_image']['name']);
							// $this->store_logo=$_FILES['logo_image']['name'];
						// }else{
							// $this->store_logo=$this->request->data('old_image');
						// }
			$dataiamge = $this->request->data('logo_image');
			if($dataiamge != '')
			{
				$time = time();
				$imagename = 'logo_'.$time.'.png';
				$this->store_logo = 'logo_'.$time.'.png';
				
				$source = fopen($dataiamge, 'r');
				$destination = fopen('img/setting/'.$imagename, 'w');
				
				stream_copy_to_stream($source, $destination);

				fclose($source);
				fclose($destination);
			}else
			{
				$this->store_logo = $this->request->data('old_logo');;
			}
			$data['logo']=$this->store_logo;
			if($_FILES['cover_image']['name'] != null && !empty($_FILES['cover_image']['name'])){
							move_uploaded_file($_FILES['cover_image']['tmp_name'],$this->setting_image.$_FILES['cover_image']['name']);
							$this->store_cover =$_FILES['cover_image']['name'];
						}else{
							$this->store_cover=$this->request->data('old_image');
						}
						
						
			$data['cover_profile']=$this->store_cover;
			$save_setting_data = $table_setting->patchEntity($table_setting_entity,$data);
			if($table_setting->save($save_setting_data))
			{
				$this->Flash->success(__('Setting Record Inserted Successfully'));
				return $this->redirect(array('action'=>'setting'));
			}
			}else{
				$this->Flash->success(__('Invalid File Attachment'));
				return $this->redirect(array('action'=>'setting'));
			}
		}
		}
		}else
		{
			$first_data = $table_setting->find()->first();
			// var_dump($first_data );
			// exit;
			$this->set('setting_data',$first_data);
			if($this->request->is('post'))
		{
							
		
			$data = $this->request->data;
			$ext = pathinfo($_FILES['icon_image']['name'], PATHINFO_EXTENSION);
			$valid_extension = ['ico',""];
			if(!in_array($ext,$valid_extension) )
			{
				$this->Flash->success(__('Please Select Icon'));
				return $this->redirect(array('action'=>'setting'));
			}
			else
			{
			$ext1 = pathinfo($this->request->data('originaladdedimage'), PATHINFO_EXTENSION);
			$valid_extension1 = ['gif','png','jpg','jpeg',""];
			if(in_array($ext1,$valid_extension1) )
			{
			if($_FILES['icon_image']['name'] != null && !empty($_FILES['icon_image']['name'])){
							move_uploaded_file($_FILES['icon_image']['tmp_name'],$this->setting_image.$_FILES['icon_image']['name']);
							$this->store_icon=$_FILES['icon_image']['name'];
						}else{
							$this->store_icon=$this->request->data('old_icon');
						}
			$data['icon']=$this->store_icon;
			$dataofmail = $this->request->data('send_email_value');
			if($dataofmail == 1)
			{
				$data['mail_send'] = 1;
			}else
			{
				$data['mail_send'] = 0;
			}
			// if($_FILES['logo_image']['name'] != null && !empty($_FILES['logo_image']['name'])){
							// move_uploaded_file($_FILES['logo_image']['tmp_name'],$this->setting_image.$_FILES['logo_image']['name']);
							// $this->store_logo=$_FILES['logo_image']['name'];
						// }else{
							// $this->store_logo=$this->request->data('old_logo');
						// }
						
			$dataiamge = $this->request->data('logo_image');
			if($dataiamge != '')
			{
				$time = time();
				$imagename = 'logo_'.$time.'.png';
				$this->store_logo = 'logo_'.$time.'.png';
				
				$source = fopen($dataiamge, 'r');
				$destination = fopen('img/setting/'.$imagename, 'w');

				stream_copy_to_stream($source, $destination);

				fclose($source);
				fclose($destination);
			}else
			{
				$this->store_logo = $this->request->data('old_logo');;
			}
			$data['logo']=$this->store_logo;
			
			
			$save_setting_data = $table_setting->patchEntity($first_data,$data);
			if($table_setting->save($save_setting_data))
			{
				$this->Flash->success(__('Setting Record Successfully Update'));
				return $this->redirect(array('action'=>'setting'));
			}
			}else{
				$this->Flash->success(__('Invalid File Attachment'));
				return $this->redirect(array('action'=>'setting'));
			}
		}
		}
			
	
		}
    }
	public function accessrights()
    {
		$table_accessrights = TableRegistry::get('tbl_accessright');
		$fetch_data=$table_accessrights->find("all")->hydrate(false)->toArray();
		$employee = array();
		$client = array();
		foreach($fetch_data as $fetch_datas)
		{
			
			$menu=$fetch_datas['menu_name'];
			$employee[$menu] = $fetch_datas["employee"];
			$client[$menu] = $fetch_datas["client"];
		}
		$this->set('employee',$employee);
		$this->set('client',$client);
		if($this->request->is("post"))
		{
			
			$request = $this->request->data;
			$access_right = array();
			
			//---------COMPANY LINK START------------------ 
			$access_right['supplier'] = array('employee' =>isset($request['supplier_employee'])?$request['supplier_employee']:0,
			'client'=>isset($request['supplier_client'])?$request['supplier_client']:0);
			//---------SUPPLIER LINK START------------------ 
			$access_right['company'] = array('employee' =>isset($request['company_employee'])?$request['company_employee']:0,
			'client'=>isset($request['company_client'])?$request['company_client']:0);
			//---------product LINK START------------------ 
			$access_right['product'] = array('employee' =>isset($request['product_employee'])?$request['product_employee']:0,
			'client'=>isset($request['product_client'])?$request['product_client']:0);
			//---------product LINK START------------------ 
			$access_right['purchase'] = array('employee' => isset($request['purchase_employee'])?$request['purchase_employee']:0,
			'client'=>isset($request['purchase_client'])?$request['purchase_client']:0);
			//---------amc_warranty LINK START------------------ 
			$access_right['stoke'] = array('employee' => isset($request['stock_employee'])?$request['stock_employee']:0,
			'client'=>isset($request['stock_client'])?$request['stock_client']:0);
			//---------client LINK START------------------ 
			$access_right['client'] = array('employee' => isset($request['client_employee'])?$request['client_employee']:0,
			'client'=>isset($request['client_client'])?$request['client_client']:0);
			//---------employee LINK START------------------ 
			$access_right['employee'] = array('employee' => isset($request['employee_employee'])?$request['employee_employee']:0,
			'client'=>isset($request['employee_client'])?$request['employee_client']:0);
			//---------quotation LINK START------------------ 
			$access_right['quotation'] = array('employee' => isset($request['quotation_employee'])?$request['quotation_employee']:0,
			'client'=>isset($request['quotation_client'])?$request['quotation_client']:0);
			//---------sales LINK START------------------ 
			$access_right['sales'] = array('employee' => isset($request['sales_employee'])?$request['sales_employee']:0,
			'client'=>isset($request['sales_client'])?$request['sales_client']:0);
			//---------invoice LINK START------------------ 
			$access_right['invoice'] = array('employee' => isset($request['invoice_employee'])?$request['invoice_employee']:0,
			'client'=>isset($request['invoice_client'])?$request['invoice_client']:0);
			//---------amc LINK START------------------ 
			$access_right['amc'] = array('employee' => isset($request['amc_employee'])?$request['amc_employee']:0,
			'client'=>isset($request['amc_client'])?$request['amc_client']:0);
			//---------complaint LINK START------------------ 
			$access_right['complaint'] = array('employee' => isset($request['complaint_employee'])?$request['complaint_employee']:0,
			'client'=>isset($request['complaint_client'])?$request['complaint_client']:0);
			//---------service LINK START------------------ 
			$access_right['service'] = array('employee' => isset($request['service_employee'])?$request['service_employee']:0,
			'client'=>isset($request['service_client'])?$request['service_client']:0);
			//---------task LINK START------------------ 
			$access_right['task'] = array('employee' => isset($request['task_employee'])?$request['task_employee']:0,
			'client'=>isset($request['task_client'])?$request['task_client']:0);
			//---------expenses LINK START------------------ 
			$access_right['expenses'] = array('employee' => isset($request['expenses_employee'])?$request['expenses_employee']:0,
			'client'=>isset($request['expenses_client'])?$request['expenses_client']:0);
			//---------income LINK START------------------ 
			$access_right['income'] = array('employee' => isset($request['income_employee'])?$request['income_employee']:0,
			'client'=>isset($request['income_client'])?$request['income_client']:0);
			
			$rows = array();
			foreach($access_right as $menu => $right)
			{
				$data = array();
				$data['menu_name'] = $menu;
				$data['employee'] = $right['employee'];
				$data['client'] = $right['client'];
				$rows[] = $data;
			}
			$conn = ConnectionManager::get('default');
			$sql = "TRUNCATE TABLE tbl_accessright";
			$stmt = $conn->execute($sql);
			$entities = $table_accessrights->newEntities($rows);
				foreach($entities as $entitie)
				{
					if($table_accessrights->save($entitie))
					{
						$success = true;
					}else
					{
						$success = false;
					}
				}
				if($success)
				{
					$this->Flash->success(__("Success! Settings Saved successfully."));
					return $this->redirect(["action"=>"accessrights"]);
				}
		}
		
    }
}