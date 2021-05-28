<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FlashHelper;


class TaxController extends AppController
{
	public function initialize(){
       parent::initialize();
       $this->attachment_store=WWW_ROOT.'img/attachment/';
       
   }
	 public function TableTax(){ $this->table_task=TableRegistry::get('tbl_account_tax_rates'); }
	public function viewtax(){
			$this->TableTax();
			
			if($this->request->session()->read('user_role') == 'admin'){
				$this->get_all_task_data=$this->table_task->find();
			    $this->set('taskdatalist',$this->get_all_task_data);	
	        }
			
			
			
	}
	 public function addtax($id=NULL)
    {
		if(isset($id)){
				$update_data=$this->request->data;
				$tbl_account_tax_rates=TableRegistry::get('tbl_account_tax_rates');
				$tbl_account=$tbl_account_tax_rates->get($id);
				$this->set('get_row_update',$tbl_account);
				if($this->request->is(['post','put'])){
				
				$update_data=$this->request->data;
				
				
					$update_data_task=$tbl_account_tax_rates->patchEntity($tbl_account,$update_data);
						
					if($tbl_account_tax_rates->save($update_data_task)){
						$this->Flash->success(__('Tax Record Updated Successfully'));
						return $this->redirect(['controller'=>'Tax','action'=>'viewtax']);
					}
				}
			}else{
		if($this->request->is('post')){
				
				
				$tax_data=$this->request->data;
				$taxname = $this->request->data('acount_tax_name');
				$tbl_account_tax_rates=TableRegistry::get('tbl_account_tax_rates');
				 $countrecord = $tbl_account_tax_rates->find()->where(array('acount_tax_name' => $taxname))->count();
                 if($countrecord == 0)
				 {					 
				$this->task_table_entity=$tbl_account_tax_rates->newEntity();
				$this->save_task_data=$tbl_account_tax_rates->patchEntity($this->task_table_entity,$tax_data);
				if($tbl_account_tax_rates->save($this->save_task_data)){
					$this->Flash->success(__('Tax Record Inserted Successfully'));
					$this->redirect(array('controller'=>'tax','action'=>'viewtax'));
				}
				 }else
				 {
					 $this->Flash->success(__('This Record is Duplicate'));
					$this->redirect(array('controller'=>'tax','action'=>'addtax'));
				 }
			}
			}

    }
	public function delete($id)
    {
		$tbl_account_tax_rates=TableRegistry::get('tbl_account_tax_rates');
		$this->delete_row = $tbl_account_tax_rates->get($id);
		$this->request->is(array('post','delete'));
		 
		if($tbl_account_tax_rates->delete($this->delete_row)){
			$this->Flash->success(__('Tax Record Deleted Successfully', null), 'default', array('class' => 'success'));
			 
		}
		return $this->redirect(array('controller'=>'tax','action'=>'viewtax'));
    }
	
	public function internationcode($code_id = NULL)
    {
		$international_code=TableRegistry::get('international_code');
		if(isset($code_id))
		{
			$tab_name = 'Edit Income Tax Code'; 
			$header = 'Edit Income Tax Code';
			$this->set('tab_name',$tab_name);
			$this->set('header',$header);
			$row = $international_code->get($code_id);
			$this->set('row',$row);
		}
		else
		{
			$tab_name = 'Add Income Tax Code'; 
			$header = 'Add Income Tax Code';
			$this->set('tab_name',$tab_name);
			$this->set('header',$header);
		}
		
		if($this->request->is('post'))
		{	
	
			if(isset($code_id))
			{
				$post = $this->request->data();
				
				$row = $international_code->get($code_id);
				$row['code_title'] = $post['international_code_name'];
				
				if($international_code->save($row)){
					$this->Flash->success(__('Tax Record Updated Successfully'));
					$this->redirect(array('controller'=>'tax','action'=>'viewcode'));
				}
			}
			else
			{
				$post = $this->request->data();
				
				$row = $international_code->newEntity();
				$row['code_title'] = $post['international_code_name'];
				$row['created_date'] = date('Y-m-d');
				$row['created_by'] = $this->request->session()->read('user_id');
				
				if($international_code->save($row)){
					$this->Flash->success(__('Tax Record Inserted Successfully'));
					$this->redirect(array('controller'=>'tax','action'=>'viewcode'));
				}
			}
		}
	}
	
	public function viewcode()
    {
		if($this->request->session()->read('user_role') == 'admin')
		{
			$international_code=TableRegistry::get('international_code');	
			$code_data = $international_code->find();
			$this->set('code_data',$code_data);	
	    }
	}
	
	public function deletecode($id)
    {
		$international_code=TableRegistry::get('international_code');
		$delete_row = $international_code->get($id);
		 
		if($international_code->delete($delete_row)){
			$this->Flash->success(__('Tax Record Deleted Successfully', null),
			'default', array('class' => 'success'));
			 
		}
		return $this->redirect(array('controller'=>'tax','action'=>'viewcode'));
    }
}
