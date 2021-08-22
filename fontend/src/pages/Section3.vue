<template>
  <div class="sectionDiv">
    <div id="div1" @drop="drop($event)" @dragover="allowDrop($event)"></div>
    <br />
    <img
      id="drag1"
      src="https://www.w3schools.com/html/img_logo.gif"
      draggable
      @dragstart="drag($event)"
      width="336"
      height="69"
    />
  </div>
</template>

<script>
export default {
    name: 'Section3',
    components: {

    },
    data () {
        return {

        }
    },
    methods: {
        allowDrop(ev) {
            ev.preventDefault();
        },

        drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        },

        drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            var imageUrl = ev.dataTransfer.getData('text/html');
            var rex = /src="?([^"\s]+)"?\s*/;
            var url, res;
            url = rex.exec(imageUrl);
            var finalUrl = url[0].substring(5, url[0].length-2)
            console.log('image url: ', finalUrl);
            ev.target.appendChild(document.getElementById(data));
        }
    }
}
</script>

<style lang="scss" scoped>
//@import '../assets/scss/Section3.scss';

#div1 {
  width: 350px;
  height: 70px;
  padding: 10px;
  border: 1px solid #aaaaaa;
}

.sectionDiv {
  min-height: 500px;
  height: 20em;
  padding: 0px 50px;
  color: black;
  display: flex;
  padding-top: 10em;
  background-image: radial-gradient(73% 147%, #eadfdf 59%, #ece2df 100%),
    radial-gradient(
      91% 146%,
      rgba(255, 255, 255, 0.5) 47%,
      rgba(0, 0, 0, 0.5) 100%
    );
  background-blend-mode: screen;
}
p {
  line-height: 2em;
  max-width: 1000px;
}
.right {
  width: 30%;
  text-align: left;
}
.left {
  width: 70%;
  text-align: left;
  padding-top: 50px;
  padding-left: 120px;
}
/*
img {
  width: 300px;
  height: 300px;
  object-fit: cover;
  border-radius: 8px;
  //box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
  box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
}
*/
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
    text-align: center;
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