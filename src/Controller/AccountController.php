<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FlashHelper;

class AccountController extends AppController
{
	public function initialize(){
		$this->setting_image=WWW_ROOT.'img/user/';
       parent::initialize();     
   }
	public function profilesetting($id)
    {
		$table_profile =TableRegistry::get('tbl_user');
		$profile_data = $table_profile->get($id);
		$this->set('updateprofiledata',$profile_data);
		if($this->request->is('post'))
		{
			$alldata = $this->request->data;
			$ext = pathinfo($this->request->data('originaladdedimage'), PATHINFO_EXTENSION);
			$valid_extension = ['gif','png','jpg','jpeg',""];
			if(in_array($ext,$valid_extension) )
			{
				// if($_FILES['image']['name'] != null && !empty($_FILES['image']['name'])){
					// move_uploaded_file($_FILES['image']['tmp_name'],$this->setting_image.$_FILES['image']['name']);
					// $this->store_image=$_FILES['image']['name'];
				// }else{
					// $this->store_image=$this->request->data('old_image');
				// }
				
				$dataiamge = $this->request->data('client_image');
				if($dataiamge != '')
				{
					$first_name = $this->request->data('first_name');
					$last_name = $this->request->data('last_name');
					$time = time();
					$imagename = $first_name.'_'.$last_name.'_'.$time.'.png';
					$this->store_image = $first_name.'_'.$last_name.'_'.$time.'.png';
					
					$source = fopen($dataiamge, 'r');
					$destination = fopen('img/user/'.$imagename, 'w');

					stream_copy_to_stream($source, $destination);

					fclose($source);
					fclose($destination);
				}else
				{
					$this->store_image=$this->request->data('old_image');
				}
				
				$alldata['photo']=$this->store_image;
				
				$alldata =$table_profile->patchEntity($profile_data,$alldata);
				
				if($table_profile->save($alldata))
				{
					$this->Flash->success(__('Record updated Successfully'));
					return $this->redirect(array('action'=>'profilesetting',$id));
				}
			}else{
				$this->Flash->success(__('Invalid File Attachment'));
				return $this->redirect(array('action'=>'profilesetting',$id));
			}
		}
    }
	

}