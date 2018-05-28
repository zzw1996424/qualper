<!--Goup.vue-->
<template>
	<div class="top">
		<i class="fa fa-plane"></i>
	</div>
</template>

<script>
	window.onscroll=function(){						
		var num = $(window).scrollTop();
		if(num>500){
			$('.top').css('display','block');
		}else{
			$('.top').css('display','none');
		}
		$('.top').click(function(){
			var t = setInterval(function(){
				if(num>=0){
					num-=35;
					$(window).scrollTop(num);
				}else{
					clearInterval(t);
				}
			},1)
		})
	}
	
	
	
</script>

<style scoped>
	.top{
		position: fixed;
		width: 40px;
		height: 40px;
		border-radius: 50%;
		right: 15px;
		bottom: 50px;
		background: #474A4F;
		color: #fff;
		text-align: center;
		line-height: 45px;
	}
	.top>i{
		font-size: 20px;
		font-weight: 400;
		transform: rotate(-45deg);
		position: relative;
		left: 1px;
		top: 1px;
	}
</style>