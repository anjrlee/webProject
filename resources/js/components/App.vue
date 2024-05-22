<template>
    <div >
        <router-view></router-view>
      <div class="h-[100px] bg-black w-full fixed text-center flex z-[50]">
        <div class="absolute w-full h-[100px] flex flex-wrap justify-center items-center text-[30px] text-white">央氏世界紀錄</div>
        <div class="h-[70%] w-[66px] top-[15%] cursor-pointer absolute left-[2%]" @click="sideBarShowFun()">
            <div class="h-[10%] bg-white w-full relative top-[20%]"></div>
            <div class="h-[10%] bg-white w-full relative top-[40%]"></div>
            <div class="h-[10%] bg-white w-full relative top-[60%]"></div>
        </div>
        <div class="absolute top-[15%] right-[2%] transform [-translate-y-1/2]">
        <button @click="goToProfile" class="text-white">
            <img src="/images/index/profile.png" alt="Profile" class="w-[80px] h-auto" />
        </button>
      </div>
        

      </div>
      
      
      <div class="sideBar" v-if="sideBarShow">
        <div class="h-[3%] w-5/6 bg-gray-200 m-[8%] rounded-full flex">
          <div class="left-[1%] top-[15%] w-[17%] h-[80%] relative"> <img src='images/index/searchIcon.png' alt="Search Icon"></div>
          <div class="w-[70%] h-[60%] top-[25%] left-[5%] relative">
              <input type="text" class="bg-transparent outline-none text-[1.1vw]">
          </div>
        </div>

        <div class="sideBarWord">
        <div class="sideBarTitle"><router-link to="/" style="text-decoration: none; color: white;">post</router-link></div>
        <div class="sideBarLink"><router-link to="/?id=relax" style="text-decoration: none; color: white;">休閒類</router-link></div>
        <div class="sideBarLink"><router-link to="/?id=academic" style="text-decoration: none; color: white;">學術研究類</router-link></div>
        <div class="sideBarLink"><router-link to="/?id=campus" style="text-decoration: none; color: white;">校園生活類</router-link></div>
        </div>

        <div class="sideBarWord">
          <div class="sideBarTitle"><router-link to="/articles" style="text-decoration: none; color: white;">article</router-link></div>
        </div>

        <div class="sideBarWord">
          <div class="sideBarTitle"><router-link to="/addPost" style="text-decoration: none; color: white;">add my post</router-link></div>
        </div>

        <div class="sideBarWord">
          <div class="sideBarTitle"><router-link to="/login" style="text-decoration: none; color: white;" v-if="!ifLogin">Login</router-link></div>
        </div>

        <div class="sideBarWord">
          <div class="sideBarTitle"><router-link to="/profile" style="text-decoration: none; color: white;"  v-if="ifLogin">profile</router-link></div>
        </div>

        

      </div>

      
      

      <!-- Vue Router 代入的內容 -->
      
    </div>
</template>
<script setup>
import {ref} from 'vue'
import { useRouter } from 'vue-router';
const sideBarShow=ref(false);
var ifLogin=false;

const router = useRouter();
const goToProfile = () => {
    router.push('/profile').then(() => {
        router.go(0); // 重新加載頁面
    });
};


function sideBarShowFun(){
   sideBarShow.value=!sideBarShow.value;
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
  text-decoration: none;
}

.router-link-active {
  text-decoration: none;
  color:white;
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