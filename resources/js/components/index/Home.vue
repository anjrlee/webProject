<template>
  <div class="container">
    <div class="w-4/5 h-4/5 absolute left-[10%] flex top-[20%] flex-wrap">
      <div
        class="relative h-[300px] w-[300px] ml-[3%] mb-[5%] cursor-pointer" v-for="i in data" :key="i.id"
        @click="go(i.id)">
        <posts class="bg-white h-4/5 w-full relative" :data="i" />
        <div class="w-full h-1/5 relative text-[20px] flex items-center justify-center">
          <div v-if="i.title.length>15">{{ i.title.substr(0,15)+"..." }}</div><div v-else>{{ i.title }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import posts from './posts.vue';

const route = useRoute();
const category = ref(route.query.id);
const data = ref([]);

async function fetchData() {
  try {
    const response = await axios.get('/api/posts', {
      params: {
        type: category.value,
      },
    });
    data.value = response.data;
  } catch (error) {
    console.error('Failed to fetch data:', error);
  }
}


function go(pass) {
  window.location.href = `./post/${pass}`;
}

watch(
  () => route.query.id,
  (newValue) => {
    category.value = newValue;
    fetchData();
  }
);

fetchData();
</script>
