

<template>
    <div class="container">
      
        <div class="w-4/5 h-4/5 absolute left-[14%] flex top-[20%] flex-wrap">
          <div class="relative h-[300px] w-[300px]  ml-[3%] mb-[5%] cursor-pointer" v-for="i in data" @click="go(i.id)">
               <posts class="bg-white h-4/5 w-full relative" :data="i"/>
               <div class="w-full h-1/5 relative text-[20px] flex items-center justify-center">{{i.title}}</div>
          </div>
         
        </div>
       
    </div>
  </template>
  
<script setup>
import { ref, watch } from 'vue';
import { useRoute } from 'vue-router'
import record from "../../../../database/record.json";
import posts from "./posts.vue"
const route = useRoute()
var category=ref(route.query.id)
var data=ref('')

function go(pass){
    window.location.href = "./post/"+pass
}

function dataAssign(){
  if(typeof category=='undefined'||typeof category.length=='undefined'){
    data=record

  }else{
    data=record.filter((record) => record.type == category);
  }
}


watch(() => route.query.id, (newValue, oldValue) => {
  category=newValue
  dataAssign();
});

dataAssign();
  
</script>