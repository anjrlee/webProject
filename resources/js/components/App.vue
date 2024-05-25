<template>
  <div @click="handleOutsideClick">
    <div class="bg"></div>
    <router-view></router-view>
    <div class="head h-[100px] w-full fixed text-center flex z-[50] bg-opacity-75 top-0">
      <router-link to="/" class="absolute w-full h-[100px] flex flex-wrap justify-center items-center text-[35px] font-bold " style="color: black; text-decoration: none;">
        央氏世界紀錄
      </router-link>
      <div class="h-[70%] w-[66px] top-[15%] cursor-pointer absolute left-[2%]" @click.stop="sideBarShowFun">
        <div class="h-[10%] bg-black w-full relative top-[20%]"></div>
        <div class="h-[10%] bg-black w-full relative top-[40%]"></div>
        <div class="h-[10%] bg-black w-full relative top-[60%]"></div>
      </div>
      <div class="absolute top-[15%] right-[2%] transform [-translate-y-1/2]">
        <a href="/profile" @click="goToProfile" class="text-white">
          <img src="/images/index/profile.png" alt="Profile" class="w-[80px] h-auto" />
        </a>
      </div>
    </div>

    <div :class="['sideBar', sideBarShow ? 'show' : 'hide']" >
      <div class="h-[7%] w-5/6 m-[8%] flex"></div>
      <div class="sideBarWord">
        <div class="sideBarTitle">
          <font-awesome-icon :icon="['fab', 'readme']" class="mr-[2%]" />
          <router-link to="/" style="text-decoration: none; color: black;" @click="sideBarShowFun">post</router-link>
        </div>
        <div class="sideBarLink">
          <router-link to="/?id=relax" style="text-decoration: none; color: black;" @click="sideBarShowFun">休閒類</router-link>
        </div>
        <div class="sideBarLink">
          <router-link to="/?id=academic" style="text-decoration: none; color: black;" @click="sideBarShowFun">學術研究類</router-link>
        </div>
        <div class="sideBarLink">
          <router-link to="/?id=campus" style="text-decoration: none; color: black;" @click="sideBarShowFun">校園生活類</router-link>
        </div>
      </div>
      <div class="sideBarWord">
        <div class="sideBarTitle">
          <font-awesome-icon :icon="['fas', 'newspaper']" class="mr-[3%]" />
          <router-link to="/articles" style="text-decoration: none; color: black;" @click="sideBarShowFun">article</router-link>
        </div>
      </div>
      <div class="sideBarWord">
        <div class="sideBarTitle">
          <font-awesome-icon :icon="['fas', 'pencil']" class="mr-[3%]" />
          <a href="/addpost" style="text-decoration: none; color: black;" @click="sideBarShowFun">add my post</a>
        </div>
      </div>
      <div class="sideBarWord">
        <div class="sideBarTitle" v-if="!ifLogin">
          <font-awesome-icon :icon="['fas', 'user']" class="mr-[3%]" />
          <router-link to="/login" style="text-decoration: none; color: black;" @click="sideBarShowFun">Login</router-link>
        </div>
      </div>
      <div class="sideBarWord">
        <div class="sideBarTitle" v-if="ifLogin">
          <font-awesome-icon :icon="['fas', 'user']" class="mr-[3%]" />
          <router-link to="/profile" style="text-decoration: none; color: white;" @click="sideBarShowFun">profile</router-link>
        </div>
      </div>
      <div class="sideBarWord">
        <div class="sideBarTitle" >
          <!-- //administrator icon -->
          <font-awesome-icon :icon="['fas', 'user-shield']" class="mr-[3%]" />
          <a href="/verifyredirect" style="text-decoration: none; color: black;" @click="logout">administrator</a>
        </div>
      </div>
    </div>
  </div>
  <div v-if="sideBarShow" class="overlay" @click="sideBarShowFun"></div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useRouter } from 'vue-router';

const sideBarShow = ref(false);
const sideBarShowStart = ref(false);
var ifLogin = false;

const router = useRouter();

function sideBarShowFun() {
  sideBarShowStart.value = true;
  sideBarShow.value = !sideBarShow.value;

  if (!sideBarShow.value) {
    setTimeout(() => {
      sideBarShowStart.value = false;
    }, 300); 
  }
}

function handleOutsideClick(event) {
  if (sideBarShow.value && !event.target.closest('.sideBar')) {
    sideBarShowFun();
  }
}

function handleScroll() {
  if (sideBarShow.value) {
    sideBarShowFun();
  }
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});
</script>


<style scoped>
.sideBar {
  top: 0;
  z-index: 2;
  height: 100%;
  position: fixed;
  background-color: rgb(213, 199, 188);
  width: 400px;
  transition: transform 0.1s ease-in-out;
  transform: translateX(-100%);
}

.sideBar.show {
  transform: translateX(0);
}

.sideBar.hide {
  transform: translateX(-100%);
}

.head {
  background-color: rgb(213, 199, 188);
}

.sideBarWord {
  position: relative;
  width: 80%;
  margin-left: 15%;
  margin-bottom: 5%;
  text-decoration: none;
}

.router-link-active {
  text-decoration: none;
}

.sideBarLink {
  position: relative;
  margin-left: 15%;
  margin-bottom: 5%;
  font-size: 20px;
}

.sideBarLink:hover {
  background-color: rgb(160, 160, 160);
}

.sideBarTitle {
  color: rgb(0, 0, 0);
  position: relative;
  font-weight: bold;
  font-size: 30px;
  margin-bottom: 5%;
}

.sideBarTitle:hover {
  background-color: rgb(160, 160, 160);
}

.bg {
  position: absolute;
  width: 100%;
  height: 100%;
  position: fixed;
  background-color: rgb(241, 228, 228);
  z-index: -1;
  background-repeat: repeat-y;
}

.container {
  margin-top: 100px;
}
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(199, 199, 199, 0.5);
  z-index: 1;
}

</style>
