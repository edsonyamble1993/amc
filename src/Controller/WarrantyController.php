<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;


class WarrantyController extends AppController{

	public $table_warranty;
	public $table_warranty_entity;
	public $save_warranty_data;
	public $get_warranty_list;
	public $row_delete;
	public $row_update;

	public function initialize(){
       parent::initialize();
	   $this->table_warranty=TableRegistry::get('tbl_warranty');
      
   }
   
   public function index(){
		$this->redirect(array('controller'=>'Warranty','action'=>'warrantylist'));	
   }

   public function delete($id){
	   $this->request->is(['post','delete']);
			$this->row_delete=$this->table_warranty->get($id);
			if($this->table_warranty->delete($this->row_delete)){
				$this->Flash->success(__('Record Deleted Successfully'));
				return $this->redirect(array('controller'=>'warranty','action'=>'warrantylist'));
			}
   }

   public function warrantylist(){
	   	$this->get_warranty_list=$this->table_warranty->find();
		   $this->set('warranty_data',$this->get_warranty_list);
   }


   	public function addwarranty($id = NULL){
			
		$this->table_warranty_entity=$this->table_warranty->newEntity();
			if(isset($id)){
				
				
						$this->row_update=$this->table_warranty->get($id);
						$this->set('warranty_update',$this->row_update);
						if($this->request->is(array('post'))){
						
						$update_row_warr=$this->table_warranty->patchEntity($this->row_update,$this->request->data);
						if($this->table_warranty->save($update_row_warr)){
							$this->Flash->success(__('Record Updated Successfully'));
							return $this->redirect(array('controller'=>'Warranty','action'=>'warrantylist'));
							}
						}
			}else{
				
	if($this->request->is('post')){
   			$this->save_warranty_data=$this->table_warranty->patchEntity($this->table_warranty_entity,$this->request->data);
   			if($this->table_warranty->save($this->save_warranty_data)){
				$this->Flash->success(__('Record Inserted Successfully'));
   			}
   			
   		}
			}
	
			
   	}
   	
   		
}  	

?>