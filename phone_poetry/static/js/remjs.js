
		var rem=20;
		function resizeRem(){
			rem=20/320*document.documentElement.clientWidth;
			if(rem>=30){
				rem=30;
			}
			document.documentElement.style.fontSize=rem+"px";
		}
			document.addEventListener("DOMContentLoaded",function(){
			resizeRem();
		},false)
			window.onresize=function(){
			resizeRem();
		}