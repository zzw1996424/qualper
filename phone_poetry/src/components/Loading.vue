<template>
	<div class="loading">
		<div class="ccc">
			<i class="fa fa-spinner fa-spin"></i>
			<h3>页面加载中请稍后!</h3>
		</div>
	</div>
</template>

<script>
</script>

<style>
	.loading{
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #C7C7C8;
		z-index: 14;
	}
	.ccc{
		width: 300px;
		height: 200px;
		position: absolute;
		left: 50%;
		top: 50%;
		margin-left: -150px;
		margin-top: -100px;
		text-align: center;
	}
	.ccc>i{
		font-size: 35px;
		color: #fff;
	}
	.ccc>h3{
		color: #fff;
		margin-top: 30px;
		font-size: 26px;
	}
</style>