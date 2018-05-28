<template>															
		<li class="article_list">
			<p>
				<img src="http://www.zhengzhiwei1.top/poetry/img/wen.png"/>
				<a href="" class="gray">{{classify}}</a>
				<a :href="'#/article/'+poetry_num" class="big">{{title}}</a>
				</br>
				(<span>{{time}}</span>- -<span>{{collect_num}}</span>人喜欢- -<span>{{comment_num}}</span>人评论)
			</p>
			<p class="article_content">{{content}}</p>
	</li>
</template>

<script>
	export default {
        // 接收父组件传过来的以下几个属性  
        props: ['classify','collect_num','comment_num','content','poetry_num','time','title']
    }
</script>
	 
<style>
p {
	margin: 0;
}

.article_list {
	padding: 0 10px;
	margin: 10px;
	font-size: 14px;
}
 .article_list img{
 	display: inline-block;
 	position: relative;
 	bottom: 3px;
 }
  .article_list li {
  padding: 10px;
  border-bottom: 1px dashed #ddd;
  transition: all .3s ease-in-out;
}

  .article_list li a {
  font-size: 16px;
  color: #aaa;
}

  .article_list li .big {
  color: #935A46;
}

  .article_list .article_content {
  min-width: 300px;
  height: 32px;
  line-height: 32px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}

</style>