

<template>
    <div class="container">
      
        <div class="w-4/5 h-4/5 absolute left-[10%] flex top-[30%] flex-wrap">
          <div class="relative h-[300px] w-[300px]  ml-[3%] cursor-pointer" v-for="i in data" @click="go(i.id)">
               <posts class="bg-white h-4/5 w-full relative" :data="i"/>
               <div class="w-full h-1/5 relative text-[20px] flex items-center justify-center">{{i.title}}</div>
          </div>
          <div class="w-full h-[10%] relative"></div>
        </div>
       
    </div>
  </template>
  
<script setup>
import { ref, watch } from 'vue';
import { useRoute } from 'vue-router'
import record from "../../../../database/record.json";
import posts from "./posts.vue"
const route = useRoute()
var keyWord=ref(route.query.id)
var data=ref('')

function go(pass){
    window.location.href = "./post/"+pass
}

function dataAssign(){
    data=record.filter((record) => record.title.includes(keyWord));
}


watch(() => route.query.id, (newValue, oldValue) => {
    keyWord=newValue
  dataAssign();
});

dataAssign();
  
</script>