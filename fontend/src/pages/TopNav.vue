<template>
    <nav class="nav-horizontal">
        <div class="mask">
            <ul class="list" style="float: left;">
              <li><a href="#">Find a Meal</a></li>
              <li><a href="#">Discover Meals</a></li>
              <li><a href="#">Top Restaurants</a></li>
            </ul>
            <ul class="list" style="float: right; padding-right: 40px;">
              <li><a href="#">Login / Sign Up</a></li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
  name: 'topNav',
  components: {

  },
  data () {
    return {

    }
  }
}
</script>

<style lang="scss" scoped>
    @import '../assets/scss/TopNav.scss';
</style>