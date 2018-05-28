$(function(){
	/*
	 * 引用分享插件
	 */
	$("#socialShare").socialShare();
	/*
	 * 鼠标点到心转换图片
	 */
	$('.like').mouseenter(function(){
		$(this).find('img').attr('src',$('#local2').val()+'img/love2.png');
	});
	$('.like').mouseleave(function(){
		$(this).find('img').attr('src',$('#local2').val()+'img/love.png');
	});
	/*
	 * 点击收藏发起请求
	 */
	$('.like').one('click',function(){
		// 先判断有没有登录
		if($('#islogin').val()==''){
			alert('请先登录!');
			window.location.href = $('#local').val()+'/login/login';
		}else{
			/*
			 * 发起请求
			 */
			var obj = {};
			obj.poetryid = $('#poetryid').val();// 诗词的id
			obj.userid = $('#userid').val();// 收藏者的id
			obj.poetryname = $('#poetryname').val();// 作者的名字
			obj.poetrytitle = $('#poetrytitle').val();// 标题
			
			$.ajax({
				type:"post",
				dataType:'json',
				url:$("#local").val() + "/home/collect",
				data:obj,
				success:function(response){
					if(response[0]=='aaa'){
						$('.error').css('display','block');
					}else if(response[0]=='bbb'){
						$('.collect').html('已收藏');
					}
					
				}
			});
		}
	})
	/*
	 * 点击发布评论
	 */
	$('.reply_btn').click(function(){
		// 先判断有没有登录
		if($('#islogin').val()==''){
			alert('请先登录!');
			window.location.href = $('#local').val()+'/login/login';
		}else{
			var tex = $('#comment').val();// 获取评论区的内容
			$('#my_text').text(tex);
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
			$('.time1').html(CurentTime());// 当前时间
			$('#user_li').fadeIn(200);// 点击发布自己的评论出现
			
			var obj = {};
			obj.poetryid = $('#poetryid').val();// 诗词的id
			obj.userid = $('#userid').val();// 收藏者的id
			obj.comment_content = $('#comment').val();// 评论的内容
			obj.poetrytitle = $('#poetrytitle').val();// 所评论的文章标题
			obj.comment_time = CurentTime();// 评论的当前时间
			obj.comment_img = $('#comment_img').val();// 当前评论的头像
			obj.comment_name = $('#comment_name').val();// 当前评论的昵称
			$.ajax({
				type:"post",
				dataType:'json',
				url:$("#local").val() + "/home/comment",
				async:true,
				data:obj,
				success:function(){
					$('#comment').val('');
				}
			});
		}
	});
	var com = $('#pagin_comment').val();
	var arr2 = JSON.parse(com);// 把字符串转换成json数据,隐藏域的值是由后端传过来的,类型是一个大字符串
	function createDemo(name){
        var container = $('#pagination-' + name);
        var sources = arr2;
        console.log(arr2.length);
        var options = {
            dataSource: sources,
            className: 'paginationjs-theme-blue',
            callback: function(response, pagination){
                window.console && console.log(response, pagination);
                var dataHtml = '<ul>';
                $.each(response, function(index, item){																				
                    dataHtml += '<li class="pagina"><div class="user-avatar"><a href="'+$("#local").val()+'/'+item['userid']+'"><img src="'+$("#local2").val()+'/'+item['comment_img']+'"/></a></div><div class="replay-detail"><p class="user"><span class="span-item"><a href="'+$("#local").val()+'/home/writer/'+item['userid']+'">'+item['comment_name']+'</a></span><span class="item span-item">'+item['floor']+'楼评论</span></p><div class="paper">'+item['comment_content']+'<span class="time">'+item['comment_time']+'</span></div></div></li>';
                });
                dataHtml += '</ul>';
                container.prev().html(dataHtml);
            }
        };
        container.pagination(options);
        return container;
    }
	createDemo('demo1');
	if($('.pagina').length<5){
		$('#pagination-demo1').css('display','none');
	}
	
	
})
