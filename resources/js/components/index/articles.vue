<template>
    <div class="container">
        <div class="w-3/5 absolute left-[20%] top-[18%] flex-wrap">
        <div class="h-2/5 relative mb-[5%]">
            <div class="w-1/5 left-[5%] h-1/5 relative mb-[2%] flex">
                <div class=" text-[2vw]">周刊</div>
                <div class="ml-[3%] text-[1.2vw] flex items-end cursor-pointer" @click="readMore('week')">{{ readMoreLess[MWData.week.readMoreLess] }}</div>
            </div>
            <div class="flex flex-wrap">
            <div class="relative h-[250px] w-[300px] ml-[4%] cursor-pointer" v-for="i in Wdata.slice(0,MWData.week.dataSlices)" @click="go(i.id)" >
                <posts class="h-4/5 w-full relative" :data="i"/>
                <div class="w-full h-1/5 relative text-[1.3vw] flex items-center justify-center">{{i.date}}</div>
           </div>
            </div>
        </div>

        <div class="h-2/5 relative mb-[5%]">
            <div class="w-1/5 left-[5%] h-1/5 relative mb-[2%] flex">
                <div class=" text-[2vw]">月刊</div>
                <div class="ml-[3%] text-[1.2vw] flex items-end cursor-pointer" @click="readMore('month')">{{ readMoreLess[MWData.month.readMoreLess]}}</div>
            </div>
            <div class="flex flex-wrap">
            <div class="relative h-[250px] w-[300px] ml-[4%] cursor-pointer" v-for="i in Mdata.slice(0,MWData.month.dataSlices)" @click="go(i.id)">
                <posts class="h-4/5 w-full relative" :data="i"/>
                <div class="w-full h-1/5 relative text-[1.3vw] flex items-center justify-center">{{i.date}}</div>
           </div>
            </div>
        </div>

       
        
       
          <!--<div class="relative h-[320px] w-[400px] m-[2%] cursor-pointer" v-for="i in data" @click="go(i.id)">
               <posts class="h-4/5 w-full relative" :data="i"/>
               <div class="w-full h-1/5 relative text-[1.3vw] flex items-center justify-center">{{i.title}}</div>
          </div>-->
          <div class="w-full h-[10%] relative"></div>
        </div>
       
    </div>
  </template>
  
  <script setup>

import data from "../../../../database/article.json";
import posts from "./posts.vue"
import {ref} from 'vue'

const readMoreLess=ref(["read more","read less"])

//console.log("test:",MWData.value.month.readMoreLess)
const Mdata=data.filter((data) => data.MW == "month");
const Wdata=data.filter((data) => data.MW == "week");
const MWData=ref({
    week:{
        readMoreLess:0,
        dataSlices:3,
        len:Wdata.length
    },
    month:{
        readMoreLess:0,
        dataSlices:3,
        len:Mdata.length
    }
})
function go(pass){
    window.location.href = "./articleRead/"+pass
}

function readMore(WM){
   // console.log(WM);
    console.log("test:",MWData.value[WM])
    console.log(Wdata)
    MWData.value[WM]['readMoreLess']=1^MWData.value[WM]['readMoreLess']
    MWData.value[WM]['dataSlices']=( MWData.value[WM]['readMoreLess']==0)?3:MWData.value[WM]['len']
}

  
</script>