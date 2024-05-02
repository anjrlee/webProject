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