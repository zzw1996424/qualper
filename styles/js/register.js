$(function(){
	/*
	 * 点击获取图片验证码
	 */
	$('#code').click(function(){
		$.ajax({
			type:"post",
			url:$("#local").val() + "/login/register",
			dataType:'json',
			async:true,
			success:function(response){
				$('#code').html(response.captcha);
              	$('#cap2').val(response.word);
              	console.log(response.captcha);
			}
		});
	})
	/*
	 * 邮箱失去焦点的时候判断邮箱格式对不对以及发起ajax判断有没有这个账号
	 */
	$('.input_email').blur(function(){
		var email = /^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
		var email1 = $(this).val();
		if (!email.test(email1)||email1=='') {
            $('.error').html('请输入正确的邮箱!');
        }else{
        	/*
        	 * 查询数据有没有重复邮箱
        	 */
        	$.ajax({
        		type:"post",
        		url:$("#local").val() + "/login/email",
        		async:true,
        		dataType:'json',
        		data:{'email':email1},
        		success:function(response){
        			console.log(response);
        			if(response[1]=='aaa'){
        				$('.error').html('此邮箱已被注册!');
        				$('.input_email').removeClass('success');
        			}else{
        				$('.input_email').addClass('success');
        				
        			}
        		}
        	});
        }
	})
	/*
	 * 用户名不能为空
	 */
	$('.input_name').blur(function(){
		var name = $(this).val();
		if(name==''){
			$('.error').html('用户名不能为空!');
			$('.input_name').removeClass('success');
		}else{
			$('.input_name').addClass('success');
		}
	})
	/*
	 *输入验证码的时候让邮箱和用户名失去焦点 
	 */
	$('#cap').focus(function(){
		$('.input_email').blur();
		$('.input_name').blur();
	})
	/*
	 * 提交表单
	 */
	$('.btn').click(function(){
		/*
		 * 判断验证码输入的对不对
		 */
		var cap = $('#cap').val();
		var cap1 =$('#cap2').val();
		if(cap!=cap1){
			$('.error').html('验证码错误!');
			$('#cap').removeClass('success');
		}else{
			$('#cap').addClass('success');
		}
		/*
		 * 判断两次验证码对不对
		 */
		var input_password = $('.input_password').val();
		var input_password1 = $('.input_password2').val();
		if(input_password1!=input_password){
			$('.error').html('两次密码不一致!');
			$('.input_password').removeClass('success');
			$('.input_password2').removeClass('success');
		}else if(input_password1==''||input_password==''){
			$('.error').html('密码不能为空!');
			$('.input_password').removeClass('success');
			$('.input_password2').removeClass('success');
		}else{
			$('.input_password').addClass('success');
			$('.input_password2').addClass('success');
		}
		var num = $('.success').length;		
        if (num == 5) {
        	$('.error').html('');
            $('#myform').submit();
        } else {
            return false;
        }
		
	})
	
})
