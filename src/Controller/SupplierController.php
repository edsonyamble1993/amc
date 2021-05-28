<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;
use Cake\I18n\Time;


class SupplierController extends AppController{

		public $user_image;
	
	public function initialize(){
		$this->user_image=WWW_ROOT.'img/user/';
        parent::initialize();
   }

		public function index(){
			$this->redirect(array('controller'=>'Supplier','action'=>'suppliers'));
		}

	     public function clientlist(){
				$this->get_client_data=$this->table_user->find()->where(array('role'=>'client'));
			 	$this->set('client_data',$this->get_client_data);
	     }

		public function delete($id){
			$table_user=TableRegistry::get('tbl_supplier');
			$this->request->is(['post','delete']);
			$row_delete=$table_user->get($id);
			if($table_user->delete($row_delete)){
				$this->Flash->success(__('Supplier Record Deleted Successfully'));
				return $this->redirect(array('controller'=>'Supplier','action'=>'suppliers'));
			}
		}
	
	
  	public function supplier($id=NULL){

  				// $table_user=TableRegistry::get('tbl_user');
  				$supplier = TableRegistry::get('tbl_supplier');
				$get_last_userid= $supplier->find()->select(['id'])->last();
				$this->user_entity=$supplier->newEntity();
				$supplier_idf=__('S').$this->getlast_record['id'].rand(11,99).date('mY');
				$this->set('supplier_idf',$supplier_idf);

				$table_user_entity=$supplier->newEntity();
				
				
				if(!empty($id) && isset($id)){
					//For get international code
					$international_code = TableRegistry::get('international_code');
					$code_data = $international_code->find();
					$this->set('code_data',$code_data);
					$this->set('action_a','edit');
					$this->set('supplier_id',$id);
					$get_supplier_record=$supplier->get($id);

					$this->set('supplier_update',$get_supplier_record);

					if($this->request->is(array('post'))){
						$ext = pathinfo($this->request->data('originaladdedimage'), PATHINFO_EXTENSION);
						$valid_extension = ['gif','png','jpg','jpeg',""];
						if(in_array($ext,$valid_extension) )
						{
						$data=$this->request->data;
						$dataimage = $this->request->data('client_image');
						if($dataimage != '')
						{
							$first_name = $this->request->data('first_name');
							$last_name = $this->request->data('last_name');
							$time = time();
							$imagename = $first_name.'_'.$last_name.'_'.$time.'.png';
					
							$source = fopen($dataimage, 'r');
							$destination = fopen('img/user/'.$imagename, 'w');

							stream_copy_to_stream($source, $destination);

							fclose($source);
							fclose($destination);
							}else{
								$imagename=$this->request->data('old_image');
							}

					   
						   $data['supplier_code']=$this->request->data('supplier_no');
						   $data['photo']=$imagename;


					
							$update_row_warr=$supplier->patchEntity($get_supplier_record,$data);
							if($supplier->save($update_row_warr)){
							
							//For add international detail
							$international_dtl = TableRegistry::get('supplier_international_detail');
							if(isset($this->request->data['code']) && !empty($this->request->data['code']))
							{
							$detail_data = $data['code'];//debug($detail_data);die;
							foreach($detail_data['code_id'] as $key => $data)
							{
								
								
								$cnt = $international_dtl->find()->where(['supplier_id'=>$id,'code_id'=>$detail_data['code_id'][$key]])->count();
								
								if($cnt)
								{
									$entity_row = $international_dtl->find()->where(['supplier_id'=>$id,'code_id'=>$detail_data['code_id'][$key]])->hydrate(false)->toArray();
									$row_id = $entity_row[0]['detail_id'];
									$update_row = $international_dtl->get($row_id);
									$update_row['detail'] = $detail_data['detail'][$key];
									$international_dtl->save($update_row);
								}
								else{
									$save['code_id'] = $detail_data['code_id'][$key];
									$save['supplier_id'] = $id;
									$save['detail'] = $detail_data['detail'][$key];
									$entity_row = $international_dtl->newEntity();
									$record = $international_dtl->patchEntity($entity_row,$save);
									$international_dtl->save($record);
								}
							}
							}
							$this->Flash->success(__('Supplier Record Updated Successfully'));
							return $this->redirect(array('controller'=>'supplier','action'=>'suppliers'));
							}
						}
						else{
							$this->Flash->success(__('Invalid File Attachment !'));
							return $this->redirect(array('controller'=>'supplier','action'=>'supplier'));
						}
						}


					}else{
						//For get international code
						$international_code = TableRegistry::get('international_code');
						$code_data = $international_code->find();
						$this->set('code_data',$code_data);
						$this->set('action_a','add');
				if($this->request->is('post')){

					$data=$this->request->data;
					//debug($data);die;
	           // if(isset($data['image']['name']) && !empty($data['image']['name'])){
							// $store=$this->user_image.$data['image']['name'];
						// if(move_uploaded_file($data['image']['tmp_name'], $store)){
							// $img_default=$data['image']['name'];
						// }
					   // }else{
					    	// $img_default='default.png';
					    // }
						$ext = pathinfo($this->request->data('originaladdedimage'), PATHINFO_EXTENSION);
						$valid_extension = ['gif','png','jpg','jpeg',""];
						if(in_array($ext,$valid_extension) )
						{
							$dataimage = $this->request->data('client_image');
							if($dataimage != '')
							{
								$first_name = $this->request->data('first_name');
								$last_name = $this->request->data('last_name');
								$time = time();
								$imagename = $first_name.'_'.$last_name.'_'.$time.'.png';
								
								$source = fopen($dataimage, 'r');
								$destination = fopen('img/user/'.$imagename, 'w');

								stream_copy_to_stream($source, $destination);

								fclose($source);
								fclose($destination);
							}else{
								$imagename = 'default.png';
							}
						
						
							$data['supplier_code']=$this->request->data('supplier_no');
							$data['photo']=$imagename;

				

						
					$save_user_data=$supplier->patchEntity($table_user_entity,$data);
					if($supplier->save($save_user_data)){
					$supplier_id = $save_user_data->id;
					
					//For add international detail
					$international_dtl = TableRegistry::get('supplier_international_detail');
					if(isset($data['code']) && !empty($data['code']))
					{
						$detail_data = $data['code'];//debug($detail_data);die;
						foreach($detail_data['code_id'] as $key => $data)
						{
							$save['code_id'] = $detail_data['code_id'][$key];
							$save['supplier_id'] = $supplier_id;
							$save['detail'] = $detail_data['detail'][$key];
							$entity_row = $international_dtl->newEntity();
							$record = $international_dtl->patchEntity($entity_row,$save);
							$international_dtl->save($record);
						}
					}
					
   		      		$this->Flash->success('Supplier Successfully added');
   		      		return $this->redirect(array('controller'=>'supplier','action'=>'suppliers'));
   		      	}
						}
						else
						{
							$this->Flash->success(__('Invalid File Attachment'));
							$this->redirect(array('controller'=>'client','action'=>'supplier'));
						}

			}
					}
    }

    public function suppliers(){
    		$supplire=TableRegistry::get('tbl_supplier');
    		$get_supplier_name=$supplire->find()->toArray();

    		if(count($get_supplier_name) > 0){
    			$this->set('supplier_list',$get_supplier_name);
    		}



    }


	
	

	
   	
	



}  	

?>