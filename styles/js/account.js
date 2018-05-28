$(function(){
	/*
	 * 导航栏tab键切换
	 */
	$('.tab li').click(function(){
		$(this).addClass('active').siblings('li').removeClass('active');
		var index = $(this).index();
		$('.tab_content').eq(index).css('display','block').siblings('.tab_content').css('display','none');
		
	});
	/*
	 * 如果是点击头部的发布新文章
	 */
	if($('#fa').val()=='fa'){
		$('.tab li').eq(4).addClass('active').siblings('li').removeClass('active');
		$('.tab_content').eq(4).css('display','block').siblings('.tab_content').css('display','none');
	}
	
	/*
	 * 修改信息的tab键切换
	 */
	$('.menu_item').click(function(){
		$(this).addClass('current').siblings('.menu_item').removeClass('current');
		var index = $(this).index();
		$('.set-content').eq(index).css('display','block').siblings('.set-content').css('display','none');
	})
	
	/*
	 * 上传文章的图片
	 */
	var file_head=document.getElementById("file_head");
	file_head.onchange=function(){  
        var preview, img_txt, localImag, file_head = document.getElementById("file_head"),  
        picture = file_head.value; 
      $('.info').text(picture);
        if (!picture.match(/.jpg|.gif|.png|.bmp/i)) return alert("您上传的图片格式不正确，请重新选择！"),  
        !1;  
        if (preview = document.getElementById("preview"), file_head.files && file_head.files[0]) preview.style.display = "block",  
            preview.style.width = "100px",  
            preview.style.height = "100px",  
            
            preview.src = window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1 ? window.webkitURL.createObjectURL(file_head.files[0]) : window.URL.createObjectURL(file_head.files[0]);  
           //alert(preview.src),
         else {  
            file_head.select(),  
            file_head.blur(),  
            img_txt = document.selection.createRange().text,  
            localImag = document.getElementById("localImag"),  
            localImag.style.width = "100px",  
            localImag.style.height = "100px";  
            try {  
                localImag.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)",  
                localImag.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = img_txt  
            } catch(f) {  
                return alert("您上传的图片格式不正确，请重新选择！"),  
                !1  
            }  
            preview.style.display = "none",  
            document.selection.empty()  
        }  
        return document.getElementById("DivUp").style.display = "block",  
        !0  
    }	
	/*
	 * 修改密码
	 */
	$('.password_btn').click(function(){
		var pass1 = $.md5($('.pass1').val());
		var pass = $('#pass2').val();
		if(pass1!=pass||pass1==''){
			$('.error').html('原密码不正确!');
		}else{
			// 验证新密码对不对
			var pass2 = $('.pass2').val();
			var pass3 = $('.pass3').val();
			if(pass2!=pass3||pass2==''||pass3==''){
				$('.error').html('两次密码不正确!');
			}else{
				$('#pass_form').submit();
			}
		}
		
	});
	
	/*
	 * 头像上传
	 */
	$('#file_input').change(function(e){
    	setImgPreview();
	})
	function setImgPreview(){
	    var $file = $('#file_input');
	    var fileObj = $file[0];
	    var windowURL = window.URL || window.webkitURL;
	    var dataURL;
	    var $img = $(".change-head img")[0];
	
	    if (fileObj && fileObj.files && fileObj.files[0]) {
	        dataURL = window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1 ? window.webkitURL.createObjectURL(fileObj.files[0]) : window.URL.createObjectURL(fileObj.files[0]);  
	        $img.src = dataURL;
	    } else {
	        dataURL = $file.val();
	        var imgObj = $(".change-head img")[0];
	        imgObj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
	        imgObj.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = dataURL;
	    }
	    console.log(dataURL);
	    /*
	     * 把图片上传到数据库
	     */
	    $('#user_form').submit();
	}
	
	/*
	 * 点击签到
	 */
	$('.sign').click(function(){
		// 先让积分加显示然后向上直到消失
		$.ajax({
			type:"post",
			url:$("#local").val() + "/home/sign",
			dataType:'json',
			async:true,
			success:function(response){
				console.log(response);
				if(response['aaa']=='aaa'){
					alert('您今天已经签到!');
				}else{$('.sign').html('已签到');
					$('.sign_jifen').fadeIn(200).animate({'top':'-20px'},200).fadeOut(200);
					
				}
				if(response['aaa']=='bbb'){// 没有连续签到,连续签到时间变成1天
					$('.sign_tian').text(1);
					$('.sign_jifen').fadeIn(200).animate({'top':'-20px'},200).fadeOut(200);
					$('.sign').html('已签到');
				}
				if(response['aaa']=='ccc'){// 连续签到,连续签到时间加1
					$('.sign_tian').text($('.sign_tian').text()*1+1);
					$('.sign_jifen').fadeIn(200).animate({'top':'-20px'},200).fadeOut(200);
					$('.sign').html('已签到');
				}
				if(response['aaa']=='ddd'){// 连续签到,连续签到时间加1
					$('.sign_tian').text(1);
					$('.sign_jifen').fadeIn(200).animate({'top':'-20px'},200).fadeOut(200);
					$('.sign').html('已签到');
				}
			}
		});
		
		
		
		
	})
})
