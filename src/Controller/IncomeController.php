<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FlashHelper;
use Cake\Datasource\ConnectionManager;
class IncomeController extends AppController{

	public $table_user;
	public $table_income;
	public $get_client_list;
	public $get_income_list;
	public $income_table_entity;
	public $save_income_data;
	public $row_delete;
	public $get_update_data;

	public function initialize(){
       parent::initialize();
   }

	 		public function Table_User(){ $this->table_user=TableRegistry::get('tbl_user'); }
			public function Table_Income(){ $this->table_income=TableRegistry::get('tbl_income'); }

   		public function index(){
   			$this->redirect(array('controller'=>'Income','action'=>'viewincome'));
   		}

			public function viewincome(){
				$this->Table_Income();
				$this->get_income_list=$this->table_income->find();
				$this->set('incomelist',$this->get_income_list);
			}
			
			

			public function updateincome($id){
				$this->Table_User();
				$this->Table_Income();
				
				$this->get_client_list=$this->table_user->find()->where(array('role'=>'client'));
				$this->set('clientlist',$this->get_client_list);
				$table_expenses_histiry =TableRegistry::get('tbl_income_history');
				$dataofhistory=$table_expenses_histiry->find()->where(array('tbl_income_id'=>$id))->toArray();
				$this->set('expensesdata',$dataofhistory);
				$this->get_update_data=$this->table_income->get($id);
				$this->set('update_row',$this->get_update_data);
				
				if($this->request->is(array('post','put'))){
						$data=$this->request->data;
						$all_value_entry1=$data['custom_value'];
						$all_label1=$data['custom_label'];

						$entry_data1=array();
					$i1=0;
				$table_expenses_histiry =TableRegistry::get('tbl_income_history');
				$dataofhistory=$table_expenses_histiry->find()->where(array('tbl_income_id'=>$id))->toArray();
				if(!empty($dataofhistory)){
				foreach($dataofhistory as $dataofhistorys)
				{
					$dataid = $dataofhistorys->id;
					$this->row_delete=$table_expenses_histiry->get($dataid);
				$table_expenses_histiry->delete($this->row_delete);
				} }
				if(!empty($all_value_entry1)){
				foreach ($all_value_entry1 as $one_entry1) {
					
						if(!empty($all_label1[$i1])){
					
							$expns_history['tbl_income_id'] = $id;
							$expns_history['income_amount'] =  $all_label1[$i1];
							$expns_history['label_income'] =  $one_entry1;

							$table_expenses_histiry =TableRegistry::get('tbl_income_history');

							$expense_table_entity_history = $table_expenses_histiry->newEntity();
							
							$save_expenses_history = $table_expenses_histiry->patchEntity($expense_table_entity_history,$expns_history);
							
							$table_expenses_histiry->save($save_expenses_history);
						}

				$i1++;
					}
				}

										$update_income=$this->table_income->patchEntity($this->get_update_data,$data);
										if($this->table_income->save($update_income)){
											$this->Flash->success(__('Income Update Successfully', null),'default',array('class' => 'alert alert-success'));
											return $this->redirect(array('controller'=>'Income','action'=>'viewincome'));
										}
									}
 }

			public function delete($id){
				$this->Table_Income();
				$this->request->is(['post','delete']);
				$this->row_delete=$this->table_income->get($id);
				if($this->table_income->delete($this->row_delete)){
					$this->Flash->success(__('Income Record Deleted Successfully'));
					return $this->redirect(array('controller'=>'Income','action'=>'viewincome'));
				}
			}

			public function monthincome(){
				
				if($this->request->is('post'))
			{ 
				$table_setting = TableRegistry::get('tble_setting');	   
				$first_data = $table_setting->find()->first();
				$this->set('first_data',$first_data);
				$start_date = $this->request->data('start_date');
				if($start_date)
				$this->set('start_date',$start_date);
				$end_date = $this->request->data('end_date');
				
				if($end_date)
				$this->set('end_date',$end_date);
			   $conn = ConnectionManager::get('default');
			   $request_list = $conn->execute('select *
					 from tbl_income
					where date <= "'.$start_date.' 00:00:00" 
					AND date >= "'.$end_date.' 00:00:00"
					')->fetchAll('assoc');
					
					$this->set('request_list',$request_list);
					if(empty($request_list)){
							$this->Flash->Success(__("Unsuccessful! Record Not Found."));
						}
			}
				
			}
   		public function addincome(){
				$this->Table_User();
				$this->Table_Income();

				$this->get_client_list=$this->table_user->find()->where(array('role'=>'client'));
				$this->set('clientlist',$this->get_client_list);
				
				
				$this->income_table_entity=$this->table_income->newEntity();
					if($this->request->is(array('post'))){
							$data=$this->request->data;
						  $all_value_entry=$data['custom_value'];
						  $all_label=$data['custom_label'];

					
						
						
						$this->save_income_data=$this->table_income->patchEntity($this->income_table_entity,$data);
						if($this->table_income->save($this->save_income_data)){
							$first_record = $this->table_income->find()->order(['income_id' => 'DESC'])->first();
							$last_id = $first_record['income_id'];
							$i=0;
						foreach ($all_value_entry as $one_entry) {
							if(!empty($all_label[$i])){
							
							
							$expns_history['tbl_income_id'] = $last_id;
							$expns_history['income_amount'] =  $all_label[$i];
							$expns_history['label_income'] =  $one_entry;

							$table_expenses_histiry =TableRegistry::get('tbl_income_history');

							$expense_table_entity_history = $table_expenses_histiry->newEntity();
							
							$save_expenses_history = $table_expenses_histiry->patchEntity($expense_table_entity_history,$expns_history);
							
							$table_expenses_histiry->save($save_expenses_history);
						}
							$i++;
						}
								$this->Flash->success(__('Income Record Inserted Successfully'));
								$this->redirect(array('controller'=>'Income','action'=>'addincome'));
						}

					}

   		}

}

?>
