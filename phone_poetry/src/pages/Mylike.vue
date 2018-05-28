<template>
	<div>
		<fold></fold>
		<div style="height: 68px;"></div>
		<mylike
			v-for="item in mylike"   
                    :classify="item[0].classify"
                    :collect_num="item[0].collect_num" 
                    :comment_num="item[0].comment_num" 
                    :content="item[0].content" 
                    :poetry_num="item[0].poetry_num" 
                    :time="item[0].time"
                    :title="item[0].title"></mylike>
		<goup></goup>
		
		<div class="top_left1" @click="laststep">
			<i class="fa fa-mail-reply "></i>
		</div>
		<home-footer></home-footer>
	</div>
</template>

<script>
	import Fold from '../components/Fold.vue';
	import Mylike from '../components/Mylike.vue';
	import Goup from '../components/Goup';
	import HomeFooter from '../components/HomeFooter'
	export default {
		data () {  
            return {  
                mylike :[]
            }
            console.log(articles);
        },
		methods:{
            laststep:function(){
             window.history.back();  
            } 
      },
		components: {
		    Fold,
		    Mylike,
		    Goup,
		    HomeFooter
		},
		created:function(){
			this.mylike = JSON.parse(sessionStorage.getItem("mylike"));
			console.log(this.mylike[0][0]);
		}
	}
	
</script>

<style>
	.content_top{
		position: fixed;
		top: 0;
		z-index: 10;
		width: 100%;
	}
	.top_left1{
	position: fixed;
	top: 10px;
	right: 10px;
    width: 48px;
    height: 48px;
    font-size: 18px;
    padding: 12px;
    box-sizing: border-box;
    color: #935A46;
    z-index: 11;
	}
</style>