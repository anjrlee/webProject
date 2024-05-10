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
      <div class="h-[15%] bg-black w-full absolute text-center flex">
        <div class="h-5/6 w-[4%] relative m-[1%] cursor-pointer">
            <div class="h-[10%] bg-white w-full relative m-[20%]"></div>
            <div class="h-[10%] bg-white w-full relative m-[20%]"></div>
            <div class="h-[10%] bg-white w-full relative m-[20%]"></div>
        </div>
        <div class="relative text-white text-[3vw] left-[35%] flex items-center">央視世界紀錄</div>
      </div>
      
      <!--<div class="h-full absolute bg-black w-1/5">
        <div class="h-[8%] w-5/6 bg-gray-200 m-[8%] rounded-full flex">
          <div class="left-[1%] top-[15%] w-[17%] h-[80%] relative"> <img src='images/searchIcon.png' alt="Search Icon"></div>
          <div class="w-[70%] h-[60%] top-[23%] left-[5%] relative">
              <input type="text" class="bg-transparent outline-none"></input>
          </div>
        </div>


        <div class="sideBarWord">
        <div class="sideBarTitle">post</div>
        <div class="sideBarLink"><router-link to="/home">休閒類</router-link></div>
        <div class="sideBarLink"><router-link to="/ExampleComponent" >學術研究類</router-link></div>
        <div class="sideBarLink"><router-link to="/ExampleComponent" >校園生活類</router-link></div>
        </div>

        <div class="sideBarWord">
          <div class="sideBarTitle"><router-link to="/ExampleComponent" >article</router-link></div>
        </div>

        <div class="sideBarWord">
          <div class="sideBarTitle"><router-link to="/ExampleComponent" >add my post</router-link></div>
        </div>

        

      </div>-->

      <!-- Vue Router 代入的內容 -->
      <router-view></router-view>
      
    </div> 
    
    <!-- 引入 Vue app -->
    <script src="/js/app.js"></script>
  </body>
</html>
<style>
.sideBarWord{
  position: relative;
  width:80%;
  margin:15%;
}


.sideBarLink{
   color:white;
   position: relative;
   margin-left: 15%;
   margin-bottom: 5%;
}

.sideBarTitle{
   color:white;
   position: relative;
   margin:9%;
   font-weight: bold;
   font-size: 1.7vw;
}
</style>