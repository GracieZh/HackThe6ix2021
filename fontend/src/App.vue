<template>
  <div>
    <topNav />
    <homeBanner />
    <section3 />
    <section1 />
    <section2 />
    <footerBar />
  </div>
</template>

<script>
import topNav from './pages/TopNav.vue'
import homeBanner from './pages/HomeBanner.vue'
import section1 from './pages/Section1.vue'
import section2 from './pages/Section2.vue'
import section3 from './pages/Section3.vue'
import footerBar from './pages/Footer.vue'

export default {
  name: 'app',
  components: {
    topNav,
    homeBanner,
    section1,
    section2,
    section3,
    footerBar,
  },
  data () {
    return {

    }
  }
}
</script>

<style lang="scss">
body {
  padding: 0px !important;
  margin: 0px !important;
}
p,h1,a {
  font-family: "Poppins", sans-serif;
  text-decoration: none;
}


</style>

<!--template>
  <div id="app">
    <img src="./assets/logo.png">
    <h1>{{ msg }}</h1>
    <h2>Essential Links</h2>
    <ul>
      <li><a href="https://vuejs.org" target="_blank">Core Docs</a></li>
      <li><a href="https://forum.vuejs.org" target="_blank">Forum</a></li>
      <li><a href="https://chat.vuejs.org" target="_blank">Community Chat</a></li>
      <li><a href="https://twitter.com/vuejs" target="_blank">Twitter</a></li>
    </ul>
    <h2>Ecosystem</h2>
    <ul>
      <li><a href="http://router.vuejs.org/" target="_blank">vue-router</a></li>
      <li><a href="http://vuex.vuejs.org/" target="_blank">vuex</a></li>
      <li><a href="http://vue-loader.vuejs.org/" target="_blank">vue-loader</a></li>
      <li><a href="https://github.com/vuejs/awesome-vue" target="_blank">awesome-vue</a></li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<style lang="scss">
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style-->