<?php
namespace App\Controller;

use Cake\Controller\Component;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FlashHelper;



class DailytaskController extends AppController{

	public $get_all_task;
	public $table_user;
	public $table_task;


	public function initialize(){
       parent::initialize();
   }

	    public function TableUser()  { $this->table_user  =  TableRegistry::get('tbl_user'); }
        public function TableTask(){ $this->table_task=TableRegistry::get('tbl_task'); }

   		public function index(){
   			$this->redirect(array('controller'=>'Dailytask','action'=>'dailytask'));
   			}

   public function dailytask(){

	   		$this->TableUser();
	   		$this->TableTask();

			$this->get_all_task=$this->table_task->find()->where(array('client_id'=>14));
	   		$this->set('dailytask',$this->get_all_task);


   }

}

?>