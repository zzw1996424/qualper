

<style>
	.footer{
		height: 46px;
		line-height: 46px;
		position: fixed;
		bottom: 0;
		width: 100%;
		background: #fff;
	}
	.footer .tab-item{
		float: left;
		display: block;
		width: 33.3333333%;
		text-align: center;
		line-height: 46px;
		padding-top: 6px;
	}
	.footer .tab-item .isi{
		display: block;
		font-size: 18px;
	}
	.footer .tab-item .tab-label{
		display: block;
		line-height: 1.4;
		font-size: 16px;
	}
	.active{
		color: #474A4F;
	}
</style>
<template>
  <nav class="bar bar-tab easy-bottom-bar footer">
    <router-link class="tab-item" to="/">
      <span class="fa fa-book isi" :class="{'easy-fa-color': isHome}"></span>
      <span class="tab-label" :class="{'easy-fa-color': isHome}">文学</span>
    </router-link>
    <router-link class="tab-item" to="/community">
      <span class="fa fa-plane isi" :class="{'easy-fa-color': Community}"></span>
      <span class="tab-label" :class="{'easy-fa-color': Community}">社区</span>
    </router-link>
    <router-link class="tab-item" to="/account">
      <span class="fa fa-user-circle-o isi" :class="{'easy-fa-color': Account}"></span>
      <span class="tab-label" :class="{'easy-fa-color': isOption}">我</span>
    </router-link>
  </nav>
</template>

<script>
export default {
  data: () => ({
    isHome: false,
    Community: false,
    Account: false,
  }),
  mounted: function() {
    this.$nextTick(function() {
      const uri = this.$route.path;
      if (uri === '/') {
        this.isHome = true;
        this.Community = false;
        this.Account = false;
      }
      if (uri === '/community') {
        this.isHome = false;
        this.Community = true;
        this.Account = false;
      }
      if (uri === '/account') {
        this.isHome = false;
        this.Community = false;
        this.Account = true;
      }
    });
  },
  methods: {

  }
}
</script>

<style>
.footer{
	z-index: 13;
}
.easy-bottom-bar a {
  color: #935A64 !important;
}
.easy-fa-color {
  color: #474A4F !important;
}
</style>