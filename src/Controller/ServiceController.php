<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FlashHelper;
use Cake\Datasource\ConnectionManager;


class ServiceController extends AppController{

    public $table_service;
    public $table_user;
    public $table_product;
    public $get_product_list;
    public $get_last_record;
    public $get_data_user;
    public $service_table_entity;
    public $save_service_data;
    public $table_service_history;
    public $service_history_entity;
    public $get_all_service_record;
    public $row_delete;
    public $get_update_data;



    public function initialize(){
        parent::initialize();
    }

    public function TableService(){ $this->table_service=TableRegistry::get('tbl_service'); }
    public function TableUser(){ $this->table_user=TableRegistry::get('tbl_user'); }
    public function TableProduct(){ $this->table_product=TableRegistry::get('tbl_product'); }
    public function TableServiceHistory(){ $this->table_service_history=TableRegistry::get('tbl_service_history'); }


    public function index(){
        $this->redirect(array('controller'=>'service','action'=>'addservice'));
    }
    public function delete($id){
        $this->TableService();
        $this->request->is(['post','delete']);
        $this->row_delete=$this->table_service->get($id);
        if($this->table_service->delete($this->row_delete)){
            $this->Flash->success(__('Service Record Deleted Successfully'));
            return $this->redirect(array('controller'=>'Service','action'=>'viewservice'));
        }
    }
    
    public function todayservice(){
        $connection = ConnectionManager::get('default');
          $today_date=date('Y-m-d');
         
        $get_record_str="SELECT ms.*,amc.* FROM `tbl_manage_service` as ms,`tbl_amc` as amc where amc.amc_id=ms.amc_id and service_date='$today_date'";
     
        $results_services = $connection->execute($get_record_str)->fetchAll('assoc');
        $this->set('service_data',$results_services);
    }

    public function viewservice(){
        $this->TableService();
        if($this->request->session()->read('user_role') == 'client'){
             $this->get_all_service_record=$this->table_service->find()->where(array('customer_id'=>$this->request->session()->read('user_id')))->toArray();
        }
		if($this->request->session()->read('user_role') == 'employee'){
             $this->get_all_service_record=$this->table_service->find()->where(array('assign_to'=>$this->request->session()->read('user_id')))->toArray();
        }
		if($this->request->session()->read('user_role') == 'admin'){
			$this->get_all_service_record=$this->table_service->find();
        }
        
        $this->set('servicelist',$this->get_all_service_record);
    }

    public function updateservice($id){

                $this->TableService();
                $this->TableUser();
                $this->TableServiceHistory();
                $this->TableProduct();

        $this->get_last_record= $this->table_service->find()->select(['service_id'])->last();
        $quotation_idf=__('SV').$this->get_last_record['service_id'].rand(11,99).date('mY');
        $this->set('service_idf',$quotation_idf);

        $product_data=$this->table_product->find();
        $this->set('product_row',$product_data);
        
        $employee_data=$this->table_user->find()->where(array('role'=>'employee'))->toArray();
        $this->set('employee_info',$employee_data);
        
        
         $client_data=$this->table_user->find()->where(array('role'=>'client'))->toArray();
         $this->set('client_info',$client_data);

        $this->get_update_data=$this->table_service->get($id);
        $this->set('update_row',$this->get_update_data);

        $history_record=$this->table_service_history->find()->where(array('service_id'=>$id))->toArray();
        $this->set('svh_histroy',$history_record);

        if($this->request->is(array('post','put'))){
            $update_service=$this->table_service->patchEntity($this->get_update_data,$this->request->data);

            $query = $this->table_service_history->query();
            $query->delete()->where(['service_id' => $id])->execute();

            if($query){

                $product_arr=array();
                $product_arr=$this->request->data('product');
                if(isset($product_arr)){
                    foreach($product_arr['product_id'] as $key => $value){
                        $this->service_table_entity=$this->table_service_history->newEntity();
                        $data['service_id']=$id;
                        $data['item_name']=$product_arr['product_id'][$key];
                        $data['note']=$product_arr['note'][$key];
                        
                        $add_data_svh=$this->table_service_history->patchEntity($this->service_table_entity, $data);
                        if($this->table_service_history->save($add_data_svh)){
                        }
                    }
                }
            }

            if($this->table_service->save($update_service)){
                $this->Flash->success(__('Service Record Updated Successfully'));
                return $this->redirect(array('controller'=>'Service','action'=>'viewservice'));
            }

        }
    }
	public function approvestatus($id = null){
			$this->autoRender = false;
			if($this->request->is('ajax')){
				$apporveid = $_POST['apporveid'];
				
				$tbl_service =TableRegistry::get('tbl_service');
				$row = $tbl_service->get($apporveid);
					
							$stoke_p_data['is_appove'] = 0;
							$stoke_p_data['status'] = $row['employee_status'];
							$supply=$tbl_service->patchEntity($row, $stoke_p_data);
							if($tbl_service->save($supply))
							{
								echo 1;
							}
				
			}
		}
		public function declineidstatus($id = null){
			$this->autoRender = false;
			if($this->request->is('ajax')){
				$declineid = $_POST['declineid'];
				
				$tbl_service =TableRegistry::get('tbl_service');
				$row = $tbl_service->get($declineid);
					
							$stoke_p_data['is_appove'] = 0;
							$supply=$tbl_service->patchEntity($row, $stoke_p_data);
							if($tbl_service->save($supply))
							{
								echo 1;
							}
				
			}
		}
		public function updatestatus(){
				
				$this->autoRender=false;
				if($this->request->is('ajax')){
					
					$status_id= $this->request->data('get_status_id');
					
					$task_id =$this->request->data('get_record_id');
					
					$this->tbl_service=TableRegistry::get('tbl_service');
					$update_status = $this->tbl_service->query();
                    $update_status->update()
                    ->set(['employee_status' =>$status_id,'is_appove'=>1])
                    ->where(['service_id' => $task_id])
                    ->execute();
					
					
				}
				
				
			}
    public function addservice(){
        $this->TableService();
        $this->TableUser();
        $this->TableProduct();
        $this->TableServiceHistory();
        $this->get_last_record= $this->table_service->find()->select(['service_id'])->last();
        $service_idf=__('SV').$this->get_last_record['service_id'].rand(11,99).date('mY');
        $this->set('service_idf',$service_idf);
        $get_employee_list=$this->table_user->find()->where(array('role'=>'employee'))->toArray();
        $this->set('employee_info',$get_employee_list);
        
        $get_client_list=$this->table_user->find()->where(array('role'=>'client'))->toArray();
        $this->set('client_info',$get_client_list);
        
        $this->get_product_list=$this->table_product->find();
        $this->set('product_row',$this->get_product_list);
        $this->service_table_entity=$this->table_service->newEntity();
        if($this->request->is('post')){
			$update_data=$this->request->data;
			$update_data['employee_status']=$this->request->data('status');
            $this->save_service_data=$this->table_service->patchEntity($this->service_table_entity,$update_data);
            if($this->table_service->save($this->save_service_data)){
                $sv_id=$this->table_service->find()->select(['service_id'])->last();
                $product_arr=array();
                $product_arr=$this->request->data('product');
                foreach($product_arr['product_id'] as $key => $value){
                    $this->service_table_entity=$this->table_service_history->newEntity();
                    $svh_data['service_id']=$sv_id['service_id'];
                    $svh_data['item_name']=$product_arr['product_id'][$key];
                    $svh_data['note']=$product_arr['note'][$key];
                   
                    $add_data_service_h=$this->table_service_history->patchEntity($this->service_table_entity, $svh_data);
                    if($this->table_service_history->save($add_data_service_h)){
                    }
                }
                $this->Flash->success(__('Service Record Inserted Successfully'));
            }
        }

    }

}

?>