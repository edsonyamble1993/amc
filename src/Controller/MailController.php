<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FlashHelper;

class MailController extends AppController
{
	public function maillist()
    {
		$tbl_manage_service =TableRegistry::get('tbl_mail_notification');
		$servicesss = $tbl_manage_service->find()->toArray();
		$this->set('mail_list',$servicesss);
		if($this->request->is(array('post','put'))){
			
			$data['notification_text'] = $this->request->data('notification_text');
			$data['send_from'] = $this->request->data('send_from');
			$data['subject'] = $this->request->data('subject');
			$dataid = $this->request->data('mail_id');
			
			$tbl_manage_data = $tbl_manage_service->get($dataid);
			
			$dataaccount=$tbl_manage_service->patchEntity($tbl_manage_data, $data);
			 $tbl_manage_service->save($dataaccount);
			 $this->Flash->success(__('Mail Record Updated Successfully'));
			 return $this->redirect(array('controller'=>'mail','action'=>'maillist'));
		
		}
    }
}