<template>
  <div>
    <topNav />
    <homeBanner />
    <footerBar />
  </div>
</template>

<script>
import topNav from './pages/TopNav.vue'
import homeBanner from './pages/HomeBanner.vue'
import footerBar from './pages/Footer.vue'

export default {
  name: 'app',
  components: {
    topNav,
    homeBanner,
    footerBar,
  },
  data () {
    return {

    }
  }
}
</script>

<style lang="scss">


</style>
