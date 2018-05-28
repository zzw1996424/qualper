$(function(){
	/*
	 * 首页的自动轮播图
	 */
	$('.mya .title').removeClass('one_line');
	$('.recommend-list li').eq(0).find('.title').addClass('one_line');
	var num=0;
	fun = function(){
		num++;
		$('.recommend-list ul li').find('p').removeClass('one_line');
		$('.recommend-list ul li').eq(num).find('p').addClass('one_line');
		var img = $('.recommend-list ul li').eq(num).find('img').attr('src');
		$('.recommend-show img').attr('src',img).css({'position':'relative','left':'20px'});	
		$('.recommend-show img').animate({'left':0},700);
		$('.svg-img').fadeIn(2500).attr('href',img);
		$('.xiao_title').html($('.recommend-list ul li').eq(num).find('.title').text());
		$('.xiao_name').html($('.recommend-list ul li').eq(num).find('#hi_name').val());
		$('.mya2').attr('href',$('.one_line').parents('.mya').attr('href'));
		$('.xiao_title').attr('href',$('.one_line').parents('.mya').attr('href'));
		$('.xiao_name').attr('href',$('.one_line').parents('.mya').find('#hi_id').val());
		if(num==7){
			num=-1;
		}
	}
	
	var time = setInterval(fun,5000);	
})
