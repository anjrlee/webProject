<template>
    <div class="container">
      
        <div class="w-4/5 h-4/5 absolute left-[13%] flex top-[15%] flex-wrap">
          <div class="relative h-[320px] w-[400px]  m-[2%] cursor-pointer" v-for="i in data" @click="go(i.id)">
               <posts class="bg-white h-4/5 w-full relative" :data="i"/>
               <div class="w-full h-1/5 relative text-[1.3vw] flex items-center justify-center">{{i.title}}</div>
          </div>
          <div class="w-full h-[10%] relative"></div>
        </div>
       
    </div>
  </template>
  
  <script setup>

import data from "../../../../database/article.json";
import posts from "./posts.vue"


function go(pass){
    window.location.href = "./post/"+pass
}
  
</script>