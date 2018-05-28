<template>
	
	<div class="content1">
		<fold></fold>
		<div style="height: 68px;"></div>
		<div class="container">
			<div class="col">
				<div class="login_section">
					<div class="rg_form">
						<div class="rg_head">
							<h4>欢迎登录之为诗词网</h4>
						</div>
						<div class="rg_body">
							<form action="http://www.zhengzhiwei1.top/poetry/index.php/home/account" method="post" id="myform">
								<div class="email">
									<i class="you"><img src="http://www.zhengzhiwei1.top/poetry/img/email.png"/></i>
									<input type="text" class="input_email" placeholder="邮箱" @blur="ajax1" ref="input1"/>
								</div>
								<div class="password">
									<i class="pas"><img src="http://www.zhengzhiwei1.top/poetry/img/pass.png"/></i>
									<input type="password" class="input_password" placeholder="密码" ref="input2"/>
								</div>
								<p class="error" style="color: red;" ref="error"></p>
								<div class="action">
									<p class="left"><a href="">忘记密码?</a></p>								
									<input type="button" class="btn" value="登录" @click="ajax2"/>
								</div>
								
							</form>
							<hr />
						</div>
						<div class="rg_foot">
							<div class="one_row">
								没有账号?
								<span class="span_item"><a :href="'#/register/'">注册一下吧</a></span>
								<div class="social-login">
									<span class="span_item">联合登录</span>
									<span class="span_item"><i><a href="<?php echo site_url('home/qqlogin')?>"><img src="http://www.zhengzhiwei1.top/poetry/img/qq.png"/></a></i></span>
									<span class="span_item"><i><a href="https://api.weibo.com/2/users/show.json"><img src="http://www.zhengzhiwei1.top/poetry/img/weibo.png"/></a></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Fold from '../components/Fold.vue';
	export default { 
		data () {  
            return {
            	password1:'' 	
            }
            
       },
        methods:{
            ajax1:function(){
            	// 获取input的内容
            	var input1 =  this.$refs.input1.value;
            	this.$http.post('http://www.zhengzhiwei1.top/poetry/index.php/login/email',{
	               email:input1
	            },{
	                emulateJSON:true
	            }).then(function(res){
	              if(res.body[0]=='bbb'){
	              	this.$refs.error.innerText="请输入正确账户!";
	              }else{
	              	this.password1=res.body[0];  
	              	sessionStorage.setItem("username",JSON.stringify(res.body[2]));
	              }
	            },function(res){
	               
	            });
            },
            ajax2:function(){
            	// 获取input的内容
            	var input2 = this.$refs.input2.value;
            	if(md5(input2)!=this.password1){
            		this.$refs.error.innerText="请输入正确密码!";
            	}else{
//          		var username = sessionStorage.getItem("username");
//          		console.log(JSON.parse(username));
					// 登录成功后跳转到个人中心页面
					this.$router.push({ path: '/account' });
            	}
            }
        },
        created:function(){
        	
        },
        components:{
		   Fold
		}
	
	
	
	
	}	
</script>
	
<style scoped>
	body,html{
		font-family: 'kaiti'!important;
	}
	input{
		font-family: 'kaiti'!important;
	}
	.one_row{
		font-size: 16px;
	}
	.span_item>a{
		color: #935A46;
		font-weight: 600;
	}
.content11 .container {
  max-width: 1200px;
  margin: 0 auto;
  line-height: 2;
  overflow: hidden;
  background: #f7f7f7;
}
body{
	background: #F7F7F7;
}
.content1 .container .col {
  width: 100%;
  padding: 0 18px;
  float: left;
}
.rg_head>h4{
	font-size: 22px;
}
.left>a{
	font-size: 16px;
	color: #935A46;
	font-weight: 600;
}
.content1 .login_section {
  margin: 20px 0;
  background-color: #fff;
  box-shadow: 0 0 4px #ddd;
}

.content1 .login_section .rg_form {
  padding: 20px;
}

.content1 .login_section .rg_form .rg_head {
  color: #555;
  border-bottom: 1px dashed #ddd;
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: center;
}

.content1 .login_section .rg_form .email, .content1 .login_section .rg_form .password, .content1 .login_section .rg_form .img {
  position: relative;
  margin-top: 20px;
  margin-bottom: 20px;
  width: 100%;
  height: 40px;
}

.content1 .login_section .rg_form .email i, .content1 .login_section .rg_form .password i, .content1 .login_section .rg_form .img i {
  font-size: 14px;
  position: absolute;
  top: 50%;
  left: 12px;
  margin-top: -8px;
  color: #aaa;
}

.content1 .login_section .rg_form .email input, .content1 .login_section .rg_form .password input, .content1 .login_section .rg_form .img input {
  width: 100%;
  height: 40px;
  padding: 5px 10px 5px 36px;
  background-color: #F0F0F0;
  font-size: 14px;
  border: 0;
  outline: 0;
  transition: all .3s ease-in-out;
}

.content1 .login_section .rg_form .email input:focus, .content1 .login_section .rg_form .password input:focus, .content1 .login_section .rg_form .img input:focus {
  box-shadow: 0 0 4px #935A46;
}

.content1 .login_section .rg_form .img input {
  width: 60%;
  float: left;
}

.content1 .login_section .rg_form .img a {
  float: right;
  display: block;
  width: 150px;
  height: 40px;
}

.content1 .login_section .rg_form .img a img {
  width: 150px;
  height: 40px;
}

.content1 .login_section .rg_form .action {
  position: relative;
  margin-top: 20px;
  margin-bottom: 20px;
  width: 100%;
  height: 40px;
  overflow: hidden;
}

.content1 .login_section .rg_form .action .left {
  float: left;
}

.content1 .login_section .rg_form .action .error {
  margin-left: 10px;
  color: #FF3239;
  transition: all .3s ease-in-out;
  float: left;
}

.content1 .login_section .rg_form .action input {
  float: right;
  font-size: 14px;
  padding: 8px 16px;
  color: #935A46;
  background-color: #fff;
  border-radius: 2px;
  border: 2px solid #935A46;
  line-height: 1;
  display: inline-block;
  cursor: pointer;
  transition: all .3s ease-in-out;
}

.content1 .login_section .rg_form .action input:hover {
  background: #935A46;
  color: #fff;
}

.content1 .login_section .rg_form .rg_foot {
  margin: 10px 0;
}

.content1 .login_section .rg_form .rg_foot .span_item {
  margin-right: 10px;
}
.content1 .login_section .rg_form .rg_foot .social-login {
	margin-bottom: 15px;
}
.content1 .login_section .rg_form .rg_foot .social-login {
  margin-top: 10px;
}

.content1 .login_section .rg_form .rg_foot .social-login .span_item i {
  display: inline-block;
  opacity: 1;
  margin: 0 .25rem 0 0;
  width: 1.18em;
  height: 1em;
}

.content1 .login_section hr {
  margin: 20px 0;
  height: 1px;
  border: 0;
  width: 100%;
  background: #E6EAED;
}

</style>