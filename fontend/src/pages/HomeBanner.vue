<template>
    <div class="banner">
        <h1>Meal Finder</h1><br>
        <p>Your meal is just a few clicks away!</p>
        <div class="buttonDiv">
            <button class="btn-grad" type="button" @click="handleClickViewDemo">View Demo</button>
            <button class="btn-grad-white" type="button">Get Started</button>
        </div>
    </div>
</template>

<script>
export default {
  name: 'topNav',
  components: {

  },
  data () {
    return {

    }
  },
  methods: {
      handleClickViewDemo() {
          /*
          alert('clicked');
          this.$router.push('/demo'); 
          */
      }
  }
}
</script>

<style lang="scss" scoped>
    //@import '../assets/scss/HomeBanner.scss';
    .banner{
        //height: 20em;
        padding: 100px 20px 100px 20px;
        background-color: #281483;
        //background-image: linear-gradient(45deg, #281483 0%, #d782d9 100%);
        //background-color: #FBAB7E;
        //background-image: linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%);
        //background-color: #FBAB7E;
        //background-image: linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%);
        background-image: linear-gradient( 68.3deg,  rgba(245,177,97,1) 0.4%, rgba(236,54,110,1) 100.2% );
        color: white;
        text-align: center;
    }
    .buttonDiv {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    h1 {
        //line-height: 9em;
        font-size: 2.5rem;
        margin-bottom: 0px;
    }
    p{
        font-size: 1.25rem;
        margin-bottom: 25px;
    }
    button {
        border-style: none;
    }


    
         .btn-grad {background-image: linear-gradient(to right, #ffb347 0%, #ffcc33  51%, #ffb347  100%)}
         .btn-grad {
            margin: 10px;
            padding: 15px 45px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: black;            
            //box-shadow: 0 0 20px #eee;
            border-radius: 5px;
            display: block;
          }

          .btn-grad:hover {
            background-position: right center; /* change the direction of the change here */
            color: black;
            text-decoration: none;
          }
         


    /*
    .btn-grad {background-image: linear-gradient(to right, #FF512F 0%, #F09819  51%, #FF512F  100%)}
    .btn-grad {
        margin: 10px;
        padding: 15px 45px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;            
        //box-shadow: 0 0 20px #eee;
        border-radius: 5px;
        display: block;
    }

    .btn-grad:hover {
        background-position: right center; 
        color: #fff;
        text-decoration: none;
    }
     */    

    /*
    .btn-grad {
        background-image: linear-gradient(to right, #1FA2FF 0%, #12D8FA  51%, #1FA2FF  100%)
    }
    .btn-grad {
        margin: 10px;
        padding: 15px 45px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;            
        //box-shadow: 0 0 20px #eee;
        border-radius: 5px;
        display: block;
    }

    .btn-grad:hover {
        background-position: right center; 
        color: #fff;
        text-decoration: none;
    }
    */

    .btn-grad-white {
        background-image: linear-gradient(to right, #ECE9E6 0%, #FFFFFF  51%, #ECE9E6  100%)
    }
    .btn-grad-white {
        margin: 10px;
        padding: 15px 45px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: black;            
        //box-shadow: 0 0 20px #eee;
        border-radius: 5px;
        display: block;
    }

    .btn-grad-white:hover {
        background-position: right center; /* change the direction of the change here */
        color: black;
        text-decoration: none;
    }
         

</style>