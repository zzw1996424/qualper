<template>
	<div class="content11">
		<fold></fold>
		<div style="height: 68px;"></div>
			<div class="container">
				<div class="col">
					<div class="login_section">
						<div class="rg_form">
							<div class="rg_head">
								<h4>欢迎注册之为诗词网</h4>
							</div>
							<div class="rg_body">
								<form action="http://www.zhengzhiwei1.top/poetry/index.php/login/register_data" method="post" id="myform">
									<div class="email">
										<i class="you"><img src="http://www.zhengzhiwei1.top/poetry/img/email.png"/></i>
										<input type="text" class="input_email" placeholder="邮箱" name="email"/>
									</div>
									<div class="password">
										<i class="pas"><img src="http://www.zhengzhiwei1.top/poetry/img/email.png"/></i>
										<input type="text" class="input_name" placeholder="用户名" name="username"/>
									</div>
									<div class="img"> 
										<i class="pas"><img src="http://www.zhengzhiwei1.top/poetry/img/pass.png"/></i>
						                <input id='cap' name="captcha" type="text" class="img_input auth" placeholder="图片验证码"/>
						                <input id='cap2' type='hidden' ref="code_num" value=''/><!--生成验证码时保存在SESSION中的值-->
							            <a id='code' v-html="code" ref="code" @click="codeclick">{{code}}</a>  
							        </div>
									<div class="password">
										<i class="pas"><img src="http://www.zhengzhiwei1.top/poetry/img/pass.png"/></i>
										<input type="password" class="input_password" placeholder="密码" name="password"/>
									</div>
									<div class="password">
										<i class="pas"><img src="http://www.zhengzhiwei1.top/poetry/img/pass.png"/></i>
										<input type="password" class="input_password2" placeholder="确认密码"/>
									</div>
									<p class="error" style="color: red;"></p>
									<div class="action">
										<a :href="'#/login/'">去登陆</a>
										<p class="left">已有账号?</p>										
										<input type="button" class="btn" value="注册"/>
									</div>	
								</form>
								<hr />
							</div>
							<div class="rg_foot">
								<div class="one_row">
									<span class="span_item"><a href="">使用第三方平台账号登录</a></span>
									<div class="social-login">
										<span class="span_item">联合登录</span>
										<span class="span_item"><i><a href="http://www.zhengzhiwei1.top/poetry/index.php/home/qqlogin"><img src="http://www.zhengzhiwei1.top/poetry/img/qq.png"/></a></i></span>
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
            	code:''
            }
            
      	},
	 	components:{
		   Fold
		},
		methods: {
			codeclick:function(){
				this.$http.post('http://www.zhengzhiwei1.top/poetry/index.php/login/regist/phone_register',{
			  
				},{
				    emulateJSON:true
				}).then(function(res){
						this.code = res.body[0];
						this.$refs.code_num.value=res.body[1];
				},function(res){    
				});
			}
		},
		created:function(){
		 	this.$http.post('http://www.zhengzhiwei1.top/poetry/index.php/login/regist/phone_register',{
			  
			},{
			    emulateJSON:true
			}).then(function(res){
					this.code = res.body[0];
					this.$refs.code_num.value=res.body[1];
			},function(res){    
			});
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
.content11 .container .col {
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
.content11 .login_section {
  margin: 20px 0;
  background-color: #fff;
  box-shadow: 0 0 4px #ddd;
}

.content11 .login_section .rg_form {
  padding: 20px;
}

.content11 .login_section .rg_form .rg_head {
  color: #555;
  border-bottom: 1px dashed #ddd;
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: center;
}

.content11 .login_section .rg_form .email, .content11 .login_section .rg_form .password, .content11 .login_section .rg_form .img {
  position: relative;
  margin-top: 20px;
  margin-bottom: 20px;
  width: 100%;
  height: 40px;
}

.content11 .login_section .rg_form .email i, .content11 .login_section .rg_form .password i, .content11 .login_section .rg_form .img i {
  font-size: 14px;
  position: absolute;
  top: 50%;
  left: 12px;
  margin-top: -8px;
  color: #aaa;
}

.content11 .login_section .rg_form .email input, .content11 .login_section .rg_form .password input, .content11 .login_section .rg_form .img input {
  width: 100%;
  height: 40px;
  padding: 5px 10px 5px 36px;
  background-color: #F0F0F0;
  font-size: 14px;
  border: 0;
  outline: 0;
  transition: all .3s ease-in-out;
}

.content11 .login_section .rg_form .email input:focus, .content11 .login_section .rg_form .password input:focus, .content11 .login_section .rg_form .img input:focus {
  box-shadow: 0 0 4px #935A46;
}

.content11 .login_section .rg_form .img input {
  width: 60%;
  float: left;
}

.content11 .login_section .rg_form .img a {
  float: right;
  display: block;
  width: 150px;
  height: 40px;
}

.content11 .login_section .rg_form .img a img {
  width: 150px;
  height: 40px;
}

.content11 .login_section .rg_form .action {
  position: relative;
  margin-top: 20px;
  margin-bottom: 20px;
  width: 100%;
  height: 40px;
  overflow: hidden;
  font-size: 14px;
}
.content11 .login_section .rg_form .action>a{
	color: #935A46;
	font-weight: 500;
}
.content11 .login_section .rg_form .action .left {
  float: left;
}

.content11 .login_section .rg_form .action .error {
  margin-left: 10px;
  color: #FF3239;
  transition: all .3s ease-in-out;
  float: left;
}

.content11 .login_section .rg_form .action input {
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

.content11 .login_section .rg_form .action input:hover {
  background: #935A46;
  color: #fff;
}

.content11 .login_section .rg_form .rg_foot {
  margin: 10px 0;
}

.content11 .login_section .rg_form .rg_foot .span_item {
  margin-right: 10px;
}

.content11 .login_section .rg_form .rg_foot .social-login .span_item {
  margin-right: 10px;
}

.content11 .login_section .rg_form .rg_foot .social-login .span_item i {
  display: inline-block;
  opacity: 1;
  margin: 0 .25rem 0 0;
  width: 1.18em;
  height: 1em;
}

.content11 .login_section hr {
  margin: 20px 0;
  height: 1px;
  border: 0;
  width: 100%;
  background: #E6EAED;
}
#code{
	width: 30%;
	float: left;
	overflow: auto;
	margin-left: 15px;
}
</style>