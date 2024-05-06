<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>央視世界紀錄</title>
    <link href="../css/app.css" rel="stylesheet">
  </head>
  <body>
    <div id="app">
      <!--<div class="links">
        <div class="title">央視世界紀錄</div>

      </div>
      <div class="sideBar">
        <div class="sideBarWord">Posts</div>
        <router-link to="/home">Home</router-link>
        <router-link to="/ExampleComponent">login</router-link>
      </div>-->

      <!-- Vue Router 代入的內容 -->
      <router-view></router-view>
      
    </div> 
    
    <!-- 引入 Vue app -->
    <script src="/js/app.js"></script>
  </body>
</html>
<style>
.links{
    top:0%;
    left:0%;
    height:15%;
    width:100%;
    position: absolute;
    background-color:rgb(116, 46, 46);
    text-align:center;
}

.title{
    position: relative;
    background-color: antiquewhite;
    color:rgb(0, 0, 0);
    font-size: 5vh;
    font-weight: bold;
    margin:10%;
}

.sideBar{
  height: 100%;
  position: absolute;
  width:20%;
  left:0%;
  top:0%;
  background-color: black;
}

.sideBarWord{
  position: relative;
  height: 30%;
  width:80%;
  background-color: white;
  margin:10%;
}

.test{
  width:100%;
  height:80%;
  position: absolute;
  background-color:rgb(48, 83, 114);
}

</style>