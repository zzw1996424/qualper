// main.js  
  
// 导入Vue，这个是必需的，在使用Vue之前，必须先导入  
import Vue from 'vue'  
import Vuex from 'vuex';
//store为实例化生成的
import store from './store/index'
Vue.use(Vuex);
// 导入 vue-router，并使用  
import VueRouter from 'vue-router'  
Vue.use(VueRouter);
import Navigation from 'vue-navigation'
Vue.use(Navigation, {router});
// 类似于ajax
import VueResource from 'vue-resource'
Vue.use(VueResource);  
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
// 导入 pages 下的 Home.vue   
import Home from './pages/Home'  
// 社区页面
import Community from './pages/Community'
// 个人中心页面
import Account from './pages/Account'
// 文章详情
import Article from './pages/Article'
// 登录
import Login from './pages/Login'
// 我的文章
import Mypoetry from './pages/Mypoetry'
// 我的收藏
import Mylike from './pages/Mylike'
// 诗
import shi from './pages/shi'
// 词
import ci from './pages/ci'
// 赋
import fu from './pages/fu'
// 注册
import register from './pages/register'
// 导入jQ并应用
import $ from 'jquery'
// 引入md5
import crypto from 'crypto'
// 插件
import YDUI from 'vue-ydui'
import 'vue-ydui/dist/ydui.rem.css'
Vue.use(YDUI);
// 定义路由配置  
const routes = [  
    {path: '/',component: Home,meta: {keepAlive: true}},  
    {path: '/community',component: Community,meta: {keepAlive: false}},
    {path: '/Account',component: Account,meta: {keepAlive: false}},
    {path: '/Article/:id',component: Article,meta: {keepAlive: false}},
    {path: '/Login',component: Login,meta: {keepAlive: false}},
    {path: '/Mypoetry',component: Mypoetry,meta: {keepAlive: false}},
    {path: '/Mylike',component: Mylike,meta: {keepAlive: false}},
    {path: '/shi',component: shi,meta: {keepAlive: false}},
    {path: '/ci',component: ci,meta: {keepAlive: false}},
    {path: '/fu',component: fu,meta: {keepAlive: false}},
    {path: '/register',component: register,meta: {keepAlive: false}}
]  
  
// 创建路由实例  
const router = new VueRouter({  
    routes  
})  
  
// 创建 Vue 实例  
new Vue({  
  el: '#app',  
  data(){  
    return {  
        transitionName: 'slide'  
    }  
  },  
  router, // 在vue实例配置中，用router 
//store,
//render: h => h(Article),
  watch: {  
    // 监视路由，参数为要目标路由和当前页面的路由  
    '$route' (to, from){  
        const toDepth = to.path.substring(0, to.path.length-2).split('/').length  
        // 官方给出的例子为 const toDepth = to.path.split('/').length 由于现在只有两个路由路径'/'和'/detail'  
        // 按照官方给的例子，这两个路由路径深度都为 2 ，所以，这里稍作调整，不知道有什么不妥  
        // 但目前在这个demo中能正常运行，如果知道更好的方法，欢迎留言赐教  
        const fromDepth = from.path.substring(0, from.path.length-2).split('/').length  
        this.transitionName = toDepth < fromDepth ? 'slide_back' : 'slide'  
        // 根据路由深度，来判断是该从右侧进入还是该从左侧进入  
    }  
  }  
})  