<template>
	<div class="fold">
		<div class="content_top">
			<i class="fa fa-bars zhe" @click="slider"></i>
			<img src="http://www.zhengzhiwei1.top/poetry/img/logo.png"/>
		</div>
		<div class="mm_menu" ref="isactive">
			<div class="mm_head">
				<a href="">
					<img src="http://www.zhengzhiwei1.top/poetry/img/logo.png"/>
					之为社区
				</a>
			</div>
			<ul>
				<li ref="isactive1"><a :href="'#/shi'">
					<span></span>诗
				</a></li>
				<li ref="isactive2"><a :href="'#/ci'">
					<span></span>词
				</a></li>
				<li ref="isactive3"><a :href="'#/fu'">
					<span></span>赋
				</a></li>
				<li ref="isactive4"><a :href="'#'">
					<span></span>首页
				</a></li>
			</ul>
		</div>
		<div class="mm-menu-mask" ref="isactive5" @click="slider1"></div>
	</div>
</template>

<script>
	export default { 
		methods:{
            slider:function(){
             	 this.$refs.isactive.style.transform="translateX(0px)";
             	 this.$refs.isactive1.style.transform="translateX(0px)";
             	 this.$refs.isactive2.style.transform="translateX(0px)";
             	 this.$refs.isactive3.style.transform="translateX(0px)";
             	 this.$refs.isactive4.style.transform="translateX(0px)";
             	 this.$refs.isactive5.style.transform="translateX(200px)";
             	 this.$refs.isactive5.style.display="block";
             	 this.$refs.isactive5.style.opacity="1";
             	 this.$refs.isactive5.style.visibility="visible";
             	 this.$emit('slider') ; 
            },
            slider1:function(){
            	this.$refs.isactive.style.transform="translateX(-200px)";
             	 this.$refs.isactive1.style.transform="translateX(-200px)";
             	 this.$refs.isactive2.style.transform="translateX(-200px)";
             	 this.$refs.isactive3.style.transform="translateX(-200px)";
             	 this.$refs.isactive4.style.transform="translateX(-200px)";
             	  this.$refs.isactive5.style.transform="translateX(0px)";
             	 this.$refs.isactive5.style.opacity="0";
             	  this.$refs.isactive5.style.visibility="visible";
             	  this.$refs.isactive5.style.display="none";
            }
	}
}
</script>

<style scoped>
	.content_top{
	text-align: center;
	 box-shadow: 0 0 4px #ddd;
	 background: #fff;
	 position: fixed;
	 top: 0;
	 left: 0;
	 right: 0;
}
.content_top img{
	height: 68px;
	margin: 0 auto;
}
	.mm_menu{
	width: 200px;
	box-shadow: 0 2px 8px rgba(0,0,0,.2);
	transform: translateX(-200px);
	position: fixed;
	top: 0;
	left: 0;
	z-index: 10;
	height: 100%;
	transition: transform .5s,box-shadow .5s;
	background: #fff;
}
.mm_head{
	background: #e6e3d0;
	padding: 14px 0 !important;
	text-align: center;
	box-sizing: border-box;
}
.mm_head>a{
	font-size: 16px;
	color: #fff;
	font-weight: 700;
}
.mm_head img{
	display: inline-block;
	width: 52px;
	height: 52px;
	position: relative;
	top: -5px;
}
.mm_menu li{
	height: 44px;
	text-align: center;
	border-bottom: 1px dashed #eee;
	line-height: 40px;
	transition: opacity .5s .1s,transform .5s .1s;
	display: block;
	width: 100%;
	transform: translateX(-50%);
}
.mm_menu li a{
	display: block;
	position: relative;
	overflow: hidden;
	margin: 4px 0;
	color: #727272;
	font-size: 16px;
	transition: background .5s,color .5s;
}
.mm_menu li:nth-child(2){
	transition: opacity .5s .1s,transform .5s .2s;
}
.mm_menu li:nth-child(3){
	transition: opacity .5s .1s,transform .5s .3s;
}
.mm_menu li:nth-child(4){
	transition: opacity .5s .1s,transform .5s .4s;
}
.mm-menu-mask.active {
    visibility: visible;
    opacity: 1;
}
.mm-menu-mask {
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 8;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,.8);
    visibility: hidden;
    opacity: 0;
    -webkit-transition: opacity .5s,visibility .5s;
    transition: opacity .5s,visibility .5s;}
.zhe{
	float: left;
	font-size: 30px;
	color: #935A46;
	position: absolute;
    top: 20px;
    left: 25px;
}
</style>