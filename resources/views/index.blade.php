<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
  </head>
  <body>
    <div id="app">
      <div class="links">
        <!-- 建立 Vue Router 連結-->
        <div class="title">央視世界紀錄</div>
        <router-link to="/home">Home</router-link>
        <router-link to="/ExampleComponent">login</router-link>
      </div>

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
    background-color:black;
    text-align:center;
}

.title{
    color:white;
    font-size: 5vh;
    font-weight: bold;
}
</style>