<template>
    <div class="container">
      <div class="w-[85%] absolute left-[7.5%] flex-wrap">
        <div class="h-2/5 relative mb-[3%]">
          <div class="w-1/5 left-[5%] h-1/5 relative mb-[2%] flex mt-[5%]">
            <div class="text-[2vw]">周刊</div>
            <div class="ml-[3%] text-[1.2vw] flex items-end cursor-pointer" @click="readMore('week')">{{ readMoreLess[MWData.week.readMoreLess] }}</div>
          </div>
          <div class="flex flex-wrap">
            <div class="relative h-[250px] w-[300px] ml-[4%] cursor-pointer mb-[5%]" v-for="i in Wdata.slice(0, MWData.week.dataSlices)" :key="i.id" @click="go(i.id)">
              <posts class="h-4/5 w-full relative" :data="i"/>
              <div class="w-full h-1/5 relative text-[1.3vw] flex items-center justify-center top-[10%]">{{ i.title }}</div>
            </div>
          </div>
        </div>
  
        <div class="h-2/5 relative mb-[5%]">
          <div class="w-1/5 left-[5%] h-1/5 relative mb-[2%] flex">
            <div class="text-[2vw]">月刊</div>
            <div class="ml-[3%] text-[1.2vw] flex items-end cursor-pointer" @click="readMore('month')">{{ readMoreLess[MWData.month.readMoreLess] }}</div>
          </div>
          <div class="flex flex-wrap">
            <div class="relative h-[250px] w-[300px] ml-[4%] cursor-pointer mb-[5%]" v-for="i in Mdata.slice(0, MWData.month.dataSlices)" :key="i.id" @click="go(i.id)">
              <posts class="h-4/5 w-full relative" :data="i"/>
              <div class="w-full h-1/5 relative text-[1.3vw] flex items-center justify-center top-[10%] " ><div v-if="i.title.length>20">{{ i.title.substr(0,20)+"..." }}</div><div v-else>{{ i.title }}</div></div>
            </div>
          </div>
        </div>
  
        <div class="w-full h-[10%] relative"></div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import posts from './posts.vue';
  
  const readMoreLess = ref(["read more", "read less"]);
  
  const Wdata = ref([]);
  const Mdata = ref([]);
  const MWData = ref({
    week: {
      readMoreLess: 0,
      dataSlices: 3,
      len: 0
    },
    month: {
      readMoreLess: 0,
      dataSlices: 3,
      len: 0
    }
  });
  
  const fetchArticles = async () => {
    try {
      const response = await axios.get('/api/articles');
      const articles = response.data;
  
      Wdata.value = articles.filter(article => article.MW === 'week');
      Mdata.value = articles.filter(article => article.MW === 'month');
  
      MWData.value.week.len = Wdata.value.length;
      MWData.value.month.len = Mdata.value.length;
    } catch (error) {
      console.error('Failed to fetch articles:', error);
    }
  };
  
  const go = (pass) => {
    window.location.href = `./articleRead/${pass}`;
  };
  
  const readMore = (WM) => {
    MWData.value[WM].readMoreLess = 1 ^ MWData.value[WM].readMoreLess;
    MWData.value[WM].dataSlices = (MWData.value[WM].readMoreLess === 0) ? 3 : MWData.value[WM].len;
  };
  
  onMounted(fetchArticles);
  </script>
  