<!-- Home.vue -->  
<template>  
    <div class="container">
        <!-- 由于html不区分大小写，所以js中驼峰命名方式在html中要改成用短横线连接的形式 -->  
        <home-header ref="iszhe"></home-header>  
        <div class="content_home">  
    	 <yd-slider autoplay="3000" class="carousel">
	        <yd-slider-item v-for="(item,index) in articles" v-if="index<6">
	        	<a :href="'#/article/'+item.poetry_num">
		            <img :src="'http://www.zhengzhiwei1.top/poetry/'+item.img" alt="">
		        </a>
	        </yd-slider-item>
	    </yd-slider>
            <ul class="cont_ul">  
                <list  
                    v-for="item in articles"   
                    :img="item.img"
                    :author="item.author" 
                    :title="item.title" 
                    :time="item.time" 
                    :content="item.content" 
                    :poetry_num="item.poetry_num">  
                </list>  
            </ul>  
        </div> 
        <home-footer></home-footer>
        <goup></goup>
    </div> 
    
</template>  
<style scoped>  
	.container{
		padding: 0;
	}
  .carousel{
  	margin-top: 48px;
  }
.yd-slider-item img{
	height: 300px;
}
</style>  
<script>  
    // 导入要用到的子组件  
    import HomeHeader from '../components/HomeHeader'  
    import List from '../components/List'  
  	import HomeFooter from '../components/HomeFooter'
  	import Goup from '../components/Goup'
    export default {  
        data () {  
            return {  
                articles :[]
            }  
        },  
        created:function(){
        	// 在实例创建之后同步调用。
        	var isupload = sessionStorage.getItem("isupload");
        	if(isupload){
        		this.articles=JSON.parse(isupload);
        		console.log(this.articles);
        	}else{
        		this.$http.post('http://172.16.0.126/poetry/index.php/home/index/vue',{
	                a:1,
	                b:2
	            },{
	                emulateJSON:true
	            }).then(function(res){
	                this.articles= res.data;
	                sessionStorage.setItem("isupload",JSON.stringify(res.data));
	            },function(res){
	                alert(res.status);
	            });
        	}	
        },
        // 在components字段中，包含导入的子组件  
        components: {  
            HomeHeader,  
            List,
            HomeFooter,
            Goup
        }
        
    	
    }
    
</script>  