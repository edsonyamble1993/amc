<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;
use Cake\I18n\Time;


class CompanyController extends AppController{

	public $table_company;
	public $company_entity;
	public $company_data;
	public $save_company_data;
	public $company_image;
	public $company_code;
	public $getlast_record;
	public $company_list;
	public $delete_row;
	public $get_update_data;
	public $store_image;
	public $update_row_company;



	public function initialize(){
       parent::initialize();
        $this->company_image=WWW_ROOT.'img/company/';
       $this->table_company=TableRegistry::get('tbl_company');

   }

   public function index(){
   	$this->redirect(array('controller'=>'company','action'=>'companylist'));
   }

  	public function addcompany(){

  		 $this->getlast_record= $this->table_company->find()->select(['company_id'])->last();
		 $com_idf=__('C').$this->getlast_record['company_id'].date('mY');
			$this->set('c_idf',$com_idf);


  		$this->company_entity=$this->table_company->newEntity();
  		if($this->request->is('post')){
				if($_FILES['image']['name'] != null && !empty($_FILES['image']['name'])){
					$store=$this->company_image.$_FILES['image']['name'];
					if(move_uploaded_file($_FILES['image']['tmp_name'], $store)){
						$img_default=$_FILES['image']['name'];
					}	
					}else{
						$img_default='default.png';
					}
				$this->company_data=$this->request->data;
				$this->company_data['photo']=$img_default;
				$this->save_company_data=$this->table_company->patchEntity($this->company_entity,$this->company_data);
				if($this->table_company->save($this->save_company_data)){
					$this->Flash->success(__('Company Record Inserted Successfully'));
					$this->redirect(array('controller'=>'company','action'=>'addcompany'));
				}
  		}


    }

    public function companylist(){
    	$this->company_list=$this->table_company->find();
    	$this->set('companylist',$this->company_list);

    }


    public function delete($id){
    	$this->delete_row = $this->table_company->get($id);
        	$this->request->is(array('post','delete'));
        	
        	if($this->table_company->delete($this->delete_row)){
        		$this->Flash->success(__('Company Record Delete Successfully', null), 'default', array('class' => 'success'));
        			
        	}
        	return $this->redirect(array('controller'=>'company','action'=>'companylist'));
    }

    public function updatecompany($id){

    	$this->get_update_data=$this->table_company->get($id);
    	$this->set('companydata',$this->get_update_data);


    	if($this->request->is(['post','put'])){

    							$c_data=$this->request->data;

                            $store=$this->company_image.$_FILES['image']['name'];
						if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
							move_uploaded_file($_FILES['image']['tmp_name'],$store);
							$this->store_image=$_FILES['image']['name'];
						}else{
							$this->store_image=$this->request->data('old_image');
						}
						
						
						
						
					$c_data['photo']=$this->store_image;
					
					
					
						$this->update_row_company=$this->table_company->patchEntity($this->get_update_data,$c_data);

						if($this->table_company->save($this->update_row_company)){
							$this->Flash->success(__('Company Record Updated Successfully'));
							return $this->redirect(array('controller'=>'company','action'=>'companylist'));
						}




				}

    }

}  	

?>