<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Home extends CI_Controller {
		public $dataz;
		/*
		 * 构造函数
		 */
		public function __construct() {
	        parent::__construct();
			$this->load->model('model');
//	        $this->mem = new Memcache;
//	        $this->mem->connect("127.0.0.1", "11211");	
			date_default_timezone_set("Asia/Shanghai");// 时区慢了6个小时的解决方法		
	    }
		/*
		 * 公共头部
		 */
		public function public_header(){
			$this->load->view('public_header.html');
		}
		/*
		 * 首页
		 */
		 public function index(){ 
		 	// 查询数据库后30位用户
		 	$sql="SELECT * FROM user order by uid desc limit 30";
			$data['userimg'] = $this->db->query($sql)->result_array();	
			// 查询所有的词人
			$data['ci']=$this->db->get_where('user', array('reserved' =>'词'))->result_array();// 查询所有的词	
			// 取最新的12篇词
			$sql="SELECT * FROM collect WHERE classify='词' order by time desc limit 12";
			$data['ci1'] = $this->db->query($sql)->result_array();
			// 查询所有的诗人
			$data['shi']=$this->db->get_where('user', array('reserved' =>'诗'))->result_array();// 查询所有的诗	
			// 最新诗词
			$sql="SELECT * FROM collect order by time desc limit 40";
			$data['xin'] = $this->db->query($sql)->result_array();
			// 热门排行
			$sql="SELECT * FROM collect WHERE classify='词' order by time desc limit 20";
			$data['pai'] = $this->db->query($sql)->result_array();	
			// 精品词集的六首词
			$data['ci6'][0]=$this->db->get_where('collect', array('poetry_num' =>'9'))->result_array();
			$data['ci6'][1]=$this->db->get_where('collect', array('poetry_num' =>'62'))->result_array();
			$data['ci6'][2]=$this->db->get_where('collect', array('poetry_num' =>'183'))->result_array();
			$data['ci6'][3]=$this->db->get_where('collect', array('poetry_num' =>'108'))->result_array();
			$data['ci6'][4]=$this->db->get_where('collect', array('poetry_num' =>'121'))->result_array();
			$data['ci6'][5]=$this->db->get_where('collect', array('poetry_num' =>'141'))->result_array();
			// 散文小说合集
			$data['san']=$this->db->get_where('user', array('reserved' =>'散文'))->result_array();
			// 散文个数
			$data['san_num'][0] = count($this->db->get_where('collect', array('uid' =>'60'))->result_array());
			$data['san_num'][1] = count($this->db->get_where('collect', array('uid' =>'61'))->result_array());
			$data['san_num'][2] = count($this->db->get_where('collect', array('uid' =>'62'))->result_array());
			$data['san_num'][3] = count($this->db->get_where('collect', array('uid' =>'63'))->result_array());
			$data['san_num'][4] = count($this->db->get_where('collect', array('uid' =>'64'))->result_array());
			$data['san_num'][5] = count($this->db->get_where('collect', array('uid' =>'65'))->result_array());
			
			
			if($this->uri->segment(3)=='vue'){
				header("Access-Control-Allow-Origin: * ");
				echo json_encode($data['pai']);
			}else{
				$this->load->view('index.html',$data);
			}
		 	
			
		 }
		/*
		 * 个人中心页面
		 */
		 public function account(){
		 	header("Access-Control-Allow-Origin: * ");			
		 	$uid = $this->session->name[0]['uid'];
			if($this->input->post('uid')){
				$uid = $this->input->post('uid');
			}
		 	$data['poetry'] = $this->model->account_poetry($uid);
			for($i=0;$i<count($data['poetry']);$i++){// 遍历所有的文章
				$poetry_num=$data['poetry'][$i]['poetry_num'];// 当前文章的id
				$commentnum = count($this->db->get_where('comment', array('poetryid' =>$data['poetry'][$i]['poetry_num']))->result_array());// 当前文章的评论数
				$this->db->query("update collect set comment_num='" . $commentnum . "' where poetry_num=$poetry_num");// 把当前文章的评论总数插入到数据库
				$likenum = count($this->db->get_where('like', array('poetryid' =>$data['poetry'][$i]['poetry_num']))->result_array());// 当前文章的评论数
				$this->db->query("update collect set collect_num='" . $likenum . "' where poetry_num=$poetry_num");// 把当前文章的评论总数插入到数据库
			}
			$data['likeid']=$this->db->get_where('like', array('userid' =>$uid))->result_array();// 查询这个uid的收藏的所有文章的id
			for($i=0;$i<count($data['likeid']);$i++){// 遍历所有的文章
				$poetry_num=$data['likeid'][$i]['poetryid'];// 当前文章的id
				$data['like'][$i] = $this->db->get_where('collect', array('poetry_num' =>$poetry_num))->result_array();// 收藏文章的内容					
				
			}
			// 连续登陆的天数
			$data['islian']=$this->db->get_where('user', array('uid'=>$uid))->result_array();
			// 等级划分
			$dengji = $data['islian'][0]['integral'];
			$aaa = $this->model->grade($dengji);
			$data['grade']=$aaa['grade'];
			$data['color']=$aaa['color'];
			if($this->uri->segment(3)=='phone_poetry'){
				echo json_encode($data);
			}else{
				$this->load->view('account.html',$data);
			}
		 	
		 }
		 
		 /*
		  * 个人中心上传文章
		  */
		  public function uploading(){
		  	date_default_timezone_set("Asia/Shanghai");// 时区慢了6个小时的解决方法
			$this->load->library('upload');//引入第三方类库,外部引入的第三方类库在application/libraries下
	        $file_upload = new Upload();
	        $filename = $file_upload->upload_file();// 图片的文件名字
	        $img = base_url().'img/user/' . $filename;// 图片的路径完整路径
	        $img1 = 'img/user/' . $filename;     	       
			$classify = $this->input->post('classify');// 文章分类
		  	$username = $this->input->post('username');// 作者
		  	$title = $this->input->post('title');// 标题
		  	echo $content = $this->input->post('content');// 内容 // mysql_escape_string用于将特殊字符转义
		  	$showtime=date("Y-m-d H:i:s");// 上传时间
			$data = array(
				'classify'=>$classify,
				'title'=>$title,
				'author'=>$username,
				'time'=>$showtime,
				'img'=>$img1,
				'content'=>$content,
				'uid'=>$this->session->name[0]['uid']
			);
			$this->db->insert('collect',$data);
			// 上传文章积分+5
			$uid = $this->session->name[0]['uid'];
			$integral =$this->db->get_where('user', array('uid'=>$uid))->result_array();
			$jifen = $integral[0]['integral']+5;
			$this->db->query("update user set integral='" . $jifen . "' where uid=$uid");
			header('location:' . site_url('home/account/success'));	
		  }
		  
		   /*
		    * 个人中心页面的头像上传
		    */
		  public function user_avatar(){
		  	$uid = $this->session->name[0]['uid'];
		  	$this->load->library('upload1');//引入第三方类库,外部引入的第三方类库在application/libraries下
	        $file_upload = new Upload1();
	        $filename = $file_upload->upload_file();// 图片的文件名字
	        $img = 'img/avatar/' . $filename;// 图片的路径	
	         $this->db->query("update user set img='" . $img . "' where uid=$uid");// 更新数据库的头像
	         $_SESSION['name'][0]['img']=$img;
			 header('location:' . site_url('home/account'));// 回到个人中心页面
		  }		  
		  /*
		   * 诗词分类,看是什么类型的文章,查询该分类在数据库的所有文章
		   */
		   
		   public function classify(){
		   	$this->load->view('classify.html');
		   }
		   /*
		    * 诗词分类自动发送ajax获取数据
		    */
		   public function classifya(){
		   	header("Access-Control-Allow-Origin: * ");	
		    	$classify = $this->input->post('class_url');
				if($classify==1){// 等于1的时候是诗
					$data['content']=$this->db->get_where('collect', array('classify' =>'诗'))->result_array();// 查询所有的诗		
				}else if($classify==2){
					$data['content']=$this->db->get_where('collect', array('classify' =>'词'))->result_array();// 查询所有的词
				}else if($classify==3){
					$data['content']=$this->db->get_where('collect', array('classify' =>'赋'))->result_array();// 查询所有的赋
				}
				echo json_encode($data['content']);
		    }
		   /*
		    * 测试
		    */
		   public function fu1(){
		   	$this->load->view('demo.html');
		   }
		   public function fu(){
		   		$data['content']=$this->db->get_where('collect', array('classify' =>'诗'))->result_array();// 查询所有的诗	
				echo json_encode($data['content']);
		   }
		   /*
		    * 个人中心页面的修改昵称
		    */
		   public function nickname(){
		   	
		   	$name = $this->input->post('nickname');
			$uid = $this->session->name[0]['uid'];
			// 更新数据库的昵称
			 $this->db->query("update user set name='" . $name . "' where uid=$uid");		
			 $_SESSION['name'][0]['name'] = $name;// 把昵称在session中更新
			header('location:' . site_url('home/account'));	
		   }
		   /*
		    * 个人中心的密码修改
		    */
		    public function xiupassword(){
		    	$pass3 = $this->input->post('pass3');
				$uid = $this->session->name[0]['uid'];
				 $this->db->query("update user set password='" . md5($pass3) . "' where uid=$uid");
				 $_SESSION['name'][0]['password'] = md5($pass3);// 把密码在session中更新
				header('location:' . site_url('home/account'));	
		    }
		   /*
		    * 修改个人资料
		    */
		   	public function personal_data(){
		   		$uid = $this->session->name[0]['uid'];
				$data = array(
					'sex' => $_POST['dender'],// 性别 select要用原生的方法取值
					'birthday' => $this->input->post('birth'),// 生日
					'city' => $this->input->post('city'),// 城市
					'qq' => $this->input->post('qq'),// qq
					'weibo' => $this->input->post('weibo'),// weibo
					'signature' => $this->input->post('signature'),// 个性签名
					'account' => $this->input->post('introduction')// 个人简介
				);
				$this->db->update('user', $data, array('uid' => $uid));
				/*
				 * 更新session
				 */
				$_SESSION['name'][0]['sex']=$_POST['dender'];
				$_SESSION['name'][0]['birthday']= $this->input->post('birth');
				$_SESSION['name'][0]['city']= $this->input->post('city');
				$_SESSION['name'][0]['qq']= $this->input->post('qq');
				$_SESSION['name'][0]['weibo']= $this->input->post('weibo');
				$_SESSION['name'][0]['signature']= $this->input->post('signature');
				$_SESSION['name'][0]['account']= $this->input->post('introduction');
				header('location:' . site_url('home/account'));	
		   	}
		   /*
		    * 文章诗词点击打开的页面
		    */
		    public function article(){
		    	header("Access-Control-Allow-Origin: * ");
		    	$num=$this->uri->segment(3);// 获取诗词的id
		    	if($this->input->post('a')){
					$num = $this->input->post('a');
				}
				$data['details'] =$this->db->get_where('collect', array('poetry_num' =>$num))->result_array();// 查询当前id的内容		
				$data['like'] =$this->db->get_where('like', array('poetryid' =>$num))->result_array();// 查询当前的文章有多少人收藏	
				$data['comment'] =$this->db->get_where('comment', array('poetryid' =>$num))->result_array();// 查询当前评论的内容			
				
				if($this->input->post('a')){
					echo json_encode($data);
					
				}else{
					$this->load->view('article.html',$data);
				}
		    }
		   /*
		    * 作者的个人中心页面
		    */
		    public function writer(){
		    	$uid = $this->uri->segment(3);
				$data['details'] =$this->db->get_where('collect', array('uid' =>$uid))->result_array();// 查询这个uid的所有文章
				$data['user'] =$this->db->get_where('user', array('uid' =>$uid))->result_array();// 查询这个uid的个人信息	
				$data['likeid']=$this->db->get_where('like', array('userid' =>$uid))->result_array();// 查询这个uid的收藏的所有文章的id
				for($i=0;$i<count($data['likeid']);$i++){// 遍历所有的文章
					$poetry_num=$data['likeid'][$i]['poetryid'];// 当前文章的id
					$data['like'][$i] = $this->db->get_where('collect', array('poetry_num' =>$poetry_num))->result_array();// 收藏文章的内容					
				}
				$data['islian']=$this->db->get_where('user', array('uid'=>$uid))->result_array();
				// 等级划分
				$dengji = $data['islian'][0]['integral'];
				$aaa = $this->model->grade($dengji);
				$data['grade']=$aaa['grade'];
				$data['color']=$aaa['color'];
		    	$this->load->view('writer.html',$data);
		    }
			/*
			 * 收藏
			 */
		   public function collect(){
		   		header("Access-Control-Allow-Origin: * ");
				$userid=$this->input->post('userid');// 收藏者的id
				$poetryid=$this->input->post('poetryid');// 诗词的id
				$poetryname=$this->input->post('poetryname');// 诗词的作者
				$poetrytitle=$this->input->post('poetrytitle');// 诗词的标题
				$sq =$this->db->get_where('like', array('poetrytitle' =>$poetrytitle,'userid'=>$userid))->result_array();// 查询数据库有没有收藏过
				if($sq){
					// 如果收藏过就显示已经收藏过
					$res = array('aaa');
					echo json_encode($res);
				}else{
					// 如果没有收藏就把收藏的内容放进数据库
					$data = array(
						'userid'=>$userid,
						'poetryid'=>$poetryid,
						'poetryname'=>$poetryname,
						'poetrytitle'=>$poetrytitle
					);
					$this->db->insert('like',$data);
					$res1 = array('bbb');
					// 收藏积分+1
					$uid = $this->session->name[0]['uid'];
					$integral =$this->db->get_where('user', array('uid'=>$uid))->result_array();
					$jifen = $integral[0]['integral']+1;
					$this->db->query("update user set integral='" . $jifen . "' where uid=$uid");
					echo json_encode($res1);
				}
		   }
		   /*
		    * 评论
		    */
		    public function comment(){
		    	header("Access-Control-Allow-Origin: * ");
		    	$poetryid =$this->input->post('poetryid');// 诗词的id
				$userid = $this->input->post('userid');// 收藏者的id
				$comment_content = $this->input->post('comment_content');// 评论的内容
				$poetrytitle = $this->input->post('poetrytitle');// 所评论的文章标题
				$comment_time = $this->input->post('comment_time');// 评论的当前时间
				$comment_img = $this->input->post('comment_img');// 评论的当前的头像
				$comment_name = $this->input->post('comment_name');// 评论的昵称
				$floor =count($this->db->get_where('comment', array('poetryid' =>$poetryid))->result_array())+1;// 查看数据库有几人评论+1				
				$data = array(
					'poetryid'=>$poetryid,
					'userid'=>$userid,
					'comment_content'=>$comment_content,
					'poetrytitle'=>$poetrytitle,
					'comment_time'=>$comment_time,
					'comment_img'=>$comment_img,
					'comment_name'=>$comment_name,
					'floor'=>$floor
				);
				$this->db->insert('comment',$data);
				// 评论积分加2
				$uid = $this->session->name[0]['uid'];
				$integral =$this->db->get_where('user', array('uid'=>$uid))->result_array();
				$jifen = $integral[0]['integral']+2;
				$this->db->query("update user set integral='" . $jifen . "' where uid=$uid");
		    }
			/*
			 * 搜索页面
			 */
		    public function seck(){
		    	$data['search']=array();
				// 搜索数据库诗的后15条 asc是正序从前往后找 desc是倒序 从后往前找
				$sql="SELECT * FROM collect WHERE classify='诗' order by time desc limit 10";
				$data['shi'] = $this->db->query($sql)->result_array();
				$sql="SELECT * FROM collect WHERE classify='词' order by time desc limit 10";
				$data['ci'] = $this->db->query($sql)->result_array();				
		    	$this->load->view('seck.html',$data);
		    }
			/*
			 * 搜索查询
			 */
			 public function search(){
			 	$search = $this->input->post('search');// 获取搜索的内容
				$type= $this->input->post('type');// 索取搜索的选项
				if($type=='collect'){
//					$data=$this->db->like('collect', $search)->result_array();不会用				
					$sql="SELECT * FROM collect WHERE content LIKE '%$search%'";
					$data['search'] = $this->db->query($sql)->result_array();
				}else{
					$sql = $sql="SELECT * FROM collect WHERE author LIKE '%$search%'";
					$data['search'] = $this->db->query($sql)->result_array();
				}
				$this->load->view('seck.html',$data);	
			 }
			 /*
			  * 关于我们
			  */
			  public function regards(){
			  	$this->load->view('guan.html');
			  }
			  /*
			   * 免责声明
			   */
			  public function statement(){
			  	$this->load->view('mian.html');
			  }
			  /*
			   * 联系我们
			   */ 
			 public function relation(){
			  	$this->load->view('lian.html');
			  }
			 /*
			  * 等级说明
			  */
			 public function integral(){
			  	$this->load->view('integral.html');
			  }
			 /*
			  * 积分说明
			  */
			 public function grade(){
			  	$this->load->view('grade.html');
			  }
			 /*
			  * 建议反馈
			  */
			  public function suggest(){
			  	$this->load->view('jian.html');
			  }
			 /*
		     * qq_login  QQ登录的页面
		     */
		
		    public function qqlogin($param) {
		       require_once 'Connect2.1/API/qqConnectAPI.php';
				$qc = new QC();
				$qc->qq_login();

		    }
		
		    /*
		     * qq_login  QQ登录的方法的access_token
		     */
		
		    public function qq_login() {
		        require_once 'Connect2.1/API/qqConnectAPI.php';
		        $oauth = new Oauth();
		        $access_token = $oauth->qq_callback();
		        $openid = $oauth->get_openid();
		        setcookie('qq_access_token', $access_token, time() + 86400);
		        setcookie('qq_openid', $openid, time() + 86400);
		        $qc = new QC($access_token, $openid);
				$userinfo = $qc->get_user_info();	
				//var_dump($userinfo);		
				$name =  $userinfo['nickname'];// qq用户名
				// 获取到登录用户的信息后看看数据库有没有这个用户的信息,如果有就拿出来用,如果没有就把用户的信息提交到数据库
				$sex = $userinfo['gender'];// qq用户性别
				$img = $userinfo['figureurl_qq_2'];// qq用户的头像
				$city = $userinfo['city'];// qq用户的城市
				$qqopenid = $openid;// qq用户的唯一id
				// 先查询数据库里有没有该用户的openid
				$qqopenid_user =$this->db->get_where('user', array('qqopenid'=>$openid))->result_array();
				$qquser = array(
						'name'=>$name,
						'sex'=>$sex,
						'img'=>$img,
						'city'=>$city,
						'qqopenid'=>$qqopenid	
					);
					
				if(!$qqopenid_user){// 如果没有就向数据库填充数据
					//echo '没有查到该用户!';
					$this->db->insert('user',$qquser);
				}
				// 把用户信息放到session里面
				$_SESSION['name'] =$this->db->get_where('user', array('qqopenid'=>$qqopenid))->result_array();//把qq用户的信息放到session
				// 跳转到个人中心
				//$uid = $this->session->name[0]['uid'];
				header('location:' . site_url('home/account/qqlogin'));		
			} 
			/*
			 *微博login 
			 */
			public function weibologin(){
				require_once 'libweibo-master/libweibo-master/config.php';
				require_once 'libweibo-master/libweibo-master/saetv2.ex.class.php' ;
				$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
				$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
			}
			/*
			 *微博login callback
			 */
			public function weibo_login(){
				session_start();
				 require_once 'libweibo-master/libweibo-master/config.php';
				require_once 'libweibo-master/libweibo-master/saetv2.ex.class.php' ;
				$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
				$weibo = $o->home_timeline();
			}

			
			/*
			 * 签到
			 */
			public function sign(){
				// 第一步先获取当前时间戳和当前登陆的uid
				$sign_time = time();
				$uid = $this->session->name[0]['uid'];
				// 看数据库有没有签到记录,如果没有就开始第一天的签到
				$data['sign'] =$this->db->get_where('sign', array('uid' =>$uid))->result_array();
				if(!$data['sign']){
					$usersign = array('signtime'=>$sign_time,'uid'=>$uid,'islian'=>1);
					$this->db->insert('sign',$usersign);
					// 第一天签到给user表里的积分加1
					$integral =$this->db->get_where('user', array('uid'=>$uid))->result_array();
					$jifen = $integral[0]['integral']+1;
					$this->db->query("update user set integral='" . $jifen . "' where uid=$uid");
					// 第一天签到给user表的是否连续的字段加一
					$islian = $integral[0]['islian']+1;
					$this->db->query("update user set islian='" . $islian . "' where uid=$uid");
					$arr = array('aaa'=>'ddd');
					echo json_encode($arr);
				}else{
					// 如果不是第一天签到就看上一次签到是什么时候
					$sql="SELECT * FROM sign WHERE uid=$uid order by signtime desc limit 1";
					$data['last_time'] = $this->db->query($sql)->result_array();// 最后一次签到的时间				
					//$bbb = strtotime("2017-09-3 3:59:00");// 指定日期的时间戳
					$today = strtotime(date('Y-m-d'));// 当天的零时零分零秒
					if($data['last_time'][0]['signtime'] >$today ){// 昨天的签到日期
						//echo '今天已经签到过了';	
						$arr = array('aaa'=>'aaa');
						echo json_encode($arr);								
					}else{			
						//echo '今天还可以签到!';
						//$bbb = strtotime("2017-09-3 23:59:00");// 指定日期的时间戳
						//$aaa = strtotime("2017-09-6 1:00:00");// 指定日期的时间戳
						//echo ($aaa-$bbb)/86400;//1.8756	
						// 判断是不是超过两天没有签到
						if(time() - $data['last_time'][0]['signtime'] > 24*60*60){// 看看有没有超过一天没有签到
							//echo "没有连续签到!";
							// 不是连续登录的积分只能加1
							$usersign = array('signtime'=>$sign_time,'uid'=>$uid,'islian'=>0);
							$this->db->insert('sign',$usersign);
							$integral =$this->db->get_where('user', array('uid'=>$uid))->result_array();
							$jifen = $integral[0]['integral']+1;
							$this->db->query("update user set integral='" . $jifen . "' where uid=$uid");
							// 不是连续签到islian的值也要初始化
							$this->db->query("update user set islian='" . 1 . "' where uid=$uid");
							// 没有连续签到
							$arr = array('aaa'=>'bbb');
							echo json_encode($arr);	
						}else{// 如果是持续签到就在user表里添加积分
							//1. 先插入到数据库今天的签到记录
							//2.看user表的连续签到数值
							//3.积分等于连续签到天数乘1
							$usersign = array('signtime'=>$sign_time,'uid'=>$uid,'islian'=>1);// 今天的签到信息时间戳
							$this->db->insert('sign',$usersign);
							$integral =$this->db->get_where('user', array('uid'=>$uid))->result_array();
							$islian = $integral[0]['islian']+1;
							$this->db->query("update user set islian='" . $islian . "' where uid=$uid");// 更新数据库连续签到的天数
							$jifen = $integral[0]['integral']+$islian*1;// 现有的积分加上现在的签到天数获得新的积分
							$this->db->query("update user set integral='" . $jifen . "' where uid=$uid");
							//echo '签到完成!';
							// 连续签到
							$arr = array('aaa'=>'ccc');
							echo json_encode($arr);	
						}
					}
				}
			}	
	}
?>