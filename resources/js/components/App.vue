<template>
    <div >
        <router-view></router-view>
      <div class="h-[100px] bg-black w-full fixed text-center flex ">
        <div class="absolute w-full h-[100px] flex flex-wrap justify-center items-center text-[30px] text-white">央氏世界紀錄</div>
        <div class="h-[70%] w-[66px] top-[15%] cursor-pointer absolute left-[2%]" @click="sideBarShowFun()">
            <div class="h-[10%] bg-white w-full relative top-[20%]"></div>
            <div class="h-[10%] bg-white w-full relative top-[40%]"></div>
            <div class="h-[10%] bg-white w-full relative top-[60%]"></div>
        </div>
        
        <div class="flex flex-wrap justify-center items-center h-full w-[10%] left-[85%] absolute cursor-pointer " ><router-link to="/profile"><img src="images/index/profile.png" class="w-4/5 h-4/5" /></router-link></div>

      </div>
      
      
      <div class="sideBar" v-if="sideBarShow">
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

        <div class="sideBarWord">
          <div class="sideBarTitle"><router-link to="/profile" >account</router-link></div>
        </div>

        

      </div>

      
      <div class="w-4/5 h-full absolute left-[20%] " v-if="sideBarShow" @click="sideBarShowDisable()"></div>

      <!-- Vue Router 代入的內容 -->
      
    </div>
</template>
<script setup>
import {ref} from 'vue'
const sideBarShow=ref(false);
function sideBarShowFun(){
   sideBarShow.value=true;
}

function sideBarShowDisable(){
  sideBarShow.value=false;
}
</script>
<style>
.sideBar{
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
  margin-left:15%;
  margin-bottom:5%;
}


.sideBarLink{
   color:white;
   position: relative;
   margin-left: 15%;
   margin-bottom: 5%;
   font-size: 20px;
}

.sideBarLink:hover{
  background-color: rgb(160, 160, 160);
}

.sideBarTitle{
   color:white;
   position: relative;
   font-weight: bold;
   font-size: 30px;
   margin-bottom: 5%;
}

.sideBarTitle:hover{
  background-color: rgb(160, 160, 160);
}




</style>