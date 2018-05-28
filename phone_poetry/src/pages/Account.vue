<template>
  <div>
    <home-footer></home-footer>
    <fold></fold>
    <div style="height: 68px;"></div>
    <!--<div class="user_head">-->
    	<!--<div class="user_title">{{this.username[0]['name']}}</div>-->
    	<div class="user_right">
    		<a type="button" class="btn" data-placement="bottom" data-container="body" data-toggle="popover" data-content="退出登录">
					<i class="fa fa-hand-o-up"></i>
    		</a>
    	</div>
    <!--</div>-->
    <!--<div class="navbar-space"></div>-->
    <div class="mu_card">
    	<div class="user_avttar">
    		<div class="mu_avatar">
    			<img :src="'http://www.zhengzhiwei1.top/poetry/'+this.username[0]['img']" alt="之为诗词网">
    		</div>
    		<div class="title">{{this.username[0]['name']}}</div>
    		<div class="subtitle"><span ref="color_title"></span></div>
    	</div>
    	<div class="mu_list">
    		<div class="mu-sub-header">作品</div>
    		<a :href="'#/mypoetry'">
	    		<div class="list">
	    			<div class="mu-item-wrapper" tabindex="0" style="user-select: none; outline: none; cursor: pointer; -webkit-appearance: none;">
	    				<div class="" style="margin-left: 0px;">
	    					<div class="mu-ripple-wrapper"></div> 
	    					<div class="mu-item show-left has-avatar">
	    						<div class="mu-item-left">
	    							<div class="mu-avatar" style="background-color: rgb(33, 150, 243);">
	    								<div class="mu-avatar-inner"><i class="fa fa-file-o" style="position: relative;top: 5px;"></i></div>
	    							</div>
	    						</div> 
	    						<div class="mu-item-content">
	    							<div class="mu-item-title-row">
	    								<div class="mu-item-title">
	              			 我的文章
					         </div>
					         <div class="mu-item-after">
					         	<div class="mu-badge-container"> 
					         		<em class="mu-badge" ref="em1">1</em>
					         	</div>
					         </div>
									</div>
								</div>
									</div>
								</div>
							</div>
						</div>
					</a>
					<hr class="mu-divider inset">
					<a :href="'#/mylike'">
						<div class="list">
		    			<div class="mu-item-wrapper" tabindex="0" style="user-select: none; outline: none; cursor: pointer; -webkit-appearance: none;">
		    				<div class="" style="margin-left: 0px;">
		    					<div class="mu-ripple-wrapper"></div> 
		    					<div class="mu-item show-left has-avatar">
		    						<div class="mu-item-left">
		    							<div class="mu-avatar" style="background-color: rgb(156, 39, 176);">
		    								<div class="mu-avatar-inner"><i class="fa fa-heart-o" style="position: relative;top: 5px;"></i></div>
		    							</div>
		    						</div> 
		    						<div class="mu-item-content">
		    							<div class="mu-item-title-row">
		    								<div class="mu-item-title">
		              			 我的收藏
						         </div>
						         <div class="mu-item-after">
						         	<div class="mu-badge-container"> 
						         		<em class="mu-badge" ref="em2">2</em>
						         	</div>
						         </div>
										</div>
									</div>
									</div>
								</div>
							</div>
						</div>
					</a>
					<hr class="mu-divider inset">
					<div class="list">
    			<div class="mu-item-wrapper" tabindex="0" style="user-select: none; outline: none; cursor: pointer; -webkit-appearance: none;">
    				<div class="" style="margin-left: 0px;">
    					<div class="mu-ripple-wrapper"></div> 
    					<div class="mu-item show-left has-avatar">
    						<div class="mu-item-left">
    							<div class="mu-avatar" style="background-color: rgb(76, 175, 80);">
    								<div class="mu-avatar-inner"><i class="fa fa-file-text" style="position: relative;top: 5px;"></i></div>
    							</div>
    						</div> 
    						<div class="mu-item-content">
    							<div class="mu-item-title-row">
    								<div class="mu-item-title">
              			 我的资料
				         </div>
				         <div class="mu-item-after">
				         	<div class="mu-badge-container"> 
				         		<em class="mu-badge"></em>
				         	</div>
				         </div>
								</div>
							</div>
								</div>
							</div>
						</div>
					</div>
					<hr class="mu-divider inset">
					<div class="list">
    			<div class="mu-item-wrapper" tabindex="0" style="user-select: none; outline: none; cursor: pointer; -webkit-appearance: none;">
    				<div class="" style="margin-left: 0px;">
    					<div class="mu-ripple-wrapper"></div> 
    					<div class="mu-item show-left has-avatar">
    						<div class="mu-item-left">
    							<div class="mu-avatar" style="background-color: rgb(244, 67, 54);">
    								<div class="mu-avatar-inner"><i class="fa fa-text-height" style="position: relative;top: 5px;"></i></div>
    							</div>
    						</div> 
    						<div class="mu-item-content">
    							<div class="mu-item-title-row">
    								<div class="mu-item-title">
              			 撰写文章
				         </div>
				         <div class="mu-item-after">
				         	<div class="mu-badge-container"> 
				         		<em class="mu-badge"></em>
				         	</div>
				         </div>
								</div>
							</div>
								</div>
							</div>
						</div>
					</div>
					<hr class="mu-divider inset">
					<div class="list" @click="logout">
    			<div class="mu-item-wrapper" tabindex="0" style="user-select: none; outline: none; cursor: pointer; -webkit-appearance: none;">
    				<div class="" style="margin-left: 0px;">
    					<div class="mu-ripple-wrapper"></div> 
    					<div class="mu-item show-left has-avatar">
    						<div class="mu-item-left">
    							<div class="mu-avatar" style="background-color: rgb(255, 152, 0);">
    								<div class="mu-avatar-inner"><i class="fa fa-paper-plane" style="position: relative;top: 5px;"></i></div>
    							</div>
    						</div> 
    						<div class="mu-item-content">
    							<div class="mu-item-title-row">
    								<div class="mu-item-title">
              			 退出登录
				         </div>
				         <div class="mu-item-after">
				         	<div class="mu-badge-container"> 
				         		<em class="mu-badge"></em>
				         	</div>
				         </div>
								</div>
							</div>
								</div>
							</div>
						</div>
					</div>
					<div style="height: 46px;"></div>
				</div>
    </div>
  </div>
</template>

<script>
import HomeFooter from '../components/HomeFooter.vue';
import Fold from '../components/Fold.vue';
$(function () { $(".btn").popover({html : true });});
export default {
	data () {  
        return {
        	username:JSON.parse(sessionStorage.getItem("username"))
        }  
    }, 
  components: {
    HomeFooter,
    Fold
  },
  methods: {
		logout:function(){
			// 点击退出登录,删除session里的数据并返回到首页
			sessionStorage.removeItem('username');
			alert('您已退出登录!');
			this.$router.push({path: '/'});
		}
  },
  created:function(){
  	if(!JSON.parse(sessionStorage.getItem("username"))){
  		this.$router.push({path: '/login'});
  	}else{
	   this.$http.post('http://www.zhengzhiwei1.top/poetry/index.php/home/account/phone_poetry',{
			  uid:this.username[0]['uid']
			},{
			    emulateJSON:true
			}).then(function(res){
					sessionStorage.setItem("mypoetry",JSON.stringify(res.body.poetry));
					sessionStorage.setItem("mylike",JSON.stringify(res.body.like));
	        this.$refs.color_title.style.background=res.body.color;
	        this.$refs.color_title.innerText=res.body.grade;
	        this.$refs.em1.innerText = (res.body.poetry).length;
	        this.$refs.em2.innerText = (res.body.likeid).length;  
			},function(res){    
			});	
		}
  }
}
</script>

<style>
.user_head{
	height: 48px;
	position: fixed;
	background: #474A4F;
	color: #fff;
	box-shadow: 0 1px 6px rgba(0,0,0,.117647), 0 1px 4px rgba(0,0,0,.117647);
	padding: 0 8px;
	width: 100%;
	text-align: center;
	z-index: 12;
}
.user_title{
	font-size: 24px;
	height: 48px;
	line-height: 48px;
}
.content_top{
		position: fixed;
		top: 0;
		z-index: 10;
		width: 100%;
	}
.user_right{
	position: absolute;
	right: 10px;
	top: 15px;
}
.btn{
	padding: 0;
	width: 70px;
	outline: none;
	border: none;
	background: none;
}
.user_right i{
	font-size: 30px;
	color: #935A46;
}
.navbar-space {
	width: 100%;
	height: 48px;
}
.mu_card{
	background: #fff;
	position: relative;
  border-radius: 2px;
  box-shadow: 0 1px 6px rgba(0,0,0,.117647), 0 1px 4px rgba(0,0,0,.117647);
}
.user_avttar{
	position: relative;
	min-height: 260px;
	width: 100%;
	overflow: hidden;
}
.mu_avatar{
	width: 120px;
	height: 120px;
	text-align: center;
	margin:40px auto;
}
.mu_avatar>img{
	width: 100%;
	height: 100%;
	border-radius: 50%;

}
.user_avttar .title{
	text-align: center;
	font-size: 20px;
	color: cyan;
	font-weight: 600;
}
.user_avttar .subtitle{
	text-align: center;
}
.user_avttar .subtitle span{
	width: 100px;
	height: 30px;
	background: #CCCCCC;
	border-radius: 5px;
	display: block;
	margin: 0 auto;
	line-height: 30px;
	color: #fff;
	font-weight: 600;
}
.mu_list{
	padding: 8px 0;
	width: 100%;
	position: relative;
	overflow-x: hidden;
	overflow-y: visible;
	padding-bottom: 0;
}
.mu-sub-header{
	margin-top: -8px;
	color: #7E848C;
	font-size: 14px;
	line-height: 48px;
	padding-left: 16px;
	width: 100%;
}
.mu-item-wrapper {
	display: block;
	color: inherit;
	position: relative;
	outline: 0;
}
.mu-item{
	min-height: 56px;
	padding-left: 72px;
	color: #474A4F;
	padding: 16px;
	position: relative;
}
.mu-item-left{
	color: #757575;
	width: 40px;
	height: 100%;
	position: absolute;
	top: 0;
	left: 16px;
	max-height: 72px;
}
.mu-avatar{
		display: inline-block;
    height: 40px;
    width: 40px;
    font-size: 20px;
    color: #fff;
    background-color: #bdbdbd;
    text-align: center;
    border-radius: 50%;
}
.mu-icon{
	font-size: 24px;
}
.mu-item-content{
	width: 100%;
	align-self: center;
}
.mu-item-title-row{
	display: flex;
	-webkit-box-align: center;
	align-items: center;
	position: relative;
	width: 100%;
	line-height: 1;
}
.mu-item-title{
	flex: 1;
	font-size: 16px;
	display: block;
	max-width: 100%;
	padding-left: 72px;
}
.mu-item-after{
	color: #7E848C;
	display: flex;
	align-items: center;
}
.mu-badge-container{
	display: inline-block;
	position: relative;
}
.mu-badge{
	background: #bbbfc4;
	color: #fff;
	display: flex;
	align-items: center;
	padding: 0 6px;
	font-size: 12px;
	line-height: 1.5;
	border-radius: 3px;
	overflow: hidden;
}
.mu-divider{
	transform: scaleY(.5);
	margin: 0;	
	margin-left: 72px;
	height: 1px;
	border: none;
	background-color: rgba(0,0,0,.12);
	width: 100%;
}
</style>
