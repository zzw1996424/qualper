<template>
	<div class="acontent" style="margin-bottom: 48px;">
		<div class="content_top">
			<div class="top1">
				<div class="top_left" @click="laststep">
					<i class="fa fa-chevron-left"></i>
				</div>
				<div class="top_title">
					<span>{{details['title']}}</span>
				</div>
				<!--<div class="top_right">
					<i class="fa fa-list-ul"></i>
				</div>-->
			</div>
		</div>
		<div class="middle">
			<div class="middle1">
				<div class="mid_title" ref="poetrytitle">{{details['title']}}</div>
				<div class="titme">{{details['time']}}</div>
				<div class="author">
					<img src="https://o.ruogoo.cn/upload/e03431287b278d97c3f69b711cb1fbd5.jpg" class="article-pic" alt="https://o.ruogoo.cn/upload/e03431287b278d97c3f69b711cb1fbd5.jpg">
					<span class="author_name" ref="author">{{details['author']}}</span>
				</div>
			</div>
			<div class="middle2">
				<p>{{details['content']}}</p>
				<p class="middle2_img">
					<img :src="'http://www.zhengzhiwei1.top/poetry/'+details['img']"  class="article-pic" alt="之为">
				</p>
			</div>
		</div>
		<div class="comment_list">
			<div class="sub_head" v-if="this.comment1.length>0">
				文章评论
			</div>
			<div class="sub_list" v-for="site in comment1">
				<div class="mu_item">
					<div class="mu_left">
						<img :src="'http://www.zhengzhiwei1.top/poetry/'+site['comment_img']"  class="article-pic" alt="之为">
					</div>
					<div class="mu_right">
						<span class="mu_span1">{{site['comment_name']}}</span>
						<span class="mu_span2">{{site['comment_content']}}</span>
						<span class="mu_span3">{{site['comment_time']}}</span>
					</div>
				</div>
			</div>
			<div class="no_comment" v-if="this.comment1.length==0">
				<yd-button @click.native="show1 = true">还没有评论呢，快来给作者留一个好评吧</yd-button>
			</div>
		</div>
		<div class="article_footer">
			<input type="hidden" name="" id="" value="" />
			<button class="like" @click="like"><i class="fa fa-heart-o" ref="islike"></i></button>
			<yd-button  @click.native="show1 = true" class="comment"><i class="fa fa-folder-o"></i></yd-button>
		</div>
		<!--弹出框-->
		<loading v-show="loading"></loading>
		<!--评论框-->
		<yd-popup v-model="show1" position="center" width="90%">
		<div class="comtent">
			<div class="mu_dialog">
				<h3>评论</h3>
				<div class="mu_coment">
					<div class="mu_coment2">
						<div class="mu_coment3">
							<!--<div class="mu-text-field-hint show">
							  输入要评论的内容
							</div>-->
							<textarea name="" rows="" cols="" placeholder="输入要评论的内容!" ref="text1"></textarea>
							<div><hr class="mu-text-field-line"> <hr class="mu-text-field-focus-line"></div>
						</div>
					</div>
				</div>
				<div class="mu-dialog-actions" @click="commentl" >
					<yd-button @click.native="show1 = false" class="mu-flat-button mu-flat-button-primary">评论</yd-button>
				</div>
			</div>
		</div>
		</yd-popup>
	</div>
</template>

<script>
	import Loading from '../components/Loading.vue';
	function CurentTime(){ 
        var now = new Date();
        var year = now.getFullYear();       //年
        var month = now.getMonth() + 1;     //月
        var day = now.getDate();            //日  
        var hh = now.getHours();            //时
        var mm = now.getMinutes();          //分
        var clock = year + "-";
        if(month < 10)
            clock += "0";
        clock += month + "-";
        if(day < 10)
            clock += "0";           
        clock += day + " ";	       
        if(hh < 10)
            clock += "0";	           
        clock += hh + ":";
        if (mm < 10) clock += '0'; 
        clock += mm; 
        return(clock); 
   }
	export default { 
		data () {  
            return {  
              details:[],
              comment1:[],
              loading:true,
              show1: false
            }  
        }, 
        components:{
		   Loading
		},
        methods:{
            laststep:function(){
             window.history.back();  
            },
            like:function(){
            	// 先判断有没有登录,如果没有登录就要先登录,若果登录就或许需要的数据
            	if(!JSON.parse(sessionStorage.getItem("username"))){
            		alert('请先登录!');
			  		this.$router.push({path: '/login'});
			  	}else{
					this.$http.post('http://www.zhengzhiwei1.top/poetry/index.php/home/collect',{
		                poetryid:this.$route.params.id,
		                userid:JSON.parse(sessionStorage.getItem("username"))[0].uid,
		                poetryname: this.$refs.author.innerText,
		                poetrytitle:this.$refs.poetrytitle.innerText
		            },{
		                emulateJSON:true
		            }).then(function(res){
		            	console.log(res.body[0]);
		            	if(res.body[0]=='aaa'){
		            		// 如果是aaa就代表已经收藏过了
		            		this.$dialog.loading.open('您已收藏过');
			                setTimeout(() => {
			                    this.$dialog.loading.close();
			                }, 1000);
			                this.$refs.islike.style.color="red";			              
		            	}else{
		            		this.$dialog.loading.open('收藏成功!');
			                setTimeout(() => {
			                    this.$dialog.loading.close();
			                }, 1000);
		            		this.$refs.islike.style.color="red";	
		            	}
		            },function(res){
		               
		            });
			  	}
            },
            commentl:function(){
				this.$http.post('http://www.zhengzhiwei1.top/poetry/index.php/home/comment',{
	                poetryid:this.$route.params.id,
					userid:JSON.parse(sessionStorage.getItem("username"))[0].uid,
					comment_content:this.$refs.text1.value,
					poetrytitle:this.$refs.poetrytitle.innerText,
					comment_time:CurentTime(),
					comment_img:JSON.parse(sessionStorage.getItem("username"))[0].img,
					comment_name: JSON.parse(sessionStorage.getItem("username"))[0].name             
	            },{
	                emulateJSON:true
	            }).then(function(res){
	               this.$router.go(0);// 刷新页面
	            },function(res){
	               
	            });
				
				
            }
            
        },
        created:function(){
        	this.$http.post('http://www.zhengzhiwei1.top/poetry/index.php/home/article/phone_article',{
	                a:this.$route.params.id	                
	            },{
	                emulateJSON:true
	            }).then(function(res){
	               this.details = res.body.details[0];
	               this.comment1 = res.body.comment;
	               this.loading = false;
	               
	               console.log(JSON.parse(sessionStorage.getItem("username")));
	               
	               
	               
	            },function(res){
	               
	            });
        }
	
	
	
	
	}
</script>

<style scoped>
	.content_top{
		height: 48px;
		position: fixed;
		background: #474A4F;
		color: #fff;
		box-shadow: 0 1px 6px rgba(0,0,0,.117647), 0 1px 4px rgba(0,0,0,.1176);
		width: 100%;
		padding: 0 8px;
		overflow: hidden;
		z-index: 11;
		box-sizing: border-box;
	}
	.content_top .top1{
		overflow: hidden;
		text-align: center;
	}
	.top1 .top_left,.top_right{
		float: left;
		width: 48px;
		height: 48px;
		font-size: 18px;
		padding: 12px;
		box-sizing: border-box;
		
	}
	.top_right{
		float: right;
		font-size: 25px;
		padding: 0;
		padding-top: 15px;
		padding-top: 5px;
		position: relative;
		right: -5px;
	}
	.top_title{
		float: left;
		font-size: 20px;
		font-weight: 400;
		line-height: 48px;
	}
	.author{
		margin-top: 20px;
	}
	.author>img{
		width: 32px;
		height: 32px;
		color: #fff;
		border-radius: 50%;
		text-align: center;
		display: inline-block;
	}
	.author .author_name{
		color: #474A4F;
		font-size: 16px;
		display: inline-block;
		position: relative;
		top: 3px;
	}
	.middle{
		padding-top: 48px;
		background: #fff;
		position: relative;
		border-radius: 2px;
		box-shadow: 0 1px 6px rgba(0,0,0,.117647), 0 1px 4px rgba(0,0,0,.117647);
		box-sizing: border-box;
	}
	.middle1{
		background: #F5F5F5;
		padding: 15px;
		position: relative;
	}
	.mid_title{
		color: rgba(71,74,79,.87);
		font-size: 20px;
		line-height: 36px;
	}
	.time{
		color: rgba(71,74,79,.54);
		font-size: 14px;
		display: block;
	}
	.middle2{
		background: #fff;
		padding: 10px;
		font-size: 14px;
		color: #474A4F;
	}
	.middle2 p{
		line-height: 2;
		margin-top: 5px;
	}
	.middle2 p img{
		width: 100%;
		height: 100%;
	}
	.comment_list .sub_head{
		color: #7e848c;
		font-size: 14px;
		line-height: 48px;
		padding-left: 16px;
		width: 100%;
		box-sizing: border-box;
	}
	.no_comment{
		padding: 8px 16px;
		width: 100%;
		box-sizing: border-box;
		margin-top: 20px;
	}
	.no_comment>button{
		background: #fff;
		color: #474A4F;
		width: 100%;
		border-radius: 2px;
		height: 36px;
		line-height: 36px;
		border: none;
		outline: none;
		min-width: 88px;
		box-shadow: 0 1px 6px rgba(0,0,0,.117647), 0 1px 4px rgba(0,0,0,.117647);
	}
	.article_footer{
		position: fixed;
		bottom: 0;
		text-align: center;
		background: #474A4F;
		width: 100%;
		height: 48px;
		line-height: 48px;
	}
	.article_footer>button{
		background: none;
		border: none;
		outline: none;
		width: 40%;
		margin-top: 13px;
	}
	.article_footer>button>i{
		font-size: 24px;
		color: #935A46;
		font-weight: 600;
	}
	.sub_list{
		padding: 8px 0;
		width: 100%;
		position: relative;
		overflow: hidden;
		border-bottom: 1px dashed #ccc;
	}
	.mu_item{
		min-height: 56px;
		padding-left: 72px;
		color: #474A4F;
		padding: 16px;
		overflow: hidden;
	}
	.mu_left{
		float: left;
		width: 40px;
		position: absolute;
		left: 16px;
		height: 40px;
	}
	.mu_left img{
		width: 40px;
		height: 40px;
		border-radius: 50%;
		text-align: center;
	}
	.mu_right{
		padding-left: 72px;
		width: 100%;
	}
	.mu_right>span{
		display:block;
	}
	.mu_span1{
		color: cyan;
	}
	.mu_span2{
		color: #7e848c;
	}
	.comtent{
		position: fixed;
		left: 0;
		top: 0;
		right: 0;
		bottom: 0;
		background: rgba(0,0,0,.4);
		z-index: 18;
	}
	.mu_dialog{
		background: #fff;
		width: 75%;
		max-width: 768px;
		min-height: 222px;
		border-radius: 2px;
		font-size: 16px;
		box-shadow: 0 19px 60px rgba(0,0,0,.298039), 0 15px 20px rgba(0,0,0,.219608);
		margin: 0 auto;
		position: relative;
		top: 50%;
		margin-top: -111px;
	}
	.mu_dialog>h3{
		color: #474A4F;
		padding: 24px 24px 20px;
		font-size: 20px;
		font-weight: 400;
		line-height: 32px;
	}
	.mu_coment{
		padding: 0 24px;	
	}
	.mu_coment2{
		width: 100%;
		font-size: 16px;
		min-height: 48px;
		display: inline-block;
		position: relative;
		margin-bottom: 8px;
	}
	.mu_coment3{
		padding-bottom: 4px;
		display: block;
		height: 100%;
		padding-top: 4px;
	}
	.mu-text-field-hint{
		line-height: 1.5;
		opacity: 1;
		color: #d3d6db;
		position: absolute;
	}
	.mu_coment3 textarea{
		outline: none;
		border: none;
		width: 100%;
		color: #474A4F;
		height: 70px;
	}
	.mu-dialog-actions{
		min-height: 48px;
		padding: 8px;
		display: flex;
		-webkit-box-align: center;
		align-items: center;
		justify-content: flex-end;
	}
	.mu-flat-button{
		display: inline-block;
		overflow: hidden;
		position: relative;
		border-radius: 2px;
		height: 36px;
		line-height: 36px;
		min-width: 88px;
		outline: none;
		color: #FF5252;
		font-size: 16px;
		background: none;
		border: none;
	}
	.mu-text-field-line{
		background-color: #edeff2;
		border: none;
		height: 1px;
		
	}
</style>