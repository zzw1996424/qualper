<!-- List.vue -->  
<template>  
    <div class="item">
    	<div class="card_head">
    		<div class="card_avatar">
    			<!--<img src="../../../img/floor12.jpg"/>-->
    			<img :src="'http://www.zhengzhiwei1.top/poetry/'+img" alt="">
    		</div>
    		<div class="head_title">
    			<router-link class="card_name" to="/community">{{author}}</router-link>
    			<div class="card_time">{{time}}</div>
    		</div>
    	</div>
    	<a :href="'#/article/'+poetry_num">
    		<div class="card_title">{{title}}</div>
    		<div class="card_content">{{content}}</div>
    	</a>
   		<div class="card_action">
   			<button class="small">
   				<div class="wrapper">
   					<i class="fa fa-heart-o"></i>
   					<span class="likei">喜欢</span> <span class="likenum"></span>
   				</div>
   			</button>
   			<a href="" class="comment">
   				<i class="fa fa-folder-o"></i>
   				<span class="likei">评论</span>
   			</a>
   		</div>
    </div>
</template>  
  
<style scoped>  
    .item{
    	box-sizing: border-box;
    	box-shadow: 0 1px 6px rgba(0,0,0,.117647), 0 1px 4px rgba(0,0,0,.117647);
    }
    .card_head{
    	padding: 16px;
    	font-weight: 500;
    	position: relative;
    	white-space: normal;
    }
    .card_avatar{
    	margin-right: 16px;
    	color: #fff;
    	background: #DBDBDB;
    	display: inline-block;
    	height: 40px;
    	width: 40px;
    	font-size: 20px;
    	text-align: center;
    	border-radius: 50%;
    }
    .card_avatar img{
    	border-radius: 50%;
    	width: 100%;
    	height: 100%;
    	display: block;
    }
    .head_title{
    	display: inline-block;
    	vertical-align: top;
    	white-space: normal;
    	padding-right: 90px;
    }
    .card_name{
    	color: rgba(71,74,79,.87);
    	font-size:15px;
    }
    .card_time{
    	font-size: 14px;
    	color: rgba(71,74,79,.54);
    }
    .card_title{
    	padding: 16px;
    	position: relative;
    	font-size: 20px;
    	color: rgba(71,74,79,.87);
    }
    .card_content{
    	color: #474A4F;
    	padding: 16px;
    	font-size: 14px;
    	height: 60px;
    	overflow: hidden;
    }
    .card_action{
    	padding: 8px;
    	position: relative;
    }
    .small{
    	display: inline-block;
    	overflow: hidden;
    	position: relative;
    	border-radius: 2px;
    	height: 36px;
    	line-height: 36px;
    	min-width: 88px;
    	border: none;
    	background: none;
    }
    .small i{
    	color: #935A46;
    }
    .likei{
    	font-family: 'kaiti';
    	font-size: 14px;
    }
</style>  
  
<script>  
    export default {  
        // 接收父组件传过来的以下几个属性  
        props: ['img','author','time','title','content','img','poetry_num'],  
    } 
</script>  