<template>

  <div class="d_table" border=1 style="min-height: 500px;">

    <div class="d_tr">
      <div class="sectionDiv" v-if="imgSrc == '../assets/logo.png'">
          <div id="div1" @drop="drop($event)" @dragover="allowDrop($event)" class="imgDiv1">
            <img id="drop_img" src="../assets/logo.png" alt="" />
            <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"></path></svg><br>
            <p>Drag an image here.</p>
          </div>
          <br>
      </div>
      <div class="sectionDiv2" v-else>
          <div class="imgDiv2" id="div1" @drop="drop($event)" @dragover="allowDrop($event)"><img id="drop_img" src="../assets/logo.png" alt="" /></div>
          <br>
      </div>

      
      <div class="d_td" style="vertical-align:top;">
        <div class="d_table" border=1 style="width:500px;">

          <!--div class="d_tr">
            <div class="d_td">Type:</div>
            <div class="d_td"><input v-model="f_type" class="d_submit" type="input" value=""></div></div-->

          <div class="d_tr">
            <div class="d_td">Name:</div>
            <div class="d_td"><input v-model="f_name" class="d_submit" type="input" value=""></div></div>

          <div class="d_tr">
            <div class="d_td">Shop:</div>
            <div class="d_td"><input v-model="f_shop" class="d_submit" type="input" value=""></div></div>

          <div class="d_tr">
            <div class="d_td">Link:</div>
            <div class="d_td"><input v-model="f_link" class="d_submit" type="input" value=""></div></div>

          <div class="d_tr">
            <div class="d_td">Add:</div>
            <div class="d_td">
                <input @click="addFood()" class="d_submit" type="submit" value="Add to Database">
              </div></div>

        </div>
      </div>  
    </div>  
    <div class="d_tr">
      <div id="result" class="resultDiv">
      </div>
    </div>  
    <!--div class="d_tr">
      <table id="result" width="100%" height="100%" border="1">
        <tr><td></td></tr>
      </table>
    </div-->
  </div>

</template>

<script>
import "babel-polyfill"
export default {
    name: 'Section3',
    components: {

    },
    data: () => ({
        f_type: "Food",
        f_name: "Sandwich",
        f_shop: "KFC",
        f_link: "https://www.kfc.ca",
        f_image: "",
        imgSrc: "../assets/logo.png",
    }),
    methods: {
        searchFood()
        {
            this.callSubmitImage("search");
        },
        addFood()
        {
            this.callSubmitImage("add");
        },
        process_result(data)
        {
          console.log("process_result");
          if(data)
          if(data.data)
          if(data.data.list)
          {
            var elem = document.getElementById('result');
            elem.innerHTML = "";

            for (const f of data.data.list) {
              console.log("f:", f);
              /*
              var row = "<tr>"
                        + "<td>"+f.id+"</td>"
                        + "<td><img src=\"http://localhost:8000/data/img_"+f.id+".jpg\"></td>"
                        + "<td>"+f.type+"</td>"
                        + "<td>"+f.name+"</td>"
                        + "<td>"+f.shop+"</td>"
                        + "<td>"+f.link+"</td>"
                        + "</tr>";
              */

              var row =   "<div style='box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px; max-width: 500px; padding: 20px; margin: 20px;'>"
                        + "<img style='width: 400px !important; height: auto !important;' src=\"http://localhost:8000/data/img_"+f.id+".jpg\"><br>"
                        + "<i style='font-style: normal; font-weight: 600'>"+f.name+"</i><br>"
                        + "<a href='"+ f.link +"'>"+f.shop+"</a>"
                        + "</div>";

              elem.innerHTML += row;
            }
          }
        },

        async callSubmitImage(cmd)
        {
            console.log("callSubmitImage 00 ---");

            try {
                    
                console.log("callSubmitImage ");
                const response = await fetch(
                      //'https://lesconps.com/hackthe6ix/php/addimage.php', 
                      'http://localhost:8000/php/addimage.php',
                      {
                    method: 'POST',
                    headers: {
                            "Accept":"application/json, text/plain, * / *",
                            "Content-Type":	"application/json;charset=UTF-8"
                        },
                    body: JSON.stringify({
                        cmd: cmd,
                        type: this.f_type,
                        name: this.f_name,
                        shop: this.f_shop,
                        link: this.f_link,
                        url: this.f_image
                    })
                });

                console.log("callSubmitImage 1");
                console.log(response);

                //const text = await response.text();
                //console.log("text ", text);

                const data = await response.json();
                if (data.error) {
                    console.log("callSubmitImage 2");
                    return {error: data.error};
                } else {
                    console.log(" ============= callSubmitImage  done ");
                    console.log(data);
                    this.process_result(data);
                    return data;
                }
            } catch (err) {
                    console.log("callSubmitImage 3");
                    console.log(err);
                return {error: err.message};
            }
        },

        allowDrop(ev) {
            ev.preventDefault();
        },

        drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        },

        drop(ev) {
            ev.preventDefault();
            //var data = ev.dataTransfer.getData("text");

            console.log("ev = ", ev);
            var imageUrl = ev.dataTransfer.getData('text/html');

            console.log("image URL = ", imageUrl);
            var tag_img = imageUrl.indexOf("<img "); 
            var src_start = imageUrl.indexOf('src="', tag_img+5);
            var src_end   = imageUrl.indexOf('"', src_start+5);
            console.log("pos = ", src_start, " ", src_end);
            var imgUrl = imageUrl.substring(src_start+5, src_end);
            console.log("----- image URL = ", imgUrl );
            if(imgUrl.substring(0,1)=='/')
            {
              var urilist = ev.dataTransfer.getData('text/uri-list');
              console.log("urilist = ", urilist);
              var u1 = urilist.indexOf("//");
              var u2 = urilist.indexOf("/", u1+2);
              var uripre = urilist.substring(0,u2);
              var uri = uripre + imgUrl;
              console.log("----- pre = ", uripre );
              imgUrl = uri;
            }
            var elem = document.getElementById('drop_img');
            elem.src=imgUrl;
            this.imgSrc = imgUrl;
            this.f_image = imgUrl;
            this.searchFood();

            // this.callSubmitImage(imgUrl);

            //var rex = /src="?([^"\s]+)"?\s*/;
            //var url, res;
            //url = rex.exec(imageUrl);
            //var finalUrl = url[0].substring(5, url[0].length-2)
            //console.log('image url: ', finalUrl);
            //ev.target.appendChild(document.getElementById(data));
        }
    }
}
</script>

<style lang="scss" scoped>
//@import '../assets/scss/Section3.scss';

input {
  padding: 12px 20px;
}


input, select {
  width: 100%;
  padding: 12px 20px;
  //margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}


input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  //background-color: #4CAF50;
  background-color: #f17c66;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  //background-color: #45a049;
  background-color: #ed396e;
}

  /*
    input[type=submit] {background-image: linear-gradient(to right, #76b852 0%, #8DC26F  51%, #76b852  100%)}
    input[type=submit] {
      margin: 10px;
      padding: 15px 45px;
      text-align: center;
      text-transform: uppercase;
      transition: 0.5s;
      background-size: 200% auto;
      color: white;            
      //box-shadow: 0 0 20px #eee;
      border-radius: 5px;
      //display: block;
      border-style: none;
      width: 150px;
    }

    input[type=submit]:hover {
      background-position: right center; 
      color: #fff;
      text-decoration: none;
    }
  */
         
.resultDiv {
  overflow-wrap: anywhere;
  display: flex;
  //overflow-wrap: break-word;
  max-width: 100%;
  //white-space: nowrap;
  overflow: auto;
}

.imgDiv1 {
  padding: 80px 10px 10px 10px;
}

.imgDiv2 {
  padding: none;
}

#div1 {
  //width: 350px;
  //height: 70px;
  align-items: stretch;
  height: 70%;
  //border: 1px solid #aaaaaa;
}
.box__icon {
  fill: #92b0b3;
}
.sectionDiv2 {
  outline: 2px dashed #92b0b3;
  width: 680px;
  height: 230px;
  text-align: center;
  //padding-top: 8em;
  display: inline-block;
  background-color: #e5edf1;
  margin: 20px;
  padding: 30px;
}
.sectionDiv {
  outline: 2px dashed #92b0b3;
  width: 680px;
  height: 270px;
  text-align: center;
  //padding-top: 8em;
  display: inline-block;
  background-color: #e5edf1;
  margin: 20px;
  padding: none;


  /*
  min-height: 500px;
  height: 20em;
  padding: 0px 50px;
  color: black;
  display: inline-block;
  padding-top: 10em;
  background-image: radial-gradient(73% 147%, #eadfdf 59%, #ece2df 100%),
    radial-gradient(
      91% 146%,
      rgba(255, 255, 255, 0.5) 47%,
      rgba(0, 0, 0, 0.5) 100%
    );
  background-blend-mode: screen;
  */
}
.sectionDiv:hover {
  background-color: white;
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

.d_table {
  padding: 40px 5px 0px 10px;
  margin:2px;
  vertical-align:top;
}
.d_tr {
  vertical-align:top;
  margin:10px;
}
.d_td {
  display:inline-block;
  padding-left:10px;
  width:150px;
}
.d_submit {
  width:150px;
}

</style>