<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\Controller\Exception\SecurityException;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;

class InstallerController extends AppController
{
	// public function beforeFilter(Event $event)
    // {
        // parent::beforeFilter($event);
		// if (isset($this->request->params['admin'])) {
            // $this->Security->requireSecure();
        // }
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        //$this->Auth->allow(['index',"gymTableInstall","success","updateSys"]);
    // }
	
	public function initialize()
    {
        parent::initialize();
		$this->viewBuilder()->layout("gym_install");
		
    }
	
	
	public function index()
	{ 
		
		if (file_exists(TMP.'installed.txt')) 
		{ 
			return $this->redirect(["controller"=>"users"]);
			die;
		}
		if($this->request->is("post"))
		{	
			$file = ROOT . DS . 'config'. DS . 'app.php';       
			$content = file_get_contents($file);	
			
			$db_host = $this->request->data["db_host"];
			$db_username = $this->request->data["db_username"];
			$db_pass = $this->request->data["db_pass"];
			$db_name = $this->request->data["db_name"];
			
			$con = mysqli_connect($db_host,$db_username,$db_pass,$db_name);		
			if (mysqli_connect_errno())
			{
				echo "Failed to connect to Database : " . mysqli_connect_error();
				die;
			}
		  
			$content = str_replace(["CUST_HOST","CUST_USERNAME","CUST_PW","CUST_DB_NAME"],[$db_host,$db_username,$db_pass,$db_name],$content);
			$status = file_put_contents($file, $content);
			
			$this->gymTableInstall($db_name,$db_username,$db_host,$db_pass);
			$this->insertData($this->request->data);
		}
	}
	
	private function gymTableInstall($db_name,$db_username,$db_host,$db_pass)
    {		
		$this->viewBuilder()->layout("");
		$this->autoRender = false;	
		
		$config = [
					'className' => 'Cake\Database\Connection',
					'driver' => 'Cake\Database\Driver\Mysql',
					'persistent' => false,
					'host' => $db_host,
					'username' => $db_username,
					'password' => $db_pass,
					'database' => $db_name,
					'encoding' => 'utf8',
					'timezone' => 'UTC',
					'flags' => [],
					'cacheMetadata' => true,
					'log' => false,
					'quoteIdentifiers' => false,           
					'url' => env('DATABASE_URL', null)
				];
			
		ConnectionManager::config('install_db', $config);
		$conn = ConnectionManager::get('install_db');		
		
		$sql="CREATE TABLE `category_master` (
  `cat_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` int(11) DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
$stmt = $conn->execute($sql);
		//myguest
				$sql="CREATE TABLE `myguests` (
		  `id` int(6) UNSIGNED NOT NULL,
		  `firstname` varchar(30) NOT NULL,
		  `lastname` varchar(30) NOT NULL,
		  `email` varchar(50) DEFAULT NULL,
		  `reg_date` timestamp NULL DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		$stmt = $conn->execute($sql);
		
		//sale_account_tax
		$sql="CREATE TABLE `sale_account_tax` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `tax_name` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		$stmt = $conn->execute($sql);
		
		
		//international code 
		
		$sql="CREATE TABLE `international_code` (
  `code_id` int(11) NOT NULL,
  `code_title` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$stmt = $conn->execute($sql);
	
	// quatation account tax 
	
	$sql="CREATE TABLE `supplier_international_detail` (
  `detail_id` int(11) NOT NULL,
  `code_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$stmt = $conn->execute($sql);

	$sql="CREATE TABLE `quatation_account_tax` (
  `id` int(11) NOT NULL,
  `quation_id` int(11) NOT NULL,
  `tax_name` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
$stmt = $conn->execute($sql);
		//tble_setting
		$sql="CREATE TABLE `tble_setting` (
  `id` int(11) NOT NULL,
  `title_name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `cover_profile` varchar(255) NOT NULL,
  `countries` varchar(255) NOT NULL,
  `dateformate` varchar(255) NOT NULL DEFAULT 'd-m-y',
  `mail_send` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		$stmt = $conn->execute($sql);
		
		
		
		
		
		
		$sql="CREATE TABLE `tbl_accessright` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `employee` int(11) NOT NULL,
  `client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		$stmt = $conn->execute($sql);
		
		
		
		$sql="CREATE TABLE `tbl_account_tax_rates` (
  `id` int(11) NOT NULL,
  `acount_tax_name` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
				
		$stmt = $conn->execute($sql);
				
		$sql="CREATE TABLE `tbl_amc` (
  `amc_id` int(11) NOT NULL,
  `amc_no` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `assign_to_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `attachment` varchar(150) NOT NULL,
  `subject` text NOT NULL,
  `address` text NOT NULL,
  `is_appove` int(11) NOT NULL DEFAULT '0',
  `employee_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1";		
							
		$stmt = $conn->execute($sql);
					
		$sql="CREATE TABLE `tbl_amc_history` (
  `amc_h_id` int(11) NOT NULL,
  `amc_id` int(11) NOT NULL,
  `item_name` int(11) NOT NULL,
  `note` text NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
	$stmt = $conn->execute($sql);
			
			
		$sql="CREATE TABLE `tbl_client_history` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
				
		$stmt = $conn->execute($sql);
		
		$sql="CREATE TABLE `tbl_company` (
  `company_id` int(11) NOT NULL,
  `company_idf` varchar(50) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `alt_mobile` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
		$stmt = $conn->execute($sql);
				
		$sql="CREATE TABLE `tbl_company_detail` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `main_person` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `ifs_code` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `tin_no` varchar(255) NOT NULL,
  `cst_no` varchar(255) NOT NULL,
  `pan_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);
				
		$sql="CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_no` varchar(30) NOT NULL,
  `status` int(10) NOT NULL COMMENT '1 = open , 2 = Progress , 0 = Closed',
  `complaint_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `close_date` date NOT NULL,
  `complaint_description` text NOT NULL,
  `address` text NOT NULL,
  `complaint_type_id` int(11) NOT NULL COMMENT 'From category_master',
  `employee_status` int(11) NOT NULL DEFAULT '1',
  `complaint_chargeble` int(11) NOT NULL COMMENT '0 = no 1 = yes',
  `product_id` int(11) NOT NULL,
  `assign_date` date NOT NULL,
  `assign_to` int(11) NOT NULL,
  `is_appove` int(11) NOT NULL,
  `employer_review` text NOT NULL,
  `attachment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
		$stmt = $conn->execute($sql);
				
		$sql="CREATE TABLE `tbl_expenses` (
  `expenses_id` int(11) NOT NULL,
  `main_label` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
		$stmt = $conn->execute($sql);
				
		$sql="CREATE TABLE `tbl_expenses_history` (
  `id` int(11) NOT NULL,
  `tbl_expenses_id` int(11) NOT NULL,
  `expense_amount` varchar(255) NOT NULL,
  `label_expense` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
				
		$stmt = $conn->execute($sql);		
				
		$sql="CREATE TABLE `tbl_income` (
  `income_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `main_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
		$stmt = $conn->execute($sql);
				
		$sql="CREATE TABLE `tbl_income_history` (
  `id` int(11) NOT NULL,
  `tbl_income_id` int(11) NOT NULL,
  `income_amount` varchar(255) NOT NULL,
  `label_income` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
		$stmt = $conn->execute($sql);
						
		
		
		$sql="CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `invoice_for` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);
		
				
		
		$sql="CREATE TABLE `tbl_invoice_history` (
  `invoice_h_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `item_name` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `net_amount` float NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1";			
				
		$stmt = $conn->execute($sql);	
				
		$sql="CREATE TABLE `tbl_mail_notification` (
  `id` int(11) NOT NULL,
  `notification_label` varchar(255) NOT NULL,
  `notification_for` varchar(255) NOT NULL,
  `notification_text` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `send_from` varchar(255) NOT NULL,
  `send_status` int(11) NOT NULL DEFAULT '0',
  `description_of_mailformate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);	

			

		
		$sql="CREATE TABLE `tbl_manage_service` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0 = sales service 1 = amc service',
  `sales_id` int(11) NOT NULL,
  `service_date` date NOT NULL,
  `done_date` date NOT NULL,
  `done_discription` text NOT NULL,
  `title` varchar(250) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `done_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = not done 1 = done',
  `c_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
		$stmt = $conn->execute($sql);		
				
		$sql="CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `is_archive` int(11) NOT NULL DEFAULT '0',
  `brand_id` int(11) NOT NULL,
  `model_no` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `open_stock` int(11) NOT NULL,
  `min_stock` int(11) NOT NULL,
  `max_stock` int(11) NOT NULL,
  `specification` text NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);		
				
		$sql="CREATE TABLE `tbl_purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_no` varchar(100) NOT NULL,
  `purchase_date` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=canceled,1=complete,2=In-Progress',
  `billing_address` text NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);	
				
		$sql="CREATE TABLE `tbl_purchase_history` (
  `purchase_h_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `item_name` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `net_amount` double NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);			
				
		$sql="CREATE TABLE `tbl_quotation` (
  `quotation_id` int(11) NOT NULL,
  `quotation_no` varchar(50) NOT NULL,
  `quotation_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);						
				
		$sql="CREATE TABLE `tbl_quotation_history` (
  `quotation_history_id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `item_name` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `net_amount` float NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);								
				
		$sql="CREATE TABLE `tbl_sales` (
  `sales_id` int(11) NOT NULL,
  `bill_number` varchar(30) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `discount` int(11) NOT NULL,
  `amc_typeid` int(11) NOT NULL DEFAULT '2' COMMENT '2 = no amc 1 = amc',
  `amc_warranty` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `no_of_services` varchar(255) NOT NULL,
  `assign_to` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);	
						
		$sql="CREATE TABLE `tbl_sales_history` (
  `sales_h_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `item_name` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `net_amount` float NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);		
				
		$sql="CREATE TABLE `tbl_sample` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);			
				
		$sql="CREATE TABLE `tbl_service` (
  `service_id` int(11) NOT NULL,
  `service_code` varchar(30) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `charge` varchar(10) DEFAULT NULL,
  `charge_amount` decimal(6,2) NOT NULL,
  `date` date NOT NULL,
  `remark` text NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 = open , 2 = Progress , 0 = Closed',
  `service_details` text NOT NULL,
  `employee_status` int(11) NOT NULL DEFAULT '1',
  `is_appove` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);		
				
		$sql="CREATE TABLE `tbl_service_history` (
  `service_history_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `item_name` int(11) NOT NULL,
  `note` text NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);	
				
		$sql="CREATE TABLE `tbl_stoke` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `number_of_stoke` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);
				
		$sql="CREATE TABLE `tbl_supplier` (
  `id` int(11) NOT NULL,
  `supplier_code` varchar(250) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `middle_name` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `address_line` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `supplier_company` varchar(255) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `swift_code` varchar(255) DEFAULT NULL,
  `branch_code` varchar(255) DEFAULT NULL,
  `international_bank_code` varchar(255) DEFAULT NULL,
  `national_bank_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);						
				
		$sql="CREATE TABLE `tbl_task` (
  `task_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `subject` text NOT NULL,
  `assign_date` date NOT NULL,
  `tasktype_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `description` text NOT NULL,
  `close_date` date NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `employee_status` int(11) NOT NULL DEFAULT '1',
  `is_appove` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);							
				
		$sql="CREATE TABLE `tbl_warranty` (
  `warranty_id` int(11) NOT NULL,
  `years` int(11) NOT NULL,
  `months` int(11) NOT NULL,
  `days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$stmt = $conn->execute($sql);	
		$sql="CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `is_archive` int(11) NOT NULL DEFAULT '0',
  `client_id` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(15) NOT NULL,
  `marital_status` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` varchar(30) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `alt_mobile` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_send_mail_Date` date NOT NULL,
  `token_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		$stmt = $conn->execute($sql);
		

		$sql="ALTER TABLE `category_master`
  ADD PRIMARY KEY (`cat_id`) KEY_BLOCK_SIZE=11";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `international_code`
  ADD PRIMARY KEY (`code_id`)";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `myguests`
  ADD PRIMARY KEY (`id`)";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `quatation_account_tax`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_account_tax_ibfk_1` (`quation_id`)";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `sale_account_tax`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_account_tax_ibfk_1` (`sale_id`)";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `supplier_international_detail`
  ADD PRIMARY KEY (`detail_id`)";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tble_setting`
  ADD PRIMARY KEY (`id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_accessright`
  ADD PRIMARY KEY (`id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_account_tax_rates`
  ADD PRIMARY KEY (`id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_amc`
  ADD PRIMARY KEY (`amc_id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_amc_history`
  ADD PRIMARY KEY (`amc_h_id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_client_history`
  ADD PRIMARY KEY (`id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`company_id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_company_detail`
  ADD PRIMARY KEY (`id`)";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`)";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `tbl_expenses`
  ADD PRIMARY KEY (`expenses_id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_expenses_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_expenses_history_ibfk_1` (`tbl_expenses_id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_income`
  ADD PRIMARY KEY (`income_id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_income_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_income_history_ibfk_1` (`tbl_income_id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_invoice_history`
  ADD PRIMARY KEY (`invoice_h_id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_mail_notification`
  ADD PRIMARY KEY (`id`)";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_manage_service`
  ADD PRIMARY KEY (`id`)";
$stmt = $conn->execute($sql);





$sql="ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`) KEY_BLOCK_SIZE=11";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`purchase_id`) KEY_BLOCK_SIZE=11";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_purchase_history`
  ADD PRIMARY KEY (`purchase_h_id`) KEY_BLOCK_SIZE=11";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_quotation`
  ADD PRIMARY KEY (`quotation_id`)";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_quotation_history`
  ADD PRIMARY KEY (`quotation_history_id`)";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`sales_id`)";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_sales_history`
  ADD PRIMARY KEY (`sales_h_id`)";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_sample`
  ADD PRIMARY KEY (`id`)";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_service`
  ADD PRIMARY KEY (`service_id`)";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_service_history`
  ADD PRIMARY KEY (`service_history_id`)";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_stoke`
  ADD PRIMARY KEY (`id`)";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id`)";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`task_id`)";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`)";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `tbl_warranty`
  ADD PRIMARY KEY (`warranty_id`)";
$stmt = $conn->execute($sql);



$sql="ALTER TABLE `category_master`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `international_code`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `myguests`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `quatation_account_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `sale_account_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `supplier_international_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `tble_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `tbl_accessright`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17";
  $stmt = $conn->execute($sql);

$sql="ALTER TABLE `tbl_account_tax_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);




$sql="ALTER TABLE `tbl_amc`
  MODIFY `amc_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_amc_history`
  MODIFY `amc_h_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_client_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_company_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_expenses`
  MODIFY `expenses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_expenses_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_income`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_income_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_invoice_history`
  MODIFY `invoice_h_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_mail_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_manage_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_purchase_history`
  MODIFY `purchase_h_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_quotation`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_quotation_history`
  MODIFY `quotation_history_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_sales_history`
  MODIFY `sales_h_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_service_history`
  MODIFY `service_history_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_stoke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `tbl_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `tbl_warranty`
  MODIFY `warranty_id` int(11) NOT NULL AUTO_INCREMENT";
$stmt = $conn->execute($sql);


$sql="ALTER TABLE `quatation_account_tax`
  ADD CONSTRAINT `quatation_account_tax_ibfk_1` FOREIGN KEY (`quation_id`) REFERENCES `tbl_quotation` (`quotation_id`) ON DELETE CASCADE";
$stmt = $conn->execute($sql);

$sql="ALTER TABLE `sale_account_tax`
  ADD CONSTRAINT `sale_account_tax_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `tbl_sales` (`sales_id`) ON DELETE CASCADE";
$stmt = $conn->execute($sql);
		



$sql="ALTER TABLE `tbl_expenses_history`
  ADD CONSTRAINT `tbl_expenses_history_ibfk_1` FOREIGN KEY (`tbl_expenses_id`) REFERENCES `tbl_expenses` (`expenses_id`) ON DELETE CASCADE";
$stmt = $conn->execute($sql);
		



$sql="ALTER TABLE `tbl_income_history`
  ADD CONSTRAINT `tbl_income_history_ibfk_1` FOREIGN KEY (`tbl_income_id`) REFERENCES `tbl_income` (`income_id`) ON DELETE CASCADE";
$stmt = $conn->execute($sql);



$insert = "INSERT INTO `tbl_accessright` (`id`, `menu_name`, `employee`, `client`) VALUES
(1, 'supplier', 1, 0),
(2, 'company', 0, 0),
(3, 'product', 0, 0),
(4, 'purchase', 0, 0),
(5, 'stoke', 0, 0),
(6, 'client', 1, 1),
(7, 'employee', 1, 0),
(8, 'quotation', 1, 1),
(9, 'sales', 1, 1),
(10, 'invoice', 0, 0),
(11, 'amc', 1, 1),
(12, 'complaint', 1, 1),
(13, 'service', 1, 0),
(14, 'task', 1, 0),
(15, 'expenses', 0, 0),
(16, 'income', 0, 0)";


		$stmt = $conn->execute($insert);
		
		
		$insert = "INSERT INTO `tbl_mail_notification` (`id`, `notification_label`, `notification_for`, `notification_text`, `subject`, `send_from`, `send_status`, `description_of_mailformate`) VALUES
(1, 'Customer and Employee add time', 'customer_add', 'Dear { user_name },\r\n\r\n         You are successfully registered at { system_name }. Your username: { username } and password: { password } You Are { role } Of { system_names }. \r\n\r\nRegards, \r\n{ system_name_regard }.', 'Amc Registration', 'vijay@dasinfomedia.com', 0, '{ user_name } = Customer OR Employee Name <br/>{ System_name } = Your System Name <br/> { username } = login email-id of user <br/> { password } = Login password of user <br/> { role } = role of user(client or custmor) <br/> { system_names } =  Your System Name <br/> { system_name_regard } = Your System Name'),
(2, 'Sales Email Notification ', 'seles_notification', 'Dear { username },\r\n\r\n         Thank You for your recent business with us. Please Find attached a detailed copy of invoice for  for your Perusal. \r\n\r\nThe total amount due is { amount } to be paid by { date }.\r\n\r\n{ invoice }\r\n\r\nRegards From { systemname }.', 'Invoice ', 'sales@dasinfomedia.com', 0, '{ user_name } = Customer OR Employee Name  <br/> { amount } = total amout of sales <br/> { date } = sales date <br/> { invoice } = Invoice print <br/>  { systemname } = Your System Name '),
(3, 'Quatation Email Notification', 'queotation_mail', 'Dear { username },\n\n         Thank You for your recent business with us. Please Find attached a detailed copy of Quotation for  for your Perusal. \n\n\n\n{ invoice }\n\nRegards,\n{ systemname }.', 'Quotation Invoice', 'sales@dasinfomedia.com', 0, '{ user_name } = Customer OR Employee Name <br/>  { invoice } = Invoice print <br/> { systemname } = Your System Name <br/>'),
(4, 'Complain Email Notification for customer', 'complaint_mail', 'Dear { username },\n\n          Thank you for submiting Complaint.Your complaint Number is { complaint_number } on { complaint_date }  for { description }\n\nRegards,\n{ systemname }.', 'Complaint submited', 'sales@dasinfomedia.com', 0, '{ user_name } = Customer Name <br/> { complaint_number } = Complain Number <br/> { complaint_date } = Complain Date <br/> { systemname } = Your System Name <br/>'),
(5, 'Complain Email Notification for admin', 'complaint_mail_admin', 'Dear { admin },\n\n         { customer } is submited Complaint. Complaint Number is { complaint_number } on { complaint_date }  for { description } .  \n\nRegards,\n{ systemname }.', 'Complaint', 'sales@dasinfomedia.com', 0, '{ admin } = admin first Name <br/> { customer } = Customer Name <br/> { complaint_number } = Complain Number <br/>  { complaint_date } = Complain Date <br/> { description } = Complain Descriptions <br/> { systemname } = Your System Name '),
(6, 'Complain Email Notification for Employee', 'complaint_mail_employee', 'Dear { employee },\n\n         You have assigned new Complaint from  { customer }. Complaint Number is { complaint_number } on { complaint_date }  for { description }\n\nRegards,\n{ systemname }.', 'Assign Complaint', 'sales@dasinfomedia.com', 0, '{ employee } = Employee first Name <br/> { customer } = Customer Name <br/>  { complaint_number } = Complain Number <br/> { complaint_date } = Complain Date <br/>  { description } = Complain Descriptions <br/> { systemname } = Your System Name'),
(7, 'Complain resolved for customer', 'complaint_resolved', 'Dear { username },\r\n\r\n\r\n \r\n           Your  complain { complaint_number } is resolved on { complaint_date } by { employee_name }  for { description }\r\n\r\n\r\nRegards,\r\n{ systemname }.', 'Complaint Resolve', 'sales@dasinfomedia.com', 0, '{ username } = Username first Name <br/> { complaint_number } = Complain Number <br/> { employee_name } = Employee Name <br/> { complaint_date } = Complain Date <br/>  { description } = Complain Descriptions <br/> { systemname } = Your System Name'),
(8, 'service list monthly', 'service_list_monthly_admin', 'Dear { admin },\n\n         Monthly Services list attached..\n\n\n { service_list }\n\n\nRegards,\n{ systemname }.', 'Monthly Service List', 'sales@dasinfomedia.com', 1, '{ admin } = admin first Name <br/> { service_list } = Service List <br/> { systemname } = Your System Name'),
(9, 'service before day', 'service_before_some_day', 'Dear { username },\n\n         Your Pre approved { service_title } services is Coming up on { service_date }.  This is Just a Reminder mail.\n\nRegards From { systemname }.', 'Free service mail', 'sales@dasinfomedia.com', 0, '{ username } = Customer Name <br/> { service_title } = Service Title <br/> { service_date } = Service Date <br/>   { systemname } = Your System Name'),
(10, 'service done mail', 'service_done', 'Dear { username },\n\n         Your services { service_title }  has been completed on { service_date }.\n\n\nRegards From { systemname }.', 'service done', 'sales@dasinfomedia.com', 0, '{ username } = Customer Name <br/> { service_title } = Service Title <br/> { service_date } = Service Date <br/>   { systemname } = Your System Name'),
(11, 'employee task list', 'employy_tasks', 'Dear { employee },\n\n         Here is the list of tasks assigned to you for { today_date }\n { tast_list }\n\nRegards,\n{ systemname }.', 'Today task list', 'sales@dasinfomedia.com', 0, '{ employee } = Employee first Name <br/>  { today_date } = today Date <br/> { tast_list } = Task list of today of Employee <br/> { systemname } = Your System Name'),
(12, 'Reset Password', 'reset_password', 'Dear { name },\n\n        To reset your password { link }.\n\n\nRegards,\n{ systemname }.', 'For Reset Password', 'sales@dasinfomedia.com', 0, '{ name } = Employee first Name<br> \n{ link } = Reset Password Link<br> \n{ systemname } = Your System Name')";
		$stmt = $conn->execute($insert);

		$data = $this->request->data;
		$insert = "INSERT INTO `tble_setting` (`id`, `title_name`, `icon`, `address`, `year`, `email`, `logo`, `cover_profile`, `countries`, `dateformate`, `mail_send`) VALUES
(10, '{$data['name']}', 'favicon.ico', '{$data['address']}', '2017', '{$data['email']}', 'logo.png', 'benner_image.png','US', 'd-m-Y', 1)";
		$stmt = $conn->execute($insert);
		$pw = md5($data['password']);
		$insert = "INSERT INTO `tbl_user` (`user_id`, `is_archive`, `client_id`, `first_name`, `middle_name`, `last_name`, `company_name`,`dob`, `gender`, `marital_status`, `address`, `username`, `password`, `city`, `state`, `pincode`, `mobile_no`, `alt_mobile`, `phone`, `email`, `photo`, `role`, `create_date`, `last_send_mail_Date`,`token_code`) VALUES
(1, 0, 'C430620161', '{$data['firstname']}', '', '{$data['lastname']}','dasinfomedia','2017-06-13', 'Male', 'Unmarried', '{$data['address']}', 'admin','$pw', '{$data['address']}', 'Gujarat', '382350', '9999999999', '9999999999', '9999999999', '{$data['loginemail']}', 'system_m.png', 'admin', '2017-02-13 00:00:00', '1995-04-24','sdere')";
		$stmt = $conn->execute($insert);

  
  
		file_put_contents(TMP.'installed.txt', date('Y-m-d, H:i:s'));	
		
		$this->redirect(["action"=>"success"]);
		
	}
	
	private function insertData($data)
	{
		// $this->viewBuilder()->layout("");
		// $this->autoRender = false;
		// $year = date("Y");
		// $conn = ConnectionManager::get('install_db');
		// $sql = $insert = "INSERT INTO `general_setting` (`name`, `start_year`, `address`, `office_number`, `country`, `email`, `date_format`, `calendar_lang`, `gym_logo`, `cover_image`, `weight`, `height`, `chest`, `waist`, `thing`, `arms`, `fat`, `member_can_view_other`, `staff_can_view_own_member`, `enable_sandbox`, `paypal_email`, `currency`, `enable_alert`, `reminder_days`, `reminder_message`, `enable_message`, `left_header`, `footer`,`system_installed`) VALUES
			// ('{$data['name']}', '{$year}', 'address', '8899665544', '{$data['country']}','{$data['email']}', 'F j, Y', '{$data['calendar_lang']}', '', '', 'KG', 'Centimeter', 'Inches', 'Inches', 'Inches', 'Inches', 'Percentage', 0, 1, 0, 'your_id@paypal.com', '{$data['currency']}', 1, '5', 'Hello GYM_MEMBERNAME,\r\n      Your Membership  GYM_MEMBERSHIP  started at GYM_STARTDATE and it will expire on GYM_ENDDATE.\r\nThank You.', 1,'GYM MASTER','Copyright © 2016-2017. All rights reserved.',1)";
		// $stmt = $conn->execute($sql);		
		
		
		// $sql = "INSERT INTO `category` (`name`) VALUES
				// ('Regular'),
				// ('Limited'),
				// ('Total Gym Exercises for Abs (Abdomininals)'),
				// ('Total Gym Exercises for Legs'),
				// ('Total Gym Exercises for Biceps'),
				// ('Exercise')";
		// $stmt = $conn->execute($sql);
		
		// $sql = "INSERT INTO `activity` (`cat_id`, `title`, `assigned_to`, `created_by`, `created_date`) VALUES
				// ( 5, 'Hyperextension', 2, 1, '2016-08-22'),
				// (3, 'Crunch', 2, 1, '2016-08-22'),
				// (4, 'Leg curl', 2, 1, '2016-08-22'),
				// (4, 'Reverse Leg Curl', 2, 1, '2016-08-22'),
				// (6, 'Body Conditioning', 2, 1, '2016-10-19'),
				// (6, 'Free Weights', 2, 1, '2016-10-19'),
				// (3, 'Fixed Weights', 2, 1, '2016-10-19'),
				// (3, 'Resisted Crunch', 2, 1, '2016-10-19'),
				// (6, 'Plank', 2, 1, '2016-10-19'),
				// (4, 'High Leg Pull-In', 2, 1, '2016-10-19'),
				// (4, 'Low Leg Pull-In', 2, 1, '2016-10-19')";
		// $stmt = $conn->execute($sql);
		
		// $sql = "INSERT INTO `installment_plan` (`number`, `duration`) VALUES
				// (1, 'Month'),
				// (1, 'Week'),
				// (1, 'Year')";
		// $stmt = $conn->execute($sql);
		
		// $sql = "INSERT INTO `gym_roles` (`name`) VALUES
				// ('Yoga')";
		// $stmt = $conn->execute($sql);
		
		// $sql = "INSERT INTO `class_schedule` (`class_name`, `assign_staff_mem`, `assistant_staff_member`, `location`, `days`, `start_time`, `end_time`, `created_by`, `created_date`) VALUES
				// ('Yoga Class', 2, 0, 'At Gym Facility', \"['Sunday','Saturday']\", '8:00:AM', '10:00:AM', 1, '2016-08-22'),
				// ('Aerobics Class', 2, 0, 'Class 1', \"['Sunday','Friday','Saturday']\", '5:15:PM', '6:15:PM', 1, '2016-08-22'),
				// ('HIT Class', 2, 2, 'Old location', \"['Sunday','Tuesday','Thursday']\", '7:30:PM', '8:45:PM', 1, '2016-08-22'),
				// ('Cardio Class', 2, 0, 'At Gym Facility', \"['Friday','Saturday']\", '3:30:PM', '4:30:PM', 1, '2016-08-22'),
				// ('Pilates', 2, 0, 'Old location', \"['Sunday']\", '12:00:PM', '3:15:PM', 1, '2016-08-22'),
				// ('Zumba Class',2, 0, 'New Location', \"['Saturday']\", '8:30:PM', '10:30:PM', 1, '2016-08-22'),
				// ('Power Yoga Class', 2, 0, 'New Location', \"['Monday','Wednesday','Thursday','Friday','Saturday']\", '9:15:AM', '11:45:AM', 1, '2016-08-22')";
		// $stmt = $conn->execute($sql);
		
		// $sql = "INSERT INTO `membership` (`membership_label`, `membership_cat_id`, `membership_length`, `membership_class_limit`, `limit_days`, `limitation`, `install_plan_id`, `membership_amount`, `membership_class`, `installment_amount`, `signup_fee`, `gmgt_membershipimage`, `created_date`, `created_by_id`, `membership_description`) VALUES
				// ('Platinum Membership', 1, 360, 'Unlimited', 0, '', 1, 500, \"['1','2','3','4','5','6','7']\", 42, 5, '', '2016-08-22', 1, '<p>Platinum membership description<br></p>'),
				// ('Gold Membership', 1, 300, 'Unlimited', 0, '', 1, 450, \"['1','2','3','4','5']\", 37, 5, '', '2016-08-22', 1, '<p>Gold membership description<br></p>'),
				// ('Silver Membership', 2, 180, 'Limited', 0, 'per_week', 2, 200, \"['4','6','7']\", 5, 5, '', '2016-08-22', 1, '<p>Silver &nbsp;membership description</p>')";
		// $stmt = $conn->execute($sql);	
		// $this->updateSys();
	}
	
	
	public function updateSys()
	{		
				
	}
	
	
	public function success()
	{
		
	}
	
	// public function isAuthorized($user)
	// {
		// return true;
	// }
}