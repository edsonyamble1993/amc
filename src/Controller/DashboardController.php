<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper\FlashHelper;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;



class DashboardController extends AppController
{
	public function initialize(){
       parent::initialize();
		$this->loadComponent('Flash');
		$this->loadComponent('AMCfunction');
   }
    
    public function todayservice(){
        
        return $this->redirect(array('controller'=>'service','action'=>'todayservice'));
        
        
    }
	
	public function clientdashboard(){
        
          $connection = ConnectionManager::get('default');
         $user_table=TableRegistry::get('tbl_user');
        $amc_table=TableRegistry::get('tbl_amc');
        $product_table=TableRegistry::get('tbl_product');
        $complaint_table=TableRegistry::get('tbl_complaint');
        $service_table=TableRegistry::get('tbl_service');
        $tbl_quotation=TableRegistry::get('tbl_quotation');
        $tbl_sales=TableRegistry::get('tbl_sales');
        
		
       $get_daily_complaint=$complaint_table->find('all', array('limit' => 5))->where(['customer_id'=>$this->request->session()->read('user_id')])->order(array('complaint_id'=>'DESC'))->toArray();
        if(count($get_daily_complaint) > 0){
             $this->set('complaint_data',$get_daily_complaint); 
        }
		$tbl_manage_service=TableRegistry::get('tbl_manage_service');
		$thismonthservice = $tbl_manage_service->find('all',array('conditions'=> array('DATE_FORMAT(tbl_manage_service.service_date,"%m") = "'.date("m").'"','DATE_FORMAT(tbl_manage_service.service_date,"%y") = "'.date("y").'"')))->where(['customer_id'=>$this->request->session()->read('user_id')])->toArray();
		$this->set('thismonthservice',$thismonthservice);
        
		
		$userid = $this->request->session()->read('user_id');
			$amcrecords=$amc_table->find('all', array('limit' => 5))->where(['customer_id'=>$userid])->order(array('amc_id'=>'DESC'))->toArray();
        if(count($amcrecords) > 0){
             $this->set('amclist',$amcrecords); 
        }
        
          // Total Complaint
		$user_id=$this->request->session()->read('user_id');
        $totalcomment=$complaint_table->find()->where(array('customer_id'=>$user_id))->count();
        $this->set('totalcomment',$totalcomment);
        
		 // calender data Count
        $get_employee_count=$tbl_manage_service->find()->where(['customer_id'=>$userid])->toArray();
        $this->set('calenderdata',$get_employee_count);
		
        // Open Complaint
        $opencomment=$complaint_table->find()->where(array('customer_id'=>$user_id,'status'=>1))->count();
        $this->set('opencomment',$opencomment);
		
		// closed Complaint
        $closedcomplaints=$complaint_table->find()->where(array('customer_id'=>$user_id,'status'=>0))->count();
        $this->set('closedcomplaints',$closedcomplaints);
        
        // Progress Complaint
        $progresscomplaints=$complaint_table->find()->where(array('customer_id'=>$user_id,'status'=>2))->count();
        $this->set('progresscomplaints',$progresscomplaints);
        
        //Total Quotation
        $quotationcustomer=$tbl_quotation->find()->where(array('customer_id'=>$user_id))->count();
        $this->set('quotationcustomer',$quotationcustomer);
       
        
        //Your Sales
        $salescount = $tbl_sales->find()->where(array('customer_id'=>$user_id))->count();
        $this->set('salescount',$salescount);
        
        //Product Service
        $get_service_count=$service_table->find()->where(array('customer_id'=>$this->request->session()->read('user_id')))-> where(array('status'=>0))->count();
        $this->set('service_count',$get_service_count);
        
        $today_date=date('Y-m-d');
        $customer_id=$this->request->session()->read('user_id');
       
        
        
        // Open AMC Services
        
        $get_open_amc_service=$amc_table->find()->where(array('customer_id'=>$this->request->session()->read('user_id')))->andwhere(array('status'=>1))->count();
        $this->set('open_amc_service_count',$get_open_amc_service);
        
        
		//Progress AMC Service
        $get_progress_amc_service=$amc_table->find()->where(array('customer_id'=>$this->request->session()->read('user_id')))->andwhere(array('status'=>2))->count();
        $this->set('progress_amc_service_count',$get_progress_amc_service);
        
        // Open Service
        
        $get_open_service=$service_table->find()->where(array('customer_id'=>$this->request->session()->read('user_id')))->andwhere(array('status'=>0))->count();
        $this->set('open_service',$get_open_service);
        
         $get_pending_service=$service_table->find()->where(array('customer_id'=>$this->request->session()->read('user_id')))->andwhere(array('status'=>2))->count();
        $this->set('pending_service',$get_pending_service);
        
        
        // Open Complaint
        $get_open_compaint=$complaint_table->find()->where(array('status'=>1))->count();
        $this->set('open_complaint',$get_open_compaint);
        
        
        
        
        
   	
	}
	
	public function employeedashboard(){
        
           $connection = ConnectionManager::get('default');
        
        $user_table=TableRegistry::get('tbl_user');
        $amc_table=TableRegistry::get('tbl_amc');
        $product_table=TableRegistry::get('tbl_product');
        $complaint_table=TableRegistry::get('tbl_complaint');
        $service_table=TableRegistry::get('tbl_service');
        
        
			$userid = $this->request->session()->read('user_id');
			$amcrecords=$amc_table->find('all', array('limit' => 5))->where(['assign_to_id'=>$userid])->order(array('amc_id'=>'DESC'))->toArray();
        if(count($amcrecords) > 0){
             $this->set('amclist',$amcrecords); 
        }
			
		
		$tbl_manage_service=TableRegistry::get('tbl_manage_service');
		$thismonthservice = $tbl_manage_service->find('all',array('conditions'=> array('DATE_FORMAT(tbl_manage_service.service_date,"%m") = "'.date("m").'"','DATE_FORMAT(tbl_manage_service.service_date,"%y") = "'.date("y").'"')))->where(['assign_to'=>$this->request->session()->read('user_id')])->toArray();
		$this->set('thismonthservice',$thismonthservice);
                
          // Employee Count
        $get_employee_count=$user_table->find()->where(array('role'=>'employee'))->count();
        $this->set('employee_count',$get_employee_count);
        
        // Client Client
        $get_client_count=$user_table->find()->where(array('role'=>'client'))->count();
        $this->set('client_count',$get_client_count);
        
		  // calender data Count
        $get_employee_count=$tbl_manage_service->find()->where(['assign_to'=>$userid])->toArray();
        $this->set('calenderdata',$get_employee_count);
		
		
        // Total AMC
        $get_amc_count=$amc_table->find()->count();
        $this->set('amc_count',$get_amc_count);
        
        //Total Product
        $get_product_count=$product_table->find()->count();
        $this->set('product_count',$get_product_count);
       
        
       //Product Complaint
        $get_complaint_count=$complaint_table->find()->count();
        $this->set('complaint_count',$get_complaint_count);
        
        //Product Service
        $get_service_count=$service_table->find()->where(array('assign_to'=>$this->request->session()->read('user_id')))-> where(array('status'=>0))->count();
        $this->set('service_count',$get_service_count);
        
          // Open AMC Services
        
        $get_open_amc_service=$amc_table->find()->where(array('status'=>1))->count();
        $this->set('open_amc_service_count',$get_open_amc_service);
        
        //Progress AMC Service
        $get_progress_amc_service=$amc_table->find()->where(array('status'=>2))->count();
        $this->set('progress_amc_service_count',$get_progress_amc_service);
        
		 //Daily Complaint
		 
       $get_daily_complaint=$complaint_table->find('all', array('limit' => 5))->where(['assign_to'=>$this->request->session()->read('user_id')])->order(array('complaint_id'=>'DESC'))->toArray();
        if(count($get_daily_complaint) > 0){
             $this->set('complaint_data',$get_daily_complaint); 
        }
		
        // Open Service
        
        $get_open_service=$service_table->find()->where(array('status'=>0))->count();
        $this->set('open_service',$get_open_service);
        
         $get_pending_service=$service_table->find()->where(array('status'=>2))->count();
        $this->set('pending_service',$get_pending_service);
        
        
        // Open Complaint
        $get_open_compaint=$complaint_table->find()->where(array('status'=>1))->count();
        $this->set('open_complaint',$get_open_compaint);
		
		
		$get_to_day_service=$service_table->find()->where(array('status'=>2))->andwhere(array('assign_to'=>$this->request->session()->read('user_id')))->andwhere(array('date'=>date('Y-m-d')))->toArray();
		$new_array_service=array();
		
			foreach($get_to_day_service as $service_key=>$service_data){
				$new_array_service[]=array(
					'title'=>$service_data['service_details'],
					'url'=>'',
					'start'=>date($this->AMCfunction->getDateFormat(),strtotime($service_data['date']))
				);
			}
			$this->set('service_data_var',$new_array_service);
			$this->set('service_data_info',$get_to_day_service);
			
		//	$get_employee_complaint=$complaint_table->find()->where(array('assign_to'=>$this->request->session()->read('user_id')))->andwhere(array(''))
        
			$get_currunt_user_id=$this->request->session()->read('');
		
		  $get_record_str_complaint="SELECT * FROM `tbl_complaint` WHERE assign_to=23 and status<>0 ";
     
          $results_complaint = $connection->execute($get_record_str_complaint)->fetchAll('assoc');
		  
		  if(count($results_complaint) > 0){
			   $this->set('result_complaint',$results_complaint);
		  }
        
        
         $get_amc=$amc_table->find()->where(array('status'=>2))->order(array('amc_id'=>'DESC'))->toArray();
        
        if(count($get_amc)>0){
            
            $get_new_array=array();
            
            
            foreach($get_amc as $remainder_records){
                 $StartDate=date($this->AMCfunction->getDateFormat());
                 $EndDate=date($this->AMCfunction->getDateFormat(),strtotime($remainder_records['end_date']));
                
                $get_new_array[]=array(
                                      'amc_no'=>$remainder_records['amc_no'],
                                      'reminder'=>$this->Get_Date_Difference($StartDate,$EndDate),
                                      'customer_id'=>$remainder_records['customer_id']
                );
                
                
               
                
            }
          
            
            
          $this->set('remainder_amc',$get_new_array);
            
		 
		
        
	    }
    }

	public function dashboard(){
		

        $connection = ConnectionManager::get('default');
        
        $user_table=TableRegistry::get('tbl_user');
        $amc_table=TableRegistry::get('tbl_amc');
        $product_table=TableRegistry::get('tbl_product');
        $complaint_table=TableRegistry::get('tbl_complaint');
        $service_table=TableRegistry::get('tbl_service');
        $tbl_manage_service=TableRegistry::get('tbl_manage_service');
        $tbl_amc=TableRegistry::get('tbl_amc');
        
		// closed complain
		$conn = ConnectionManager::get('default');
		$datediff = $conn->execute('SELECT DATEDIFF(close_date,complaint_date) as days,COUNT(*) as count FROM tbl_complaint GROUP BY days')->fetchAll('assoc');
		$one_day = 0;
		$two_day = 0;
		$more = 0;
		if(!empty($datediff))
		{
			foreach($datediff as $datediffs)
			{
				$days = $datediffs['days'];
				if($days == 0)
				{
					$one_day = $datediffs['count'];
				}
				if($days == 1)
				{
					$two_day = $datediffs['count'];
				}
				if($days>1)
				{
					$more += $datediffs['count'];
				}
			}
		}
		
		// closed service
		
		$chart = array();
		$chart[] = array('Task', 'Hours per Day');
		$chart[] = array('Same Day Closed', (int)$one_day);
		$chart[] = array('Next Day Closed', (int)$two_day);
		$chart[] = array('Closing After 48 hours', (int)$more);
		$piechart = json_encode($chart);
		 $this->set('piechart',$piechart);
		 
		 
		 
		 // closed service
		$conn = ConnectionManager::get('default');
		$datediff = $conn->execute('SELECT DATEDIFF(done_date,service_date) as days,COUNT(*) as count FROM tbl_manage_service WHERE done_status=1 GROUP BY days')->fetchAll('assoc');
		$one_day_service = 0;
		$two_day_service = 0;
		$more_service = 0;
		if(!empty($datediff))
		{
			foreach($datediff as $datediffs)
			{
				$days = $datediffs['days'];
				if($days == 0)
				{
					$one_day_service = $datediffs['count'];
				}
				if($days == 1)
				{
					$two_day_service = $datediffs['count'];
				}
				if($days>1)
				{
					$more_service += $datediffs['count'];
				}
			}
		}
		
		$chart_service = array();
		$chart_service[] = array('Task', 'Hours per Day');
		$chart_service[] = array('Same Day Closed', (int)$one_day_service);
		$chart_service[] = array('Next Day Closed', (int)$two_day_service);
		$chart_service[] = array('Closing After 48 hours', (int)$more_service);
		$piechart_service = json_encode($chart_service);
		 $this->set('charts',$piechart_service);
		
		// Employee Count
        $get_employee_count=$user_table->find()->where(array('role'=>'employee'))->count();
        $this->set('employee_count',$get_employee_count);
        
        // Client Client
        $get_client_count=$user_table->find()->where(array('role'=>'client'))->count();
        $this->set('client_count',$get_client_count);
        
        // Total AMC
        $get_amc_count=$amc_table->find()->count();
        $this->set('amc_count',$get_amc_count);
        
        //Total Product
        $get_product_count=$product_table->find()->count();
        $this->set('product_count',$get_product_count);
        
        //Product Complaint
        $get_complaint_count=$complaint_table->find()->count();
        $this->set('complaint_count',$get_complaint_count);
       
	   // close Complaint
        $get_close_complaint=$complaint_table->find()->where(array('status'=>0))->count();
		$this->set('closed_complaint',$get_close_complaint);
		
		// close Complaint
        $get_progress_complaint=$complaint_table->find()->where(array('status'=>2))->count();
		$this->set('progreess_complaint',$get_progress_complaint);
	   
        //Product Service
        $get_service_count=$service_table->find()->count();
        $this->set('service_count',$get_service_count);
        
        
         // calender data Count
        $get_employee_count=$tbl_manage_service->find()->toArray();
        $this->set('calenderdata',$get_employee_count);
        
       
        
        // Open AMC Services
        
        $get_open_amc_service=$amc_table->find()->where(array('status'=>1))->count();
        $this->set('open_amc_service_count',$get_open_amc_service);
        
        //Progress AMC Service
        $get_progress_amc_service=$amc_table->find()->where(array('status'=>2))->count();
        $this->set('progress_amc_service_count',$get_progress_amc_service);
        
        // Open Service
        
        $get_open_service=$service_table->find()->where(array('status'=>1))->count();
        $this->set('open_service',$get_open_service);
        
         $get_pending_service=$service_table->find()->where(array('status'=>2))->count();
        $this->set('pending_service',$get_pending_service);

          $get_closed_service=$service_table->find()->where(array('status'=>0))->count();
        $this->set('closed_services',$get_closed_service);
		
        /*Load employee Data*/
			$load_employee_data=$user_table->find()->where(array('role'=>'employee'));
			$this->set('employee_info',$load_employee_data);
        
        // Open Complaint
        $get_open_compaint=$complaint_table->find()->where(array('status'=>1))->count();
        $this->set('open_complaint',$get_open_compaint);
        
        //Daily Complaint
        
        $get_daily_complaint=$complaint_table->find('all', array('limit' => 5))->order(array('complaint_id'=>'DESC'))->toArray();
        if(count($get_daily_complaint) > 0){
             $this->set('complaint_data',$get_daily_complaint); 
        }
		
		//amc data
        
        $amcrecords=$tbl_amc->find('all', array('limit' => 5))->order(array('amc_id'=>'DESC'))->toArray();
        if(count($amcrecords) > 0){
             $this->set('amclist',$amcrecords); 
        }
       
	   $thismonthservice = $tbl_manage_service->find('all',array('conditions'=> array('DATE_FORMAT(tbl_manage_service.service_date,"%m") = "'.date("m").'"','DATE_FORMAT(tbl_manage_service.service_date,"%y") = "'.date("y").'"'),'limit'=>10))->toArray();
		$this->set('thismonthservice',$thismonthservice);
	   
	   
        $get_amc=$amc_table->find()->where(array('status'=>2))->order(array('amc_id'=>'DESC'))->toArray();
        
        if(count($get_amc)>0){
            
            $get_new_array=array();
            
            
            foreach($get_amc as $remainder_records){
                 $StartDate=date($this->AMCfunction->getDateFormat());
                 $EndDate=date($this->AMCfunction->getDateFormat(),strtotime($remainder_records['end_date']));
                
                $get_new_array[]=array(
                                      'amc_no'=>$remainder_records['amc_no'],
                                      'reminder'=>$this->Get_Date_Difference($StartDate,$EndDate),
                                      'customer_id'=>$remainder_records['customer_id']
                );
                
                
               
                
            }
          
            
            
          $this->set('remainder_amc',$get_new_array);
            
       
            
        }
        
        
       

  
 
//call the function from where you need
// echo  $this->Get_Date_Difference($StartDate,$EndDate);
 
// you will get result (1 Years 9 Month 14 Days) 
          
	}
    
    public function Get_Date_Difference($start_date, $end_date)
      {
        $string_date="";
        $diff = abs(strtotime($end_date) - strtotime($start_date));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
       // $years.' Years '.$months.' Month '.$days.' Days';
        
        if($years != 0){
            $string_date.=$years." Years ";
        }
        if($months != 0){
            $string_date.=$months." Months ";
        }
        if($days != 0){
            $string_date.=$days." Days ";
        }
        
        return $string_date;
        
        
     }
}

?>