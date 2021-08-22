<template>
  <footer>
    <div class="bottom">
      <p>Hack The 6ix 2021 Submission | Geotab Challenge | Made by <a href="#">Gracie</a>.</p>
    </div>
  </footer>
</template>

<script>
export default {
  name: "Footer",
  components: {},
  data() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
//@import '../assets/scss/Footer.scss';
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
  text-decoration: none;
}
footer {
  width: 100%;
  //position: fixed;
  bottom: 0;
  left: 0;
  background: #111;
}
footer .article {
  max-width: 1350px;
  margin: auto;
  padding: 20px;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}
footer .article p,
a {
  color: #fff;
}
footer .article .box {
  width: 33%;
  transition: all 0.4s ease;
}
footer .article .topic {
  font-size: 22px;
  font-weight: 600;
  color: #fff;
  margin-bottom: 16px;
}
footer .article p {
  text-align: justify;
}
footer .article .lower .topic {
  margin: 24px 0 5px 0;
}
footer .article .lower i {
  padding-right: 16px;
}
footer .article .middle {
  padding-left: 80px;
}
footer .article .middle a {
  line-height: 32px;
}
footer .article .right input[type="text"] {
  height: 45px;
  width: 100%;
  outline: none;
  color: #d9d9d9;
  background: #000;
  border-radius: 5px;
  padding-left: 10px;
  font-size: 17px;
  border: 2px solid #222222;
}
footer .article .right input[type="submit"] {
  height: 42px;
  width: 100%;
  font-size: 18px;
  color: #d9d9d9;
  background: #15cffb;
  outline: none;
  border-radius: 5px;
  letter-spacing: 1px;
  cursor: pointer;
  margin-top: 12px;
  border: 2px solid #15cffb;
  transition: all 0.3s ease-in-out;
}
.article .right input[type="submit"]:hover {
  background: none;
  color: #15cffb;
}
footer .article .media-icons a {
  font-size: 16px;
  height: 45px;
  width: 45px;
  display: inline-block;
  text-align: center;
  line-height: 43px;
  border-radius: 5px;
  border: 2px solid #222222;
  margin: 30px 5px 0 0;
  transition: all 0.3s ease;
}
.article .media-icons a:hover {
  border-color: #15cffb;
}
footer .bottom {
  width: 100%;
  //text-align: right;
  text-align: center;
  color: #d9d9d9;
  padding: 0 40px 5px 0;
}
footer .bottom a {
  color: #15cffb;
}
footer a {
  transition: all 0.3s ease;
}
footer a:hover {
  color: #15cffb;
}
@media (max-width: 1100px) {
  footer .article .middle {
    padding-left: 50px;
  }
}
@media (max-width: 950px) {
  footer .article .box {
    width: 50%;
  }
  .article .right {
    margin-top: 40px;
  }
}
@media (max-width: 560px) {
  footer {
    position: relative;
  }
  footer .article .box {
    width: 100%;
    margin-top: 30px;
  }
  footer .article .middle {
    padding-left: 0;
  }
}
</style>