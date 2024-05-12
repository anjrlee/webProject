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
    <router-view></router-view>
      <div class="h-[120px] bg-black w-full fixed text-center flex ">
        <div class="h-[72px] w-[3.5%] m-[1%] cursor-pointer" id="sideBarIcon">
            <div class="h-[10%] bg-white w-full relative m-[20%]"></div>
            <div class="h-[10%] bg-white w-full relative m-[20%]"></div>
            <div class="h-[10%] bg-white w-full relative m-[20%]"></div>
        </div>
        <div class="relative text-white text-[4.2vh] left-[35%] flex items-center">央視世界紀錄</div>
        <div class="h-full w-[100px] left-[72%] top-[10%] relative cursor-pointer" id="profile"><img src="images/index/profile.png" /></div>
      </div>
      
      
      <div class="sideBar" id="sideBar">
        <div class="h-[8%] w-5/6 bg-gray-200 m-[8%] rounded-full flex">
          <div class="left-[1%] top-[15%] w-[17%] h-[80%] relative"> <img src='images/index/searchIcon.png' alt="Search Icon"></div>
          <div class="w-[70%] h-[60%] top-[25%] left-[5%] relative">
              <input type="text" class="bg-transparent outline-none text-[1.1vw]"></input>
          </div>
        </div>

        <div class="sideBarWord">
        <div class="sideBarTitle"><router-link to="/">post</router-link></div>
        <div class="sideBarLink"><router-link to="/?id=relax">休閒類</router-link></div>
        <div class="sideBarLink"><router-link to="/?id=academic" >學術研究類</router-link></div>
        <div class="sideBarLink"><router-link to="/?id=campus" >校園生活類</router-link></div>
        </div>

        <div class="sideBarWord">
          <div class="sideBarTitle"><router-link to="/articles" >article</router-link></div>
        </div>

        <div class="sideBarWord">
          <div class="sideBarTitle"><router-link to="/addPost" >add my post</router-link></div>
        </div>

        

      </div>

      
      <div class="w-4/5 h-full absolute left-[20%] hidden " id="sideBarUndo"></div>

      <!-- Vue Router 代入的內容 -->
      
      
    </div> 
    
    <!-- 引入 Vue app -->
    <script src="/js/app.js"></script>
  </body>

</html>

<script>
    const sideBarUndo=document.querySelector("#sideBarUndo");
    const sideBar=document.querySelector("#sideBar");
    function sideBarDisplayNone(){
        sideBar.style.display="none";
        sideBarUndo.style.display="none";
    }
    document.querySelector("#sideBarIcon").addEventListener("click", function (e) {
            sideBar.style.display="block";
            sideBarUndo.style.display="block";
        
        
    });

    sideBarUndo.addEventListener("click", function (e) {
      sideBarDisplayNone()
    });

    document.querySelector("#profile").addEventListener("click", function (e) {
      location.href = './profile';
    });



    
</script>

<style>
.sideBar{
  display: none;
  height: 100%;
  position: fixed;
  background-color: black;
  width:400px;
  animation-name: sideBarAni;
  animation-duration: 1s;
}

@keyframes sideBarAni {
  0%   {left:-400px;}
  100% {left:0px;}
}

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
   font-size: 2.5vh;
}

.sideBarLink:hover{
  background-color: rgb(160, 160, 160);
}

.sideBarTitle{
   color:white;
   position: relative;
   margin:9%;
   font-weight: bold;
   font-size: 3.5vh;
}

.sideBarTitle:hover{
  background-color: rgb(160, 160, 160);
}




</style>