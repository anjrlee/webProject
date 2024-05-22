<template>
    <div >
        <div class="bg"></div>
      <router-view></router-view>
      <div class="h-[100px] bg-white w-full fixed text-center flex z-[50]  bg-opacity-75">
        <div class="absolute w-full h-[100px] flex flex-wrap justify-center items-center text-[35px] font-bold">央氏世界紀錄</div>
        <div class="h-[70%] w-[66px] top-[15%] cursor-pointer absolute left-[2%]" @click="sideBarShowFun()">
            <div class="h-[10%] bg-black w-full relative top-[20%]"></div>
            <div class="h-[10%] bg-black w-full relative top-[40%]"></div>
            <div class="h-[10%] bg-black w-full relative top-[60%]"></div>
        </div>
        
        

      </div>
      
      
      <div class="sideBar" v-if="sideBarShow">
        <div class="h-[4%] w-5/6 bg-gray-200 m-[8%] rounded-full flex">
          <div class="left-[1%] top-[15%] w-[17%] h-[80%] relative"></div>
          <div class="w-[70%] h-[60%] top-[25%] left-[5%] relative">
              <input type="text" class="bg-transparent outline-none text-[1.1vw]"></input>
          </div>
        </div>

        <div class="sideBarWord">
        <div class="sideBarTitle"> <font-awesome-icon :icon="['fab', 'readme']" class=" mr-[2%]"/> <router-link to="/" style="text-decoration: none;color:black;">post</router-link></div>
        <div class="sideBarLink"><router-link to="/?id=relax" style="text-decoration: none; color:black;">休閒類</router-link></div>
        <div class="sideBarLink"><router-link to="/?id=academic" style="text-decoration: none; color:black;">學術研究類</router-link></div>
        <div class="sideBarLink"><router-link to="/?id=campus" style="text-decoration: none; color:black;">校園生活類</router-link></div>
        </div>

        <div class="sideBarWord">
          <div class="sideBarTitle"> <font-awesome-icon :icon="['fas', 'newspaper']" class="  mr-[3%]" /><router-link to="/articles" style="text-decoration: none; color:black;">article</router-link></div>
        </div>

        <div class="sideBarWord">
          <div class="sideBarTitle"><font-awesome-icon :icon="['fas', 'pencil']" class=" mr-[3%]"/><router-link to="/addPost" style="text-decoration: none; color:black;">add my post</router-link></div>
        </div>

        <div class="sideBarWord">
          <div class="sideBarTitle"  v-if="!ifLogin"><font-awesome-icon :icon="['fas', 'user']" class=" mr-[3%]" /><router-link to="/login" style="text-decoration: none; color:black;">Login</router-link></div>
        </div>

        
       
        
      
        <div class="sideBarWord">
          <div class="sideBarTitle"  v-if="ifLogin"><font-awesome-icon :icon="['fas', 'user']" class="mr-[3%]" /><router-link to="/profile" style="text-decoration: none; color: white;" >profile</router-link></div>
        </div>

        

      </div>

      
     

      <!-- Vue Router 代入的內容 -->
      
    </div>
</template>
<script setup>
import {ref} from 'vue'
const sideBarShow=ref(false);
var ifLogin=false;


function sideBarShowFun(){
   sideBarShow.value=!sideBarShow.value;
}


</script>
<style>
.sideBar{
  height: 100%;
  position: fixed;
  background-color: rgb(255, 255, 255,0.75);
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
  text-decoration: none;
}

.router-link-active {
  text-decoration: none;

}

.sideBarLink{
   
   position: relative;
   margin-left: 15%;
   margin-bottom: 5%;
   font-size: 20px;
 
}

.sideBarLink:hover{
  background-color: rgb(160, 160, 160);
}

.sideBarTitle{
  
   color:rgb(0, 0, 0);
   position: relative;
   font-weight: bold;
   font-size: 30px;
   margin-bottom: 5%;

}

.sideBarTitle:hover{
  background-color: rgb(160, 160, 160);
}

.bg{
  position: absolute;
    width: 100%;
    height: 100%;
    position: fixed;
    background-image: url('/images/login/login_bg.jpg');
    background-size: cover;
    opacity: 0.2;
    z-index: -1;
    background-repeat: repeat-y;

}



</style>