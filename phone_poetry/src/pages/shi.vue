<!-- Home.vue -->  
<template>  
    <div class="container">
        <!-- 由于html不区分大小写，所以js中驼峰命名方式在html中要改成用短横线连接的形式 -->  
        <home-header></home-header>  
        <div class="content">  
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
        <goup></goup>
    </div> 
    
</template>  
<style>  
	.container{
		padding: 0;
	}
  .content{
  	margin-top: 48px;
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
        methods:{
                post:function(){
                        
                    } 
            },
        created:function(){
        	// 在实例创建之后同步调用。
        	var classifya = sessionStorage.getItem("classifya");
        	if(classifya){
        		this.articles=JSON.parse(classifya);
        	}else{
        		this.$http.post('http://www.zhengzhiwei1.top/poetry/index.php/home/classifya',{
	                class_url:1
	            },{
	                emulateJSON:true
	            }).then(function(res){
	                this.articles= res.data;
	                sessionStorage.setItem("classifya",JSON.stringify(res.data));
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