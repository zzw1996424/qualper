<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Login extends CI_Controller {
		public function __construct() {
	        parent::__construct();
			date_default_timezone_set("Asia/Shanghai");// 时区慢了6个小时的解决方法
	        //$this->mem = new Memcache;
	        //$this->mem->connect("127.0.0.1", "11211");			
	    }
		/*
		 * 登录
		 */
		 public function login(){
		 	$this->load->view('login.html');
		 }
		 /*
		  * 注册的验证码
		  */
		  public function regist(){
		  	header("Access-Control-Allow-Origin: * ");
		  	$this->load->helper('captcha');
			
	        if($this->uri->segment(3)=='phone_register'){
	        	$vals = array(
			    'word' => rand(1000, 10000),
			    'img_path' => './captcha/',
			    'img_url' => 'http://zhengzhiwei1.top/poetry/captcha/',
			    //'font_path' => './path/to/fonts/texb.ttf',
			    'img_width' => '80',
			    'img_height' => 40,
			    'expiration' => 72
			    );
				$cap = create_captcha($vals);
				$_SESSION['captcha'] = $cap['word'];//把生成的验证码放到session
		        $data['captcha'] = $cap['image']; //验证码图片地址
		        $data['word'] = $cap['word']; //验证码上的文字
	        	$arr = array($data['captcha'],$data['word']);
	        	echo json_encode($arr);
	        }else{
	        	$vals = array(
			    'word' => rand(1000, 10000),
			    'img_path' => './captcha/',
			    'img_url' => 'http://zhengzhiwei1.top/poetry/captcha/',
			    //'font_path' => './path/to/fonts/texb.ttf',
			    'img_width' => '150',
			    'img_height' => 30,
			    'expiration' => 72
			    );
				$cap = create_captcha($vals);
				$_SESSION['captcha'] = $cap['word'];//把生成的验证码放到session
		        $data['captcha'] = $cap['image']; //验证码图片地址
		        $data['word'] = $cap['word']; //验证码上的文字
	        	$this->load->view('regist.html',$data);
	        }
	        
			
		  }

		/*
	     * AJAX方式调用的验证码 当验证码不正确时点击验证码更换
	     */
	
	    public function register() {
	    	header("Access-Control-Allow-Origin: * ");
	        $this->load->helper('captcha'); //载入验证码类
	       $vals = array(
			    'word' => rand(1000, 10000),
			    'img_path' => './captcha/',
			    'img_url' => 'http://zhengzhiwei1.top/poetry/captcha/',
			    //'font_path' => './path/to/fonts/texb.ttf',
			    'img_width' => '150',
			    'img_height' => 30,
			    'expiration' => 72
		    );
	        $cap = create_captcha($vals);
	        $data['captcha'] = $cap['image']; //验证码图片地址
	        $data['word'] = $cap['word']; //验证码上的文字
	        echo json_encode($data);
	    }
		/*
		 * 查询数据库有没有对应的邮箱
		*/
		public function email(){
			header("Access-Control-Allow-Origin: * ");
			$email = $this->input->post('email');
			// 查询数据库
			 $data1 = $this->db->get_where('user',array('email'=>$email))->result_array();
			 if($data1){
			 	$_SESSION['name'] = $data1;//查到有此账户放到session
				  // session原生读取二维数组的方法
				  //var_dump($_SESSION['name'][0]['name']);
				  // session中二维数组的读取方法
				  //echo $this->session->name[0]['name'];
				  // session中session_id的唯一id
				  $pas = $data1[0]['password'];			   
			 	  $arr = array($pas, 'aaa',$data1);
            		echo json_encode($arr);
			 }else {
			 	$arr = array('bbb');
            	echo json_encode($arr);
        	}	 
		}
		/*
		 *接收注册传过来的数据并传入数据库并跳转到登录页 
		*/
		public function rigister_data(){
			$email = $this->input->post('email');
			$name = $this->input->post('username');
			$password = $this->input->post('password');
			$data = array(
				'name'=>$name,
				'email'=>$email,
				'password'=>md5($password),
				'img'=>'img/avatar.png'
			);
			$this->db->insert('user',$data);
			// 注册成功以后跳转到登录页
			 header("location:" . site_url('login/login')); //pc端跳转
		}

		  /*
		   * 忘记密码
		   */
		   public function reset_password(){
		   	$this->load->view('reset_password.html');
		   }
		   /*
		   * 忘记密码下一步发送邮件
		   */
		   public function reset_password2(){
		   	$email= $this->input->post('my_email');// Ci框架不允许导航栏出现@符号,要在config里面配置$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-@';
//			$base_email=base64_encode($email);
		   	$this->email->from('1534395050@qq.com', '郑智伟');// 自己的邮箱地址和名字
			$this->email->to($email);// 对方接受邮箱
			$this->email->cc('');// 抄送给谁
			$this->email->bcc('');// 设置密送			
			$this->email->subject('之为诗词网密码找回');// 设置email主题
			$this->email->message('<a href="http://172.16.0.126/poetry/index.php/login/reset_password3/'.$email.'">尊敬的之为用户您好,请点击当前文字修改密码!</a>');// 邮件的正文部分
			// 果果内容部分带有标签链接要在Emali中修改文件格式$mailtype='html';
			$this->email->attach('http://172.16.0.126/poetry/img/logo.png');// 附件可以发送图片文档之类;
			$qq = $this->email->send();// 发送邮件并接收返回值,发送成功返回的是1
			echo $email;
			if($qq==1){
				echo '邮件发送成功!';
				$this->load->view('reset_password2.html');
			}else{
				echo '发送失败!';
			}
		   }
		   /*
		    *跳转到改密码页面 
		    */
		     public function reset_password3(){
		     	$this->load->view('reset_password3.html');
		     }
			/*
			 * 邮箱里的邮件密码找回链接
			 */
			 public function reset_password4(){
				$password = md5($this->input->post('password1'));
				$email = $this->uri->segment(3);
				echo $password.$email;
				$data=array('password'=>$password);
				$this->db->update('user', $data, array('email' => $email));
				// $this->db->query("update user set password='" . $password . "' where email=$email");
				header("location:" . site_url('login/login'));
			 }
		   /*
		    * 退出登录的方法
		    */
		   public function logout() {
		        $this->session->sess_destroy();
		        success('home/index', '已退出登录');// success函数是自己写的,在system中的common中,这里可以写自己的脚本
		    }
		   /*
		    * 测试ajax
		    */
		   public function ajaxa(){
		   	$this->load->view('ajax.html');
		   }
		   public function ajax(){
		   	$data = array('aaa','bbb');
		   	echo json_encode($data);
		   }
		   
		   
	}
?>