<template>
	<div>
		<fold></fold>
		<div style="height: 68px;"></div>
		<mylike
			v-for="item in mypoetry"   
                    :classify="item.classify"
                    :collect_num="item.collect_num" 
                    :comment_num="item.comment_num" 
                    :content="item.content" 
                    :poetry_num="item.poetry_num" 
                    :time="item.time"
                    :title="item.title"></mylike>
		<goup></goup>
		
		<div class="top_left1" @click="laststep">
			<i class="fa fa-mail-reply "></i>
		</div>
		<div style="height: 46px;"></div>
		<home-footer></home-footer>
	</div>
</template>

<script>
	import Fold from '../components/Fold.vue';
	import Mylike from '../components/Mylike.vue';
	import Goup from '../components/Goup';
	import HomeFooter from '../components/HomeFooter';
	export default {
		data () {  
            return {  
                mypoetry :[]
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
			this.mypoetry = JSON.parse(sessionStorage.getItem("mypoetry"));
			console.log(this.mypoetry[0]);
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