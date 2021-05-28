<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;
use Cake\Routing\Route\Route;

class ProductController extends AppController{
	public $brand_list;
	public $table_category;
	public $category_list;
	public $unit_list;
	public $warehouse_list;
	public $table_product;
	public $table_product_entity;
	public $product_data;
	public $save_product_data;
	public $product_image;
	public $get_product_list;
	public $row_delete;
	public $row_update;
	public $image_store;
	
	public function initialize(){
       parent::initialize();
       $this->product_image=WWW_ROOT.'img/product/';
       $this->table_category=TableRegistry::get('category_master');
       $this->table_product=TableRegistry::get('tbl_product');
		$this->loadComponent('Flash');
   }

 
   	public function index(){
   		$this->redirect(array('controller'=>'Product','action'=>'productlist'));
   	}
   	

	public function addproduct($id=NULL){
        
        $getlast_record= $this->table_product->find()->select(['product_id'])->last();
		$product_idf=__('PR').$getlast_record['product_id'].rand(11,99).date('mY');
		$this->set('purchase_idf',$product_idf);
            
      
        
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
		
		$this->table_product_entity=$this->table_product->newEntity();
		
		if(isset($id)){
			$data=$this->request->data;
			$this->row_update=$this->table_product->get($id);
			$this->set('get_row_update',$this->row_update);
			
			if($this->request->is(['post','put'])){
			$ext = pathinfo($this->request->data('originaladdedimage'), PATHINFO_EXTENSION);
			$valid_extension = ['gif','png','jpg','jpeg',""];
			if(in_array($ext,$valid_extension) )
			{	
				$dataimage = $this->request->data('client_image');
				if($dataimage != '')
				{
					$first_name = $this->request->data('item_name');
					$time = time();
					$imagename = $first_name.'_'.$time.'.png';
					
					$source = fopen($dataimage, 'r');
					$destination = fopen('img/product/'.$imagename, 'w');

					stream_copy_to_stream($source, $destination);

					fclose($source);
					fclose($destination);
				}else{
					$imagename=$this->request->data('image2');
				}
				
				$data['image']=$imagename;
				$update_data_product=$this->table_product->patchEntity($this->row_update,$data);
					
				if($this->table_product->save($update_data_product)){
					$this->Flash->success(__('Product Record Updated Successfully'));
					return $this->redirect(['controller'=>'Product','action'=>'productlist']);
				}
			}else{
				$this->Flash->success(__('Invalid File Attachment'));
				$this->redirect(array('controller'=>'Product','action'=>'productlist'));
			}
					
			}

		}else{
			
			if($this->request->is('post')){
			
			$ext = pathinfo($this->request->data('originaladdedimage'), PATHINFO_EXTENSION);
			$valid_extension = ['gif','png','jpg','jpeg',""];
			if(in_array($ext,$valid_extension) )
			{
				$dataimage = $this->request->data('client_image');
				if($dataimage != '')
				{
				$first_name = $this->request->data('item_name');
				
				$time = time();
				$imagename = $first_name.'_'.$time.'.png';
				
				$source = fopen($dataimage, 'r');
				$destination = fopen('img/product/'.$imagename, 'w');

				stream_copy_to_stream($source, $destination);

				fclose($source);
				fclose($destination);
				}
				else
				{
					$imagename = 'default.png';
				}
			
				$this->product_data=$this->request->data;

				$this->product_data['image']=$imagename;
                
				$this->save_product_data=$this->table_product->patchEntity($this->table_product_entity,$this->product_data);
				if($this->table_product->save($this->save_product_data)){
					$this->Flash->success(__('Product Record Inserted Successfully'));
					return $this->redirect(['controller'=>'Product','action'=>'productlist']);
				}
			}
			else{
				$this->Flash->success(__('Invalid File Attachment'));
				$this->redirect(array('controller'=>'Product','action'=>'addproduct'));
			}
			}
			
		}
		
		

	}
	
	public function delete($id){
		 
		$this->request->is(['post','delete']);
		$this->row_delete=$this->table_product->get($id);
		if($this->table_product->delete($this->row_delete)){
			$this->Flash->success(__('Product Record Deleted Successfully'));
			return $this->redirect(['controller'=>'product','action'=>'productlist']);
		}
	}
	
	public function productlist(){
			$this->get_product_list=$this->table_product->find()->where(array('is_archive'=>0))->toArray();
			$this->set('productlist',$this->get_product_list);

	}
	
	public function archiveproduct(){
		$this->get_product_list=$this->table_product->find()->where(array('is_archive'=>1))->toArray();
			$this->set('productlist',$this->get_product_list);
    }
}

?>