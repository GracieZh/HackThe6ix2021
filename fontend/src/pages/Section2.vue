<template>
    <div class="sectionDiv">
        <div class="left">
            <p>
                Use Geotab's telematics data sets in the most innovative way possible. Available datasets are in covid mobility impact (traffic analysis, congestion, fuel fillup analytics, etc.), weather information, urban infrastructure analytics (dangerous intersections, cell coverage areas, etc.), and vehicle location analytics (parking locations, fuel station metrics, idling times, etc.) Judging will take into consideration Geotab’s core principles: Productivity, Optimization, Safety, Compliance and Expandability, Sustainability
            </p>
        </div>
        <div class="right">
            <img src="../assets/img/garden.png" />
        </div>
    </div>
</template>

<script>
export default {
  name: 'Section2',
  components: {

  },
  data () {
    return {

    }
  }
}
</script>

<style lang="scss" scoped>
    //@import '../assets/scss/Section1.scss';
    .sectionDiv{
        min-height: 500px;
        height: 20em;
        padding: 0px 50px;
        color: black;
        display: flex;
        padding-top: 10em;
        background-image: radial-gradient(73% 147%, #EADFDF 59%, #ECE2DF 100%), radial-gradient(91% 146%, rgba(255,255,255,0.50) 47%, rgba(0,0,0,0.50) 100%);
        background-blend-mode: screen;
    }
    p {
        line-height: 2em;
        max-width: 1000px; 
    }
    .right {
        width: 30%;
        text-align:left;
    }
    .left {
        width: 70%;
        text-align: left;
        padding-top: 50px;
        padding-left: 120px;
    }
    img {
        width: 300px;
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
        //box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
    }
    @media (max-width: 1100px) {
        .sectionDiv {
            display: inline-block;
            padding-top: 40px;
            //overflow: auto; 
            height: auto;
            //width: 100%;
        }
        .right {
            width: 100%;
            text-align:center;
            margin-bottom: 40px;
        }
        .left {
            width: 100%;
            text-align: center;
            padding-top: 0px;
            padding-left: 0px;
        }
        p {
            //margin-bottom: 40px;
            //max-width: 800px;
            text-align: center;
        }
    }
</style>