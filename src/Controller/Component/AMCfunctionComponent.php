<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use  Cake\Utility\Xml;
use Cake\View\Helper\FlashHelper;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;

class AMCfunctionComponent extends Component
{
	/* Generate unique id code*/
	public function generatePIN($digits = 4)
	{
		$i = 0; //counter
		$pin = ""; //our default pin is blank.
		while($i < $digits){
			//generate a random number between 0 and 9.
			$pin .= mt_rand(0, 9);
			$i++;
		}
		return $pin;
	}
	public function getDateFormat()
	{
		$tble_setting =TableRegistry::get('tble_setting');
			$tbl_reocrd = $tble_setting->find()->first();
			$code = $tbl_reocrd['dateformate'];
			return $code;
	}
	public function getstockornot($productid , $quantity)
	{
		$tbl_stoke = TableRegistry::get('tbl_stoke');
		$total_stockrecord = $tbl_stoke->find()->where(['product_id'=>$productid])->first();
		$total_stock = $total_stockrecord['number_of_stoke'];
		
		
		$tbl_sales_history = TableRegistry::get('tbl_sales_history');
		$conn = ConnectionManager::get('default');
		$sum = $conn->execute('SELECT SUM(qty) as sum FROM tbl_sales_history WHERE item_name='.$productid)->fetchAll('assoc');	
		$saleproductsum = $sum[0]['sum'];
		$remainstock = $total_stock - $saleproductsum;
		$mystock = $remainstock - $quantity;
		if($mystock < 0)
		{
			return 1;
		}else
		{
			return 0;
		}
		
	}
	
	public function getCurrencyCode(){
			$tble_setting =TableRegistry::get('tble_setting');
			$tbl_reocrd = $tble_setting->find()->first();
			$code = $tbl_reocrd['countries'];
			$currency_symbols = array(
	'AE' => '&#1583;.&#1573;', // ?
	'AF' => '&#65;&#102;',
	'AL' => '&#76;&#101;&#107;',
	'AM' => '',
	'AN' => '&#402;',
	'AO' => '&#75;&#122;', // ?
	'AR' => '&#36;',
	'AU' => '&#36;',
	'AW' => '&#402;',
	'AZ' => '&#1084;&#1072;&#1085;',
	'BA' => '&#75;&#77;',
	'BB' => '&#36;',
	'BD' => '&#2547;', // ?
	'BG' => '&#1083;&#1074;',
	'BH' => '.&#1583;.&#1576;', // ?
	'BI' => '&#70;&#66;&#117;', // ?
	'BM' => '&#36;',
	'BN' => '&#36;',
	'BO' => '&#36;&#98;',
	'BR' => '&#82;&#36;',
	'BS' => '&#36;',
	'BT' => '&#78;&#117;&#46;', // ?
	'BW' => '&#80;',
	'BY' => '&#112;&#46;',
	'BZ' => '&#66;&#90;&#36;',
	'CA' => '&#36;',
	'CD' => '&#70;&#67;',
	'CH' => '&#67;&#72;&#70;',
	'CL' => '', // ?
	'CL' => '&#36;',
	'CN' => '&#165;',
	'CO' => '&#36;',
	'CR' => '&#8353;',
	'CU' => '&#8396;',
	'CV' => '&#36;', // ?
	'CZ' => '&#75;&#269;',
	'DJ' => '&#70;&#100;&#106;', // ?
	'DK' => '&#107;&#114;',
	'DO' => '&#82;&#68;&#36;',
	'DZ' => '&#1583;&#1580;', // ?
	'EG' => '&#163;',
	'ET' => '&#66;&#114;',
	'EU' => '&#8364;',
	'FJ' => '&#36;',
	'FK' => '&#163;',
	'GB' => '&#163;',
	'GE' => '&#4314;', // ?
	'GH' => '&#162;',
	'GI' => '&#163;',
	'GM' => '&#68;', // ?
	'GN' => '&#70;&#71;', // ?
	'GT' => '&#81;',
	'GY' => '&#36;',
	'HK' => '&#36;',
	'HN' => '&#76;',
	'HR' => '&#107;&#110;',
	'HT' => '&#71;', // ?
	'HU' => '&#70;&#116;',
	'ID' => '&#82;&#112;',
	'IL' => '&#8362;',
	'IN' => '&#8377;',
	'IQ' => '&#1593;.&#1583;', // ?
	'IR' => '&#65020;',
	'IS' => '&#107;&#114;',
	'JE' => '&#163;',
	'JM' => '&#74;&#36;',
	'JO' => '&#74;&#68;', // ?
	'JP' => '&#165;',
	'KE' => '&#75;&#83;&#104;', // ?
	'KG' => '&#1083;&#1074;',
	'KH' => '&#6107;',
	'KM' => '&#67;&#70;', // ?
	'KP' => '&#8361;',
	'KR' => '&#8361;',
	'KW' => '&#1583;.&#1603;', // ?
	'KY' => '&#36;',
	'KZ' => '&#1083;&#1074;',
	'LA' => '&#8365;',
	'LB' => '&#163;',
	'LK' => '&#8360;',
	'LR' => '&#36;',
	'LS' => '&#76;', // ?
	'LT' => '&#76;&#116;',
	'LV' => '&#76;&#115;',
	'LY' => '&#1604;.&#1583;', // ?
	'MA' => '&#1583;.&#1605;.', //?
	'MD' => '&#76;',
	'MG' => '&#65;&#114;', // ?
	'MK' => '&#1076;&#1077;&#1085;',
	'MM' => '&#75;',
	'MN' => '&#8366;',
	'MO' => '&#77;&#79;&#80;&#36;', // ?
	'MR' => '&#85;&#77;', // ?
	'MU' => '&#8360;', // ?
	'MV' => '.&#1923;', // ?
	'MW' => '&#77;&#75;',
	'MX' => '&#36;',
	'MY' => '&#82;&#77;',
	'MZ' => '&#77;&#84;',
	'NA' => '&#36;',
	'NG' => '&#8358;',
	'NI' => '&#67;&#36;',
	'NO' => '&#107;&#114;',
	'NP' => '&#8360;',
	'NZ' => '&#36;',
	'OM' => '&#65020;',
	'PA' => '&#66;&#47;&#46;',
	'PE' => '&#83;&#47;&#46;',
	'PG' => '&#75;', // ?
	'PH' => '&#8369;',
	'PK' => '&#8360;',
	'PL' => '&#122;&#322;',
	'PY' => '&#71;&#115;',
	'QA' => '&#65020;',
	'RO' => '&#108;&#101;&#105;',
	'RS' => '&#1044;&#1080;&#1085;&#46;',
	'RU' => '&#1088;&#1091;&#1073;',
	'RW' => '&#1585;.&#1587;',
	'SA' => '&#65020;',
	'SB' => '&#36;',
	'SC' => '&#8360;',
	'SD' => '&#163;', // ?
	'SE' => '&#107;&#114;',
	'SG' => '&#36;',
	'SH' => '&#163;',
	'SL' => '&#76;&#101;', // ?
	'SO' => '&#83;',
	'SR' => '&#36;',
	'ST' => '&#68;&#98;', // ?
	'SV' => '&#36;',
	'SY' => '&#163;',
	'SZ' => '&#76;', // ?
	'TH' => '&#3647;',
	'TJ' => '&#84;&#74;&#83;', // ? TJS (guess)
	'TM' => '&#109;',
	'TN' => '&#1583;.&#1578;',
	'TO' => '&#84;&#36;',
	'TR' => '&#8356;', // New Turkey Lira (old symbol used)
	'TT' => '&#36;',
	'TW' => '&#78;&#84;&#36;',
	'TZ' => '',
	'UA' => '&#8372;',
	'UG' => '&#85;&#83;&#104;',
	'US' => '&#36;',
	'UY' => '&#36;&#85;',
	'UZ' => '&#1083;&#1074;',
	'VE' => '&#66;&#115;',
	'VN' => '&#8363;',
	'VU' => '&#86;&#84;',
	'WS' => '&#87;&#83;&#36;',
	'XA' => '&#70;&#67;&#70;&#65;',
	'XC' => '&#36;',
	'XD' => '',
	'XO' => '',
	'XP' => '&#70;',
	'YE' => '&#65020;',
	'ZA' => '&#82;',
	'ZM' => '&#90;&#75;', // ?
	'ZW' => '&#90;&#36;',
);

	$currency = $currency_symbols[$code];
	return $currency;
		}
	public function getusernamefromsale($id){
			
		
			$tbl_sales=TableRegistry::get('tbl_sales');
			$getuserdata = $tbl_sales->find()->where(array('sales_id'=>$id))->first();
			$userid = $getuserdata->customer_id;
			$user_table=TableRegistry::get('tbl_user');
			
			$get_user_count=$user_table->find()->where(array('user_id'=>$userid))->count();
			
		if($get_user_count > 0){
			
			$user_name=$user_table->get($userid);
			$name=$user_name['first_name'].' '.$user_name['last_name'];
			
			return $name;
			
		}else{
			return 'Invalid';
		}
			
			
		}
		public function getproductnamefromsale($id){
			
		
			$tbl_sales_history=TableRegistry::get('tbl_sales_history');
			$usersalehistory = $tbl_sales_history->find()->where(array('sales_id'=>$id))->first();
			$productid = $usersalehistory->item_name;
			$table_product = TableRegistry::get('tbl_product');
			
			$get_count_product=$table_product->find()->where(array('product_id'=>$productid))->count();
			if($get_count_product > 0){
				
				$productdetails = $table_product->get($productid)->toArray();
		        	
					
		        	$name = $productdetails['item_name'];
				    return $name;
			   
			}else{
			    return "Undefined";
	
			}
			
		}
		public function getusercompanyname($id){
			if(!empty($id)){
		$user = TableRegistry::get('tbl_user');
		$get_count=$user->find()->where(array('user_id'=>$id))->first();
		
		if(!empty($get_count))
		{
			return $get_count['company_name'];
		}else
		{
			return '-';
		}
			}else
			{
				return '-';
			}
		}
		public function getcompnysetupname(){
			
		$tble_setting = TableRegistry::get('tble_setting');
		$get_count=$tble_setting->find()->first();
		
		if(!empty($get_count))
		{
			return $get_count['title_name'];
		}else
		{
			return '-';
		}
			
		}
		public function getAdminname(){
			
		$tbl_user = TableRegistry::get('tbl_user');
		$get_count=$tbl_user->find()->where(array('role'=>'admin'))->first();
		
		if(!empty($get_count))
		{
			return $get_count['first_name'].' '.$get_count['last_name'];
		}else
		{
			return '-';
		}
			
		}
		public function getAdminemail(){
			
		$tbl_user = TableRegistry::get('tbl_user');
		$get_count=$tbl_user->find()->where(array('role'=>'admin'))->first();
		
		if(!empty($get_count))
		{
			return $get_count['email'];
		}else
		{
			return '-';
		}
			
		}
		public function getAdminaddress(){
			
		$tbl_user = TableRegistry::get('tbl_user');
		$get_count=$tbl_user->find()->where(array('role'=>'admin'))->first();
		
		if(!empty($get_count))
		{
			return $get_count['address'];
		}else
		{
			return '-';
		}
			
		}
public function getEmployeerName($id){
			if(!empty($id)){
		$user = TableRegistry::get('tbl_user');
		$get_count=$user->find()->where(array('user_id'=>$id))->first();
		
		if(!empty($get_count))
		{
			return $get_count['first_name'].' '.$get_count['last_name'];
		}else
		{
			return '-';
		}
			}else
			{
				return '-';
			}
		}
		public function getEmployeerEmail($id){
			if(!empty($id)){
		$user = TableRegistry::get('tbl_user');
		$get_count=$user->find()->where(array('user_id'=>$id))->first();
		
		if(!empty($get_count))
		{
			return $get_count['email'];
			}
			}
		}
	public function sendAlertEmail()
	{
		$today_date = date("d");
		$mail_notification_send_Status = TableRegistry::get('tbl_mail_notification');
		$mailformate_send_Status = $mail_notification_send_Status->find()->where(['notification_for'=>'service_list_monthly_admin'])->first();
		$send_stauts = $mailformate_send_Status['send_status'];	
		$notification_id = $mailformate_send_Status['id'];	
		if($send_stauts == 1 && $today_date == 27)
		{
			$mailsendstatus['send_status']=0;
				
				
				$tbl_mail_noti = TableRegistry::get('tbl_mail_notification');
                $tbl_complaint_id = $tbl_mail_noti->get($notification_id);
				 $update = $tbl_mail_noti->patchEntity($tbl_complaint_id, $mailsendstatus);
                 $tbl_mail_noti->save($update); 
		}
		if($send_stauts == 0 && $today_date == 1)
		{
						//Monthly service list 
						
						$tbl_manage_service=TableRegistry::get('tbl_manage_service');
						$thismonthservice = $tbl_manage_service->find('all',array('conditions'=> array('DATE_FORMAT(tbl_manage_service.service_date,"%m") = "'.date("m").'"','DATE_FORMAT(tbl_manage_service.service_date,"%y") = "'.date("y").'"')))->toArray();
						if(!empty($thismonthservice))
						{
							$message = '<br/><br/><table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
		
							<thead>
											<tr>
											 <th>Customer Name</th>
											 <th>Product Name</th>
											 <th>Date</th>
											<th>Services</th>
											<th>Assign To</th>
											<th>Employee Status</th>
											
											 </tr>
								</thead>
								<tbody>';
								if(isset($thismonthservice)){
									foreach($thismonthservice as $thismonthservices){
										$message .='<tr>
										<td>'.$this->getusernamefromsale($thismonthservices['sales_id']).'</td>
										<td>'.$this->getproductnamefromsale($thismonthservices['sales_id']).'</td>
                           				<td>'.date($this->getDateFormat(),strtotime($thismonthservices['service_date'])).'</td> 
                           				<td>'.$thismonthservices['title'].'</td>
										<td>'.$this->getEmployeerName($thismonthservices['assign_to']).'</td> 
                           				<td>'; if($thismonthservices['done_status'] == 0 ){ $message .='Not Done'; }elseif($thismonthservices['done_status'] == 1 ){ $message .='Done'; } $message .='</td> 
                    										
										</tr>';
									}
								}
								$message .='</tbody>
							</table><br/><br/>';
						}else
						{
							$message ='There are no Service for this Month';
						}
						
						
						//send mail
						$tble_setting = TableRegistry::get('tble_setting');
						$mailformate = $tble_setting->find()->first();
						$sendmail = $mailformate['mail_send'];
						$title_name = $mailformate['title_name'];
						$mail_notification = TableRegistry::get('tbl_mail_notification');
						$mailformate = $mail_notification->find()->where(['notification_for'=>'service_list_monthly_admin'])->first();
						$mailformat = $mailformate['notification_text'];
						$admintable = TableRegistry::get('tbl_user');
						$admindata = $admintable->find()->where(['role'=>'admin'])->first();
						$adminfullname = $admindata['first_name'].' '.$admindata['last_name'];
						$adminemail = $admindata['email'];
						$serch = array('{ admin }','{ systemname }','{ service_list }');
						$replace = array($adminfullname,$title_name,$message);
						$message_content = str_replace($serch, $replace, $mailformat);
						$subject = $mailformate['subject'];
						$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8";
						$headers .= 'From:'. $mailformate['send_from'] . "\r\n";
						
						if($sendmail == 1)
						{
							$remote_add = $_SERVER['REMOTE_ADDR'];
							$server_add = $_SERVER['SERVER_ADDR'];
							if($remote_add != $server_add)
							{
								mail($adminemail,$subject,$message_content,$headers);
							}else{
								$to = $adminemail;
								$email = new Email('default');
								$email->from('das@dasinfomedia.com')
								->to($to)
								->subject($subject)
								->send($message_content);
							}
						}
						$mailsendstatus['send_status']=1;
				
				
				$tbl_mail_noti = TableRegistry::get('tbl_mail_notification');
                $tbl_complaint_id = $tbl_mail_noti->get($notification_id);
				 $update = $tbl_mail_noti->patchEntity($tbl_complaint_id, $mailsendstatus);
                 $tbl_mail_noti->save($update); 
		}
		
		$dateofaftertwoday = date($this->getDateFormat(),strtotime(' + 2 day'));
		$tbl_manage_service_beforeday = TableRegistry::get('tbl_manage_service');
		$thismonthservice = $tbl_manage_service_beforeday->find('all',array('conditions'=> array('DATE_FORMAT(tbl_manage_service.service_date,"%m") = "'.date("m").'"','DATE_FORMAT(tbl_manage_service.service_date,"%y") = "'.date("y").'"','DATE_FORMAT(tbl_manage_service.service_date,"%d") = "'.date("d",strtotime(' + 2 day')).'"')))->toArray();
		
		if(!empty($thismonthservice))
		{
			foreach($thismonthservice as $thismonthservices)
			{
				$customerid = $thismonthservices['customer_id'];
				$servicetitle = $thismonthservices['title'];
				$service_date = $thismonthservices['service_date'];
				$customername = $this->getEmployeerName($customerid);
				$customeremail = $this->getEmployeerEmail($customerid);
				
				// change date
				$tbl_user = TableRegistry::get('tbl_user');
				$mailformate_before_day = $tbl_user->find()->where(['user_id'=>$customerid])->first();
				$userdate = $mailformate_before_day['last_send_mail_Date'];
				$checkdate = date($this->getDateFormat(),strtotime($userdate));
				$todaydate = date('y-m-d');
				
				
				if($todaydate != $checkdate)
				{
					
					$acont['last_send_mail_Date']= date('y-m-d');
					$acont['middle_name'] = 'new';
					$userdata=$tbl_user->get($customerid);
					$dataaccount=$tbl_user->patchEntity($userdata, $acont);
					$tbl_user->save($dataaccount);	
					//sending mail to customer
					$tble_setting = TableRegistry::get('tble_setting');
						$mailformate = $tble_setting->find()->first();
						$sendmail = $mailformate['mail_send'];
						$title_name = $mailformate['title_name'];
					$mail_notification_before_day = TableRegistry::get('tbl_mail_notification');
					$mailformate_before_day = $mail_notification_before_day->find()->where(['notification_for'=>'service_before_some_day'])->first();
					$mailformat_before = $mailformate_before_day['notification_text'];
					$serch = array('{ username }','{ systemname }','{ service_title }','{ service_date }');
					$replace = array($customername,$title_name,$servicetitle,$service_date);
					$message_content = str_replace($serch, $replace, $mailformat_before);
					$subject = $mailformate_before_day['subject'];
					$headers = "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8";
					$headers .= 'From:'. $mailformate_before_day['send_from'] . "\r\n";
					//send mail
						
						if($sendmail == 1)
						{
							$remote_add = $_SERVER['REMOTE_ADDR'];
							$server_add = $_SERVER['SERVER_ADDR'];
							if($remote_add != $server_add)
							{
								mail($customeremail,$subject,$message_content,$headers);
							}else{
								$to = $customeremail;
								$email = new Email('default');
								$email->from('das@dasinfomedia.com')
								->to($to)
								->subject($subject)
								->send($message_content);
							}
						}
				}
						
			}
		}
		
		$employee_task_list = TableRegistry::get('tbl_user');
		$employees = $employee_task_list->find()->where(['role'=>'employee'])->toArray();
		
		if(!empty($employees))
		{
			foreach($employees as $employeess)
			{
				$employeeid = $employeess['user_id'];
				$customername = $this->getEmployeerName($employeeid);
				$customeremail = $this->getEmployeerEmail($employeeid);
				
				//check date of mail
				$tbl_user = TableRegistry::get('tbl_user');
				$mailformate_before_day = $tbl_user->find()->where(['user_id'=>$employeeid])->first();
				$userdate = $mailformate_before_day['last_send_mail_Date'];
				$checkdate = date($this->getDateFormat(),strtotime($userdate));
				$todaydate = date($this->getDateFormat());
				
				if($todaydate != $checkdate)
				{
					
					$acont['last_send_mail_Date']= date('y-m-d');
					$acont['middle_name'] = 'new';
					$userdata=$tbl_user->get($employeeid);
					$dataaccount=$tbl_user->patchEntity($userdata, $acont);
					$tbl_user->save($dataaccount);
				//service of this employee
				$thismonthservice = $tbl_manage_service_beforeday->find('all',array('conditions'=> array('tbl_manage_service.assign_to'=>$employeeid,'DATE_FORMAT(tbl_manage_service.service_date,"%m") = "'.date("m").'"','DATE_FORMAT(tbl_manage_service.service_date,"%y") = "'.date("y").'"','DATE_FORMAT(tbl_manage_service.service_date,"%d") = "'.date("d").'"')))->toArray();
				$message = '';
				if(!empty($thismonthservice))
				{
							$message .= '<br/><br/>Your Today Services List <br/><br/><table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
		
							<thead>
											<tr>
											 <th>Customer Name</th>
											 <th>Product Name</th>
											 <th>Date</th>
											<th>Services</th>
											<th>Assign To</th>
											<th>Employee Status</th>
											
											 </tr>
								</thead>
								<tbody>';
								if(isset($thismonthservice)){
									foreach($thismonthservice as $thismonthservices){
										$message .='<tr>
										<td>'.$this->getusernamefromsale($thismonthservices['sales_id']).'</td>
										<td>'.$this->getproductnamefromsale($thismonthservices['sales_id']).'</td>
                           				<td>'.date($this->getDateFormat(),strtotime($thismonthservices['service_date'])).'</td> 
                           				<td>'.$thismonthservices['title'].'</td>
										<td>'.$this->getEmployeerName($thismonthservices['assign_to']).'</td> 
                           				<td>'; if($thismonthservices['done_status'] == 0 ){ $message .='Not Done'; }elseif($thismonthservices['done_status'] == 1 ){ $message .='Done'; } $message .='</td> 
                    										
										</tr>';
									}
								}
								$message .='</tbody>
							</table><br/><br/>';
						}
						
						$service_date = date('y-m-d');
						//sending mail to customer
						//sending mail to customer
					$tble_setting = TableRegistry::get('tble_setting');
						$mailformate = $tble_setting->find()->first();
						$sendmail = $mailformate['mail_send'];
						$title_name = $mailformate['title_name'];
					$mail_notification_before_day = TableRegistry::get('tbl_mail_notification');
					$mailformate_before_day = $mail_notification_before_day->find()->where(['notification_for'=>'employy_tasks'])->first();
					$mailformat_before = $mailformate_before_day['notification_text'];
					$serch = array('{ employee }','{ systemname }','{ tast_list }','{ today_date }');
					$replace = array($customername,$title_name,$message,$service_date);
					$message_content = str_replace($serch, $replace, $mailformat_before);
					$subject = $mailformate_before_day['subject'];
					$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From:'. $mailformate_before_day['send_from'] . "\r\n";
					//send mail
						
						if($sendmail == 1)
						{
							$remote_add = $_SERVER['REMOTE_ADDR'];
							$server_add = $_SERVER['SERVER_ADDR'];
							if($remote_add != $server_add)
							{
								mail($customeremail,$subject,$message_content,$headers);
							}else{
								$to = $customeremail;
								$email = new Email('default');
								$email->from('das@dasinfomedia.com')
								  ->to($to)
								  ->subject($subject)
								  ->send($message_content);
							}
							
						}
				}
			}
		}			
		
		
		
	}
	public function GettaxRate($taxpercentage,$totalamount){
			$getamout = ($taxpercentage*$totalamount)/100;
			return $getamout;
			
		}
	public function generate_userid($user='C')
	{
		$random_digit = $this->generatePIN();
		return $user.date('ymd').$random_digit;
	}
	
	public function GetsupplierNameFrompurchase($purchaseid){
		
		$purchasetable = TableRegistry::get('tbl_purchase');
		
		$getpurchasedetail=$purchasetable->find()->where(['purchase_id'=>$purchaseid])->first();
		$supplier = $getpurchasedetail['supplier_id'];
		$suppliertable = TableRegistry::get('tbl_supplier');
		$suppliername  =$suppliertable->find()->where(array('id'=>$supplier))->first();
		if(!empty($suppliername))
		{
			return $suppliername['first_name'].' '.$suppliername['last_name'];
		}else
		{
			return '-';
		}
		}
		public function GetSellProduct($stokeid){
		
		$tbl_stoke = TableRegistry::get('tbl_stoke');
		$stokedetail=$tbl_stoke->find()->where(['id'=>$stokeid])->first();
		if(!empty($stokedetail))
			{
				$product_id = $stokedetail['product_id'];
				$tbl_sales_history = TableRegistry::get('tbl_sales_history');
				$selldata  =$tbl_sales_history->find()->where(array('item_name'=>$product_id))->toArray();
				$total_amount=0;
				foreach($selldata as $selldatas){
					
					$total_amount= $total_amount+$selldatas->qty;
				}
			}
			return $total_amount;
		
		}
	public function getSupplierName($id){
		$suppliertable = TableRegistry::get('tbl_supplier');
		
		$get_count=$suppliertable->find()->where(array('id'=>$id))->first();
		
		if(!empty($get_count))
		{
			return $get_count['first_name'].' '.$get_count['last_name'];
		}else
		{
			return '-';
		}
		
		
		
		}
	
	/* Image upload code */
	public function upload_image($filename,$old_image='',$image_for = 'users_images')
    {	
		
		$parts = pathinfo($_FILES[$filename]['name']);
		$file_size = $_FILES[$filename]['size'];
		
		$image_director="img/".$image_for;
			
		$full_path=WWW_ROOT.$image_director;
		
		if($file_size > 0)
		{	
		if (!file_exists($full_path)) {
			mkdir($full_path, 0777, true);
		}
		
		$imgname=$this->generate_userid('img-').time().'.'.$parts['extension'];
		$return_image = $imgname;
		$image_path=$full_path.'/'.$return_image;
		
		if($old_image !='')
		{			
			$image_array = explode('/',$old_image);			
			if (file_exists($full_path.'/'.$image_array[1])) {				
				unlink($full_path.'/'.$image_array[1]);
			}
			
		}
		
		if(move_uploaded_file($_FILES[$filename]['tmp_name'],$image_path))
		{		
			return $image_for.'/'.$return_image;		
		}
		
		}
		else
		return $old_image;		
	}
	public function get_branch_name($branch_id)
	{
		$erp_branch = TableRegistry::get('erp_branch'); 
		$branch_data = $erp_branch->find()->where(['branch_id'=>$branch_id]);
		$branch_array = array();
		foreach($branch_data as $retrive_data)
		{
			$branch_array['branch_id'] = $retrive_data['branch_id'];
			$branch_array['branch_name'] = $retrive_data['branch_name'];
		}
		return $branch_array;
	}
	public function get_branch_list($company_id)
	{
		$erp_branch = TableRegistry::get('erp_branch'); 
		$branch_data = $erp_branch->find()->where(['company_id'=>$branch_id]);
		$branch_array = array();
		foreach($branch_data as $retrive_data)
		{
			$branch_array['branch_id'] = $retrive_data['branch_id'];
			$branch_array['branch_name'] = $retrive_data['branch_name'];
		}
		return $branch_array;
	}
	public function get_category_title($cat_id)
	{
		$category_master = TableRegistry::get('category_master'); 
		$category_data = $category_master->find()->where(['cat_id'=>$cat_id]);
		$res_array = array();
		foreach($category_data as $retrive_data)
		{
			$res_array['title'] = $retrive_data['title'];
			$res_array['cat_id'] = $retrive_data['cat_id'];
		}
		return $res_array['title'];
	}
	public function add_product_stock($product_id,$product_qty,$warehouse_id)
	{
		$erp_warehouse_stock = TableRegistry::get('erp_warehouse_stock');
		$id = $this->get_stock_id($product_id,$warehouse_id);
		$product_data = $erp_warehouse_stock->get($id);
		$new_data['product_id'] = $product_id;
		$update_product_qty = $this->get_product_qty($product_id,$warehouse_id) + $product_qty;		
		$new_data['product_qty'] = $update_product_qty;
		$product_data = $erp_warehouse_stock->patchEntity($product_data,$new_data);
		$erp_warehouse_stock->save($product_data);
		
	}
	public function get_product_qty($product_id,$warehouse_id)
	{
		$erp_products = TableRegistry::get('erp_products'); 
		$product_data = $erp_products->find()->where(['product_id'=>$product_id]);
		
		$erp_warehouse_stock = TableRegistry::get('erp_warehouse_stock'); 
		
		$exists = $erp_warehouse_stock->exists(['product_id'=>$product_id,'warehouse_id'=>$warehouse_id]);
		$res_array = array();
		if($exists)
		{
			$product_data = $erp_warehouse_stock->find()->where(['product_id'=>$product_id,'warehouse_id'=>$warehouse_id]);
			foreach($product_data as $retrive_data)
		{
			$res_array['product_qty'] = $retrive_data['product_qty'];
			$res_array['product_id'] = $retrive_data['product_id'];
		}
		}
		else
			$res_array['product_qty'] = 0;
		
		return $res_array['product_qty'];
	}
	
	public function get_stock_id($product_id,$warehouse_id)
	{	
		$erp_warehouse_stock = TableRegistry::get('erp_warehouse_stock'); 
		
		$exists = $erp_warehouse_stock->exists(['product_id'=>$product_id,'warehouse_id'=>$warehouse_id]);
		$res_array = array();
		if($exists)
		{
			$product_data = $erp_warehouse_stock->find()->where(['product_id'=>$product_id,'warehouse_id'=>$warehouse_id]);
			foreach($product_data as $retrive_data)
			{
				$res_array['product_qty'] = $retrive_data['product_qty'];
				$res_array['product_id'] = $retrive_data['product_id'];
				$res_array['id'] = $retrive_data['id'];
			}
		}
		else
		{
			$warehouse_data =  $erp_warehouse_stock->newEntity();
				$warehouse_post_data['warehouse_id']=$warehouse_id;
				$warehouse_post_data['product_id']=$product_id;
				$warehouse_post_data['product_qty']=0;
				$warehouse_post_data['status']=1;
				$warehouse_post_data['created_date']=date('Y-m-d H:i:s');
				$warehouse_post_data['created_by']=1;
				$warehouse_data= $erp_warehouse_stock->patchEntity($warehouse_data,$warehouse_post_data);
				$erp_warehouse_stock->save($warehouse_data);
				$res_array['id'] = $warehouse_data->id;
			
		}		
		return $res_array['id'];
	}
	
	public function get_product_stock($product_id)
	{
		$conn = ConnectionManager::get('default');
		$result = $conn->execute('select sum(product_qty) from erp_warehouse_stock where product_id = '.$product_id);		
		$stock = 0;
		foreach($result as $retrive_data)
		{ $stock=$retrive_data[0]; }
		return $stock;
	}
	
	public function add_dispatchitem_product($dispatch_items,$parent_id)
	{
		
		$erp_dispatch_product = TableRegistry::get('erp_dispatch_product'); 
		foreach($dispatch_items['product_id'] as $key => $data)
		{
			$dispatch_data['parent_id'] =  $parent_id;
			$dispatch_data['type'] =  'dispatch';
			$dispatch_data['product_id'] =  $dispatch_items['product_id'][$key];
			$dispatch_data['quantity'] =  $dispatch_items['quantity'][$key];
			$dispatch_data['price'] =  $dispatch_items['price'][$key];
			$dispatch_data['total_price'] =  $dispatch_items['amount'][$key];
			$dispatch_data['warehouse_id'] =  $dispatch_items['warehouse_id'][$key];
			$dispatch_product_data = $erp_dispatch_product->newEntity();
			
			$dispatch_product_data=$erp_dispatch_product->patchEntity($dispatch_product_data,$dispatch_data);
			$erp_dispatch_product->save($dispatch_product_data);
			$this->deduct_stock($dispatch_data['product_id'],$dispatch_data['warehouse_id'],$dispatch_data['quantity']);			
		}
		
	}
	public function deduct_stock($product_id,$warehouse_id,$product_qty)
	{
		$erp_warehouse_stock = TableRegistry::get('erp_warehouse_stock');
		$id = $this->get_stock_id($product_id,$warehouse_id);
		$product_data = $erp_warehouse_stock->get($id);
		$new_data['product_id'] = $product_id;
		$update_product_qty = $this->get_product_qty($product_id,$warehouse_id) - $product_qty;		
		$new_data['product_qty'] = $update_product_qty;
		$product_data = $erp_warehouse_stock->patchEntity($product_data,$new_data);
		$erp_warehouse_stock->save($product_data);
	}
	public function transfer_stock($from_warehouse,$to_warehouse,$product_id,$qty)
	{
		$this->deduct_stock($product_id,$from_warehouse,$qty);		
		$this->add_product_stock($product_id,$qty,$to_warehouse);		
	}
	public function set_date($date)
	{
		return date('Y-m-d H:i:s',strtotime($date));
	}
	public function get_date($date)
	{
		return date('Y-m-d H:i:s',strtotime($date));
	}
	public function invoicepayment($invoice_id,$paid_amount,$payment_method)
	{
		echo $old_paid_amount = $this->get_paid_abount($invoice_id);
		$erp_invoice = TableRegistry::get('erp_invoice');
		$erp_invoice_history = TableRegistry::get('erp_invoice_history');
			
		$invoice_data = $erp_invoice->get($invoice_id);
		$new_data['paid_amount'] = $old_paid_amount + $paid_amount;
		$new_data = $erp_invoice->patchEntity($invoice_data,$new_data);
		$erp_invoice->save($new_data);
		$erp_invoice_field = $erp_invoice_history->newEntity();
		$history_data['invoice_id'] = $invoice_id ;
		$history_data['amount'] = $paid_amount ;
		$history_data['payment_method'] = $payment_method ;
		$history_data['created_date'] = date('Y-m-d H:i:s') ;
		$history_data['created_by'] = 1 ;
		$dispatch_product_data=$erp_invoice_history->patchEntity($erp_invoice_field,$history_data);
		$erp_invoice_history->save($dispatch_product_data);
		
	}
	public function getCategoryName($id){
		if($id>0 && $id != '')
		{
		$categories = TableRegistry::get('category_master');
		$get_count=$categories->find()->where(array('cat_id'=>$id))->first();
		if(!empty($get_count))
		{
			return $get_count['title'];
		}else
		{
			return '-';
		}
		}else
		{
			return '-';
		}
		}
	public function GetUserFullname($id){
		
			if($id != 0)
			{
				$table_user = TableRegistry::get('tbl_user');
				$userdetails = $table_user->get($id)->toArray();
				if(!empty($userdetails)){
				$name = $userdetails['first_name'];
				if(!empty($name))
				{
					return $name;
				}else
				{
					return "Undefined";
				}
				
				}else
				return "Undefined";
			}else
			{
				return "Undefined";
			}
			
		}
		public function GetItemName($id){
		
			$table_product = TableRegistry::get('tbl_product');
			
			$get_count_product=$table_product->find()->where(array('product_id'=>$id))->count();
			if($get_count_product > 0){
				
				$productdetails = $table_product->get($id)->toArray();
		        	
					
		        	$name = $productdetails['item_name'];
				    return $name;
			   
			}else{
			    return "Undefined";
	
			}
			
		}
		public function GetItemCode($id){
		
			$table_product = TableRegistry::get('tbl_product');
			
			$get_count_product=$table_product->find()->where(array('product_id'=>$id))->count();
			if($get_count_product > 0){
				
				$productdetails = $table_product->get($id)->toArray();
		        	
					
		        	$name = $productdetails['product_code'];
				    return $name;
			   
			}else{
			    return "Undefined";
	
			}
			
		}
		public function GetSettingData(){
			$table_setting=TableRegistry::get('tble_setting');
			$result=$table_setting->find()->first()->toArray();
			return $result;
		}
		
	public function get_paid_abount($invoice_id)
	{
		$erp_invoice = TableRegistry::get('erp_invoice'); 		
		$invoice_data = $erp_invoice->find()->where(['invoice_id'=>$invoice_id]);
		$res_array = array();
		foreach($invoice_data as $retrive_data)
		{
			$res_array['paid_amount'] = $retrive_data['paid_amount'];			
		}
		return $res_array['paid_amount'];
	}
	
	    /*********************************************************************
		 Purpose            : resize image.
		 Parameters         : null
		 Returns            : image
		 ***********************************************************************/
		function resizeImage($image,$width,$height,$scale) {
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		$source = imagecreatefromjpeg($image);
		imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
		imagejpeg($newImage,$image,90);
		chmod($image, 0777);
		return $image;
	}
	/*********************************************************************
		 Purpose            : get image height.
		 Parameters         : null
		 Returns            : height
		 ***********************************************************************/
	function getHeight($image) {
		$sizes = getimagesize($image);
		$height = $sizes[1];
		return $height;
	}
	/*********************************************************************
		 Purpose            : get image width.
		 Parameters         : null
		 Returns            : width
		 ***********************************************************************/
	function getWidth($image) {
		$sizes = getimagesize($image);
		$width = $sizes[0];
		return $width;
	}
}
?>