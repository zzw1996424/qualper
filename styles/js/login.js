$(function(){
	/*
	 * 点击登录验证账号密码
	 */
	$('.btn').click(function(){
		var email1 = $('.input_email').val();	
		var email = /^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
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
        			if(response[1]=='aaa'){      				
        				var password1 = response[0];// 返回值是加密	
        				console.log(response);
        				/*
        				 * 如果有这个账号来验证输入的密码对不对
        				 */
        				var pass = $.md5($('.input_password').val());
        				if(pass == password1){
        					// 密码如果正确就跳转到个人中心页面
        					$('#myform').submit();
        				}else{
        					$('.error').html('密码不正确!');	
        				}
        			}else{
        				$('.error').html('请输入正确的邮箱!');	
        			}
        		},
        		error:function(response){
        		}
        	});
        }
		
		
		
	})

})