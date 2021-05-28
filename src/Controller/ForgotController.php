<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Network\Session\DatabaseSession;
use Cake\View\Helper\FlashHelper;
use Cake\Event\Event;
use Cake\Mailer\Email;

class ForgotController extends AppController
{

	// public $user_table;
	// public $get_user_data;
	// public $flag;

	public function initialize()
    {
       parent::initialize();

    }

	public function forgotpassword()
	{
		$this->viewBuilder()->layout('loginlayout');
		
		if($this->request->is("post"))
		{
			if(isset($this->request->data['go']))
			{
				$user_tbl = TableRegistry::get('tbl_user');
				$post = $this->request->data;
				$cnt = $user_tbl->find()->where(['email'=>$post['email']])->count();
				if($cnt)
				{
					$token = bin2hex(openssl_random_pseudo_bytes(10));
					$user_data = $user_tbl->find()->where(['email'=>$post['email']])->first();
					$name = $user_data['first_name'];
					
					$query = $user_tbl->query();
					$result = $query->update()
                    ->set(['token_code' => $token])
                    ->where(['email' => $post['email']])
                    ->execute();
					
					
					if($result)
					{
						//For Customer
						$tble_setting = TableRegistry::get('tble_setting');
						$mailformate = $tble_setting->find()->first();
						$sendmail = $mailformate['mail_send'];
						$title_name = $mailformate['title_name'];
						$host = $_SERVER['HTTP_HOST'].$this->request->base;
						$link = "<a href={$host}/Forgot/resetpassword?code={$token}>Click Here</a>";
						
						$mail_notification = TableRegistry::get('tbl_mail_notification');
						$mailformate = $mail_notification->find()->where(['notification_for'=>'reset_password'])->first();
						$mailformat = $mailformate['notification_text'];
						$serch = array('{ name }','{ link }','{ systemname }');
						$replace = array($name,$link,$title_name);
						$message_content = str_replace($serch, $replace, $mailformat);
						$subject = $mailformate['subject'];
						$headers = "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8";
						$headers .= 'From:'. $mailformate['send_from'] . "\r\n";
						
						$email = new Email('default');
						$to = $post['email'];
						//$message = "Dear ".$name.","."\n"."To reset your password <a href="">Click Here</a>";
						//$headers = "From: Annual Maintenance Contract>" . "\r\n";
						  // $email->from("das@infomedia.com")
							// ->emailFormat('html')
							// ->to($to)
							// ->subject($subject)
							// ->send($message_content);
				
						//mail($to,_("Forgot Password"),$message,$headers);
						mail($to,$subject,$message_content,$headers);
					}
				}
				else
				{
					$this->Flash->success(__('E-mail not exist !', null), 
							'default', 
							array('class' => 'success'));
				}
			}
		}
	}	

	public function resetpassword()
	{
		$this->viewBuilder()->layout('loginlayout');
		
		$token = $_GET['code'];
		
		if($this->request->is("post"))
		{
			if(isset($this->request->data['go']))
			{

				$user_tbl = TableRegistry::get('tbl_user');
				$post = $this->request->data;
				$password = $post['create_password'];
				$converted_password = md5($password);
				$cnt = $user_tbl->find()->where(['token_code'=>$token])->count();
				if($cnt)
				{
					$query = $user_tbl->query();
					$result = $query->update()
                    ->set(['password' => $converted_password])
                    ->where(['token_code' => $token])
                    ->execute();
					if($result)
					{
						$query1 = $user_tbl->query();
						$result1 = $query1->update()
						->set(['token_code' => NULL])
						->where(['token_code' => $token])
						->execute();
						$this->Flash->success(__('Password Reset Successfully', null), 
							'default', 
							array('class' => 'success'));
						return $this->redirect(['controller' => 'Users','action'=>'login']);
					}
				}
				else{
						$this->Flash->success(__('Token Mismatch, Please try again', null), 
							'default', 
							array('class' => 'success'));
						return $this->redirect(['action'=>'forgotpassword']);
				}
			}
		}
	}
}
?>
