<?php
namespace App\View\Helper;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper;
use Cake\Datasource\ConnectionManager;
	
class AmcHelper extends Helper{
	
		public function getdatafromcategory($status_id){
		$category_master_table = TableRegistry::get('category_master');
		
		$get_count=$category_master_table->find()->where(array('cat_id'=>$status_id))->count();
		
		//$view_data =$ware->get($wareid)->toArray();
		//$waredata = $view_data['title'];
		if($get_count > 0){
		     $category_status_data =$category_master_table->get($status_id);
		    return $category_status_data['title'];
		}else{
			return '--';
		}
			
		}
		public function getDateFormat()
	{
		$tble_setting =TableRegistry::get('tble_setting');
			$tbl_reocrd = $tble_setting->find()->first();
			$code = $tbl_reocrd['dateformate'];
			return $code;
	}
		public function getSupplierName($product_id){
		$suppliertable = TableRegistry::get('tbl_supplier');
		
		$get_count=$suppliertable->find()->where(array('id'=>$product_id))->first();
		
		if(!empty($get_count))
		{
			return $get_count['first_name'].' '.$get_count['last_name'];
		}else
		{
			return '-';
		}
		}
		
		public function Getallsaledata($id){
			$table_history =TableRegistry::get('tbl_sales_history');
			$history_record=$table_history->find()->where(['sales_id'=>$id])->toArray();
			return $history_record;
			
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
		public function gettotalexpenses($id){
			$tbl_expenses_history =TableRegistry::get('tbl_expenses_history');
			$history_record=$tbl_expenses_history->find()->where(['tbl_expenses_id'=>$id])->toArray();
			$total = 0;
			if(!empty($history_record))
			{
				foreach($history_record as $history_records)
				{
					$total += $history_records['expense_amount'];
				}
			}
			return $total;
			
		}
		
		public function gettotalincome($id){
			$tbl_expenses_history =TableRegistry::get('tbl_income_history');
			$history_record=$tbl_expenses_history->find()->where(['tbl_income_id'=>$id])->toArray();
			$total = 0;
			if(!empty($history_record))
			{
				foreach($history_record as $history_records)
				{
					$total += $history_records['income_amount'];
				}
			}
			return $total;
			
		}
		public function getCountProduct($id){
			$tbl_quotation =TableRegistry::get('tbl_quotation_history');
			$countquotation=$tbl_quotation->find()->where(['item_name'=>$id])->count();
			$tbl_purchase =TableRegistry::get('tbl_purchase_history');
			$countpurchase = $tbl_purchase->find()->where(['item_name'=>$id])->count();
			$tbl_complaint =TableRegistry::get('tbl_complaint');
			$countcomplaint = $tbl_complaint->find()->where(['product_id'=>$id])->count();
			$tbl_sales =TableRegistry::get('tbl_sales_history');
			$countsales = $tbl_sales->find()->where(['item_name'=>$id])->count();
			
			if($countquotation>0)
			{
				return 1;
			}elseif($countpurchase>0)
			{
				return 1;
			}elseif($countcomplaint>0)
			{
				return 1;
			}elseif($countsales > 0)
			{
				return 1;
			}else
			{
				return 0;
			}
			
		}
		public function getCountclient($id){
			$tbl_quotation =TableRegistry::get('tbl_quotation');
			$countquotation=$tbl_quotation->find()->where(['customer_id'=>$id])->count();
			
			$tbl_complaint =TableRegistry::get('tbl_complaint');
			$countcomplaint = $tbl_complaint->find()->where(['customer_id'=>$id])->count();
			$tbl_sales =TableRegistry::get('tbl_sales');
			$countsales = $tbl_sales->find()->where(['customer_id'=>$id])->count();
			
			if($countquotation>0)
			{
				return 1;
			}elseif($countcomplaint>0)
			{
				return 1;
			}elseif($countsales > 0)
			{
				return 1;
			}else
			{
				return 0;
			}
			
		}
		public function getCountemployee($id){
			
			$tbl_complaint =TableRegistry::get('tbl_complaint');
			$countcomplaint = $tbl_complaint->find()->where(['assign_to'=>$id])->count();
			
			
			if($countcomplaint>0)
			{
				return 1;
			}else
			{
				return 0;
			}
			
		}
		public function getnextService($id){
			
			$tbl_manage_service =TableRegistry::get('tbl_manage_service');
			$count = $tbl_manage_service->find()->where(['sales_id'=>$id,'type'=>1])->count();
			
			if($count)
			{
				$conn = ConnectionManager::get('default');
				$installationdevice = $conn->execute('SELECT service_date FROM `tbl_manage_service` WHERE sales_id="'.$id.'" AND service_date>now() LIMIT 1')->fetchAll('assoc');
				
				if(isset($installationdevice[0]['service_date']))
				{
					$date = $installationdevice[0]['service_date'];
					$date = date($this->getDateFormat(),strtotime($date));
				}else
				{
					$date = "No Services";
				}
				
				return $date;
			}else
			{
				echo 'No Services';
			}
		}
		public function getupcomeingService($id){
			
			$tbl_manage_service =TableRegistry::get('tbl_manage_service');
			$count = $tbl_manage_service->find()->where(['sales_id'=>$id,'type'=>1])->count();
			
			if($count)
			{
				$conn = ConnectionManager::get('default');
				$installationdevice = $conn->execute('SELECT service_date FROM `tbl_manage_service` WHERE sales_id="'.$id.'" AND service_date>now() LIMIT 1 OFFSET 1')->fetchAll('assoc');
				if(!empty($installationdevice)){
					$date = $installationdevice[0]['service_date'];
					return date($this->getDateFormat(),strtotime($date));
				}else
				{
					return 'No Services';
				}
			}else
			{
				return 'No Services';
			}	
			
		}
		public function Getallquotationdata($id){
			$tbl_quotation_history =TableRegistry::get('tbl_quotation_history');
			$history_record=$tbl_quotation_history->find()->where(['quotation_id'=>$id])->toArray();
			return $history_record;
			
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
		public function GetsupplierNameFrompurchase($purchaseid){
		$suppliertable = TableRegistry::get('tbl_purchase');
		
		$getpurchasedetail=$suppliertable->find()->where(array('id'=>$product_id))->first();
		$supplier = $getpurchasedetail['supplier_id'];
		$suppliertable = TableRegistry::get('tbl_supplier');
		$suppliername  =$suppliertable->find()->where(array('id'=>$suppliertable))->first();
		if(!empty($suppliername))
		{
			return $suppliername['first_name'].' '.$suppliername['last_name'];
		}else
		{
			return '-';
		}
		}
		public function getproductName($product_id){
		$tbl_product = TableRegistry::get('tbl_product');
		
		$getproduct=$tbl_product->find()->where(array('product_id'=>$product_id))->first();
		
		if(!empty($getproduct))
		{
			return $getproduct['item_name'];
		}else
		{
			return 'Undefined';
		}
		
		
		
		}
		public function getproductPrice($product_id){
		$tbl_product = TableRegistry::get('tbl_product');
		
		$getproduct=$tbl_product->find()->where(array('product_id'=>$product_id))->first();
		
		if(!empty($getproduct))
		{
			return $getproduct['price'];
		}
		
		
		
		}
	
	
	
	
		public function GetSettingData(){
			$table_setting=TableRegistry::get('tble_setting');
			$result=$table_setting->find()->first()->toArray();
			return $result;
		}
		public function getimageofproduct($product_id){
			
			$tbl_product = TableRegistry::get('tbl_product');
			$productdetail = $tbl_product->find()->where(array('product_id'=>$product_id))->first();
			
			if(!empty($productdetail))
			{
				return $productdetail['image'];
			}
		}
		
		public function getcompany(){
			$table_company=TableRegistry::get('tbl_company');
			$result=$table_company->find();
			return $result;
		}
		public function GetUserFullname($id){
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
		}
		
		
		public function get_Brand_name($brand_id)
	{
		if(!empty($brand_id)){
		$brand = TableRegistry::get('category_master');
		$view_data =$brand->get($brand_id)->toArray();
		$brandtype = $view_data['title'];
		
		
		return $brandtype;
		}else
		{
			return 'undefined';
		}
	}
	public function get_Warehouse_name($wareid)
	{
		if(!empty($wareid)){
		$ware = TableRegistry::get('category_master');
		$view_data =$ware->get($wareid)->toArray();
		$waredata = $view_data['title'];
		
		
		return $waredata;
		}else
		{
			return 'undefined';
		}
	}
	
	
	public function get_Unit_name($unit_id)
	{
		if(!empty($unit_id)){
		$unit = TableRegistry::get('category_master');
		$view_data =$unit->get($unit_id)->toArray();
		$unittype = $view_data['title'];
		
		
		return $unittype;
		}else
		{
			return 'undefined';
		}
	}
	
		public function findstatus($role,$menu){
			
			$user_table=TableRegistry::get('tbl_accessright');
			$user_name=$user_table->find()->where(['menu_name'=>$menu])->hydrate(false)->toArray();
			
			if($role == 'admin')
			{
				$status = 1;
			}else if($role == 'employee')
			{
				$status = $user_name[0]['employee'];
			}else if($role == 'client')
			{
				$status = (isset($user_name[0]['client']))?$user_name[0]['client']:0;
			}
			return $status;
			
	
		}
		
		public function getuser_name($id){
			
		
			$user_table=TableRegistry::get('tbl_user');
			
			$get_user_count=$user_table->find()->where(array('user_id'=>$id))->count();
			
		if($get_user_count > 0){
			
			$user_name=$user_table->get($id);
			$name=$user_name['first_name'].' '.$user_name['last_name'];
			
			return $name;
			
		}else{
			return 'Invalid';
		}
			
			
		}
		public function getusernamefromsale($id){
			
		
			$tbl_sales=TableRegistry::get('tbl_sales');
			$getuserdata = $tbl_sales->find()->where(array('sales_id'=>$id))->first();
			if(!empty($getuserdata)){
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
		}else
		{
			return 'Invalid';
		}			
			
		}
		public function getproductnamefromsale($id){
			
		
			$tbl_sales_history=TableRegistry::get('tbl_sales_history');
			$usersalehistory = $tbl_sales_history->find()->where(array('sales_id'=>$id))->first();
			$productid = $usersalehistory['item_name'];
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


		public function getwarranty($id){


			$get_warranty=TableRegistry::get('tbl_warranty'); 

			$get_record_data=$get_warranty->get($id);

	
				$warr_string="";
				if($get_record_data['years'] != 0){
					$warr_string.=$get_record_data['years'].__(' Years')." ";
				}
				if($get_record_data['months'] != 0){
					$warr_string.=$get_record_data['months'].__(' Months')." ";
				}
				 if($get_record_data['days'] != 0){
					$warr_string.=$get_record_data['days'].__(' Days')." ";
				}


			return $warr_string;
		
				
		}
		
		public function get_supplier_international_detail($supplier_id,$code_id)
		{
			$tbl = TableRegistry::get('supplier_international_detail');
			$row = $tbl->find()->where(['code_id'=>$code_id,'supplier_id'=>$supplier_id])->first();
			if(!empty($row))
			{
				return $row['detail'];
			}
			else{
				return '';
			}
		}

	

}