<?php
namespace App\Controller;


use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;
use Cake\Datasource\ConnectionManager;

class ReportController extends AppController
{
	public function initialize(){
        parent::initialize();
        $this->attachment_store=WWW_ROOT.'img/attachment/';
		$this->loadComponent('AMCfunction');
        }
		 public function viewservicesreports()
		{
			/*Load Customer Data*/
				$this->table_user  =  TableRegistry::get('tbl_user');
				$this->load_customer_data=$this->table_user->find()->where(array('role'=>'client'));
				$this->set('client_info',$this->load_customer_data);
				if($this->request->is('post'))
			{ 
				$start_date = $this->request->data('start_date');
				if($start_date)
				$this->set('start_date',$start_date);
				$end_date = $this->request->data('end_date');
				if($end_date)
				$this->set('end_date',$end_date);
				$clientoption = $this->request->data('client_id');
				$conn = ConnectionManager::get('default');
				if($clientoption == 'all')
				{
						
					$title = 'All Services';
					
					$righttitle = 'Number of Services';
					$downtitle = 'Services Month';
					
					$request_list = $conn->execute('select service_date,
					COUNT(*) as count from tbl_manage_service
					where service_date >= "'.$start_date.' 00:00:00" 
					AND service_date <= "'.$end_date.' 00:00:00"
					GROUP By MONTH(service_date), YEAR(service_date)
					')->fetchAll('assoc');	
					
					$this->set('title',$title);
					$this->set('righttitle',$righttitle);
					$this->set('clintdata',$clientoption);
					$this->set('downtitle',$downtitle);
					
					if($request_list)		
						$this->set('result_data',$request_list);
						else
						{
							$this->Flash->Success(__("Unsuccessful! Record Not Found."));
						}
					
					
					
				}else
				{
					$title = 'Client Services';
					
					$righttitle = 'Number of Services';
					$downtitle = 'Services Month';
					
					$request_list = $conn->execute('select service_date,
					COUNT(*) as count from tbl_manage_service
					where service_date >= "'.$start_date.' 00:00:00" 
					AND service_date <= "'.$end_date.' 00:00:00"
					AND customer_id = "'.$clientoption.'"
					GROUP By MONTH(service_date), YEAR(service_date)
					')->fetchAll('assoc');	
					
					$this->set('title',$title);
					$this->set('righttitle',$righttitle);
					$this->set('clintdata',$clientoption);
					$this->set('downtitle',$downtitle);
					
					if($request_list)		
						$this->set('result_data',$request_list);
						else
						{
							$this->Flash->Success(__("Unsuccessful! Record Not Found."));
						}
				}
			}	
				
		}
		 public function viewsalereport()
		{
				/*Load Customer Data*/
				$this->table_user  =  TableRegistry::get('tbl_user');
				$this->load_customer_data=$this->table_user->find()->where(array('role'=>'client'));
				$this->set('client_info',$this->load_customer_data);
			if($this->request->is('post'))
			{ 
				$start_date = $this->request->data('start_date');
				if($start_date)
				$this->set('start_date',$start_date);
				$end_date = $this->request->data('end_date');
				if($end_date)
				$this->set('end_date',$end_date);
				$clientoption = $this->request->data('client_id');
				$conn = ConnectionManager::get('default');
				if($clientoption == 'all')
				{
						
					$title = 'All Sales';
					
					$righttitle = 'Number of Sales';
					$downtitle = 'Sales Month';
					
					$request_list = $conn->execute('select date,
					COUNT(*) as count from tbl_sales
					where date >= "'.$start_date.' 00:00:00" 
					AND date <= "'.$end_date.' 00:00:00"
					GROUP By MONTH(date), YEAR(date)
					')->fetchAll('assoc');	
					
					$this->set('title',$title);
					$this->set('righttitle',$righttitle);
					$this->set('clintdata',$clientoption);
					$this->set('downtitle',$downtitle);
					
					if($request_list)		
						$this->set('result_data',$request_list);
						else
						{
							$this->Flash->Success(__("Unsuccessful! Record Not Found."));
						}
					
					
					
				}else
				{
					$title = 'Client Sales';
					
					$righttitle = 'Number of Sales';
					$downtitle = 'Sales Month';
					
					$request_list = $conn->execute('select date,
					COUNT(*) as count from tbl_sales
					where date >= "'.$start_date.' 00:00:00" 
					AND date <= "'.$end_date.' 00:00:00"
					AND customer_id = "'.$clientoption.'"
					GROUP By MONTH(date), YEAR(date)
					')->fetchAll('assoc');	
					
					$this->set('title',$title);
					$this->set('righttitle',$righttitle);
					$this->set('clintdata',$clientoption);
					$this->set('downtitle',$downtitle);
					
					if($request_list)		
						$this->set('result_data',$request_list);
						else
						{
							$this->Flash->Success(__("Unsuccessful! Record Not Found."));
						}
				}
			}		
				
				
		}
		
		
		 public function viewreport(){
			 
			 /*Load Customer Data*/
			 $this->table_user  =  TableRegistry::get('tbl_user');
			$this->load_customer_data=$this->table_user->find()->where(array('role'=>'client'));
			$this->set('client_info',$this->load_customer_data);
			 
			if($this->request->is('post'))
			{ 
				$start_date = $this->request->data('start_date');
				
				if($start_date)
				$this->set('start_date',$start_date);
			
				$end_date = $this->request->data('end_date');
				if($end_date)
				$this->set('end_date',$end_date);
				$selectoption = $this->request->data('select_option');
				$clientoption = $this->request->data('client_id');
				
				$conn = ConnectionManager::get('default');
				if($selectoption == "all" && $clientoption == 'all')
				{
						
					$title = 'All Complaints';
					
					$righttitle = 'Number of Complaints';
					$downtitle = 'Complaints Month';
					$optionselect = $selectoption;
					$request_list = $conn->execute('select complaint_date,
					COUNT(*) as count from tbl_complaint
					where complaint_date >= "'.$start_date.' 00:00:00" 
					AND complaint_date <= "'.$end_date.' 00:00:00"
					GROUP By MONTH(complaint_date), YEAR(complaint_date)
					')->fetchAll('assoc');	
					
					$this->set('title',$title);
					$this->set('righttitle',$righttitle);
					$this->set('clintdata',$clientoption);
					$this->set('downtitle',$downtitle);
					$this->set('seletoption',$optionselect);
					if($request_list)		
						$this->set('result_data',$request_list);
						else
						{
							$this->Flash->Success(__("Unsuccessful! Record Not Found."));
						}
					
					
					
				}
				elseif($selectoption == "all" && $clientoption != 'all')
				{
						
					$title = 'All Complaints';
					
					$righttitle = 'Number of Complaints';
					$downtitle = 'Complaints Month';
					$optionselect = $selectoption;
					$request_list = $conn->execute('select complaint_date,
					COUNT(*) as count from tbl_complaint
					where complaint_date >= "'.$start_date.' 00:00:00" 
					AND complaint_date <= "'.$end_date.' 00:00:00"
					AND customer_id = "'.$clientoption.'"
					GROUP By MONTH(complaint_date), YEAR(complaint_date)
					')->fetchAll('assoc');	
					
					$this->set('clintdata',$clientoption);
					$this->set('title',$title);
					$this->set('righttitle',$righttitle);
					$this->set('downtitle',$downtitle);
					$this->set('seletoption',$optionselect);
					if($request_list)		
						$this->set('result_data',$request_list);
						else
						{
							$this->Flash->Success(__("Unsuccessful! Record Not Found."));
						}
					
					
					
				}
				elseif($selectoption != "all" && $clientoption == 'all')
				{
					
					if($selectoption == 1)
					{
					$title = 'Open Complaints';
					}
					if($selectoption == 2)
					{
					$title = 'Progress Complaints';
					}
					if($selectoption == 0)
					{
					$title = 'Closed Complaints';
					}
					$title = 'All Complaints';
					
					$righttitle = 'Number of Complaints';
					$downtitle = 'Complaints Month';
					$optionselect = $selectoption;
					$request_list = $conn->execute('select complaint_date,
					COUNT(*) as count from tbl_complaint
					where complaint_date >= "'.$start_date.' 00:00:00" 
					AND complaint_date <= "'.$end_date.' 00:00:00"
					AND status = '.$selectoption.'
					GROUP By MONTH(complaint_date), YEAR(complaint_date)
					')->fetchAll('assoc');	
					
					$this->set('clintdata',$clientoption);
					$this->set('title',$title);
					$this->set('righttitle',$righttitle);
					$this->set('downtitle',$downtitle);
					$this->set('seletoption',$optionselect);
					if($request_list)		
						$this->set('result_data',$request_list);
						else
						{
							$this->Flash->Success(__("Unsuccessful! Record Not Found."));
						}
					
					
					
				}
				else
				{
					if($selectoption == 1)
					{
					$title = 'Open Complaints';
					}
					if($selectoption == 2)
					{
					$title = 'Progress Complaints';
					}
					if($selectoption == 0)
					{
					$title = 'Closed Complaints';
					}
					$optionselect = $selectoption;
					$righttitle = 'Number of Complaints';
					$downtitle = 'Complaints Month';
					
					$request_list = $conn->execute('select complaint_date,
					COUNT(*) as count from tbl_complaint
					where complaint_date >= "'.$start_date.' 00:00:00" 
					AND complaint_date <= "'.$end_date.' 00:00:00"
					AND status = '.$selectoption.'
					AND customer_id = "'.$clientoption.'"
					GROUP By MONTH(complaint_date), YEAR(complaint_date)
					')->fetchAll('assoc');	
					// var_dump($request_list);
					// die;
					$this->set('title',$title);
					$this->set('righttitle',$righttitle);
					$this->set('downtitle',$downtitle);
					$this->set('seletoption',$optionselect);
					$this->set('clintdata',$clientoption);
					if($request_list)		
						$this->set('result_data',$request_list);
						else
						{
							$this->Flash->Success(__("Unsuccessful! Record Not Found."));
						}
				}
			
			}
		 }
			 
}