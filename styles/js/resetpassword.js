$(function(){
	/*
	 * 点击发送邮件
	 */
	$('.btn').click(function(){
		var email = $('.input_email').val();// 获取输入的邮箱
		$.ajax({
			type:"post",
			url:$("#local").val() + "/login/email",
			async:true,
			dataType:'json',
        	data:{'email':email},
        	success:function(response){
        		if(response[1]=='aaa'){
        			// 有这个邮箱
        			$('#resetpassword').submit();
        		}else{
        			$('.error').html('请输入正确邮箱!');
        		}
        	}
		});
	});
	/*
	 * 点击修改密码
	 */
	$('.btn2').click(function(){
		var pas1 = $('.password1').val();
		var pas2 = $('.password2').val();
		if(pas1!=pas2||pas1==''||pas2==''){
			$('.error').html('两次密码不一致!');
		}else{
			$('#resetpassword3').submit();
		}
	})
	
	
	
})
