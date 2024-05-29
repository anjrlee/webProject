<template>
  <div class="container mt-[100px] z-[0] absolute">
    <div class="title"> 
      <div class="title-background"></div>
      <h1 class="title_text">{{ articleItem.title }}</h1>
    </div>

    <p class="info">{{ articleItem.date }}</p>
    <p class="info">{{ articleItem.type }}</p>

    <div class="image-section">
      <img :src="articleItem.cover" class="image">
    </div>

    <p>{{ articleItem.content }}</p><br><hr><br>
    
    <h2>相關連結:</h2>
    <div v-if="articleItem.links && articleItem.links.length">
      <div v-for="link in articleItem.links" :key="link.id" style="margin-bottom: 50px;">
        <a :href="link.link" >{{ link.link }}</a><br> 
      </div>       
    </div>
    <div v-else>
      <p>No related links</p>
    </div>
  </div>
  <el-backtop :bottom="50" style="width: 70px; height:70px;">
    <div
      style="
        background-color: white;
        text-align: center;
        color: rgb(62, 44, 26);
        border-radius: 20px;
      "
    >
    <font-awesome-icon :icon="['fas', 'angles-up']" style="width: 50px;" />
    </div>
  </el-backtop>
</template>

<script setup>
import { reactive, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import { ElBacktop } from 'element-plus';

const route = useRoute();
const id = route.params.id;

const articleItem = reactive({
    email: "",
    title: "",
    cover: "",
    author: "",
    type: "",
    date: "",
    content: "",
    links: []
});

// Function to fetch the article by ID
const fetchArticle = async () => {
    try {
        const response = await axios.get(`/api/articles/${id}`);
        const article = response.data;

        // Update articleItem with data from the response
        articleItem.email = article.email;
        articleItem.title = article.title;
        articleItem.cover = article.cover || '/images/articleImg/default.jpg';
        articleItem.author = article.author;
        articleItem.type = article.type;
        articleItem.date = article.date;
        articleItem.content = article.content;
        articleItem.links = article.links ? article.links : [];
    } catch (error) {
        console.error('Failed to fetch article:', error);
    }
};

onMounted(fetchArticle);
</script>







<style scoped>

.container{
  left: 50%;
  transform: translate(-50%, 0%);
}

.title {
  position: relative; /* 使得內容可以相對於標題容器定位 */
  margin-top: 20px;
  margin-bottom: 20px;
  text-align: center;
  border: 2px solid gray;
  word-wrap: break-word;
}

.title_text{
  width: 60%;
  margin: 0 auto;
  text-align: center;
}

.title-background {
  position: absolute; /* 相對於標題容器定位 */
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('/images/post/title_bk.png'); /* 底圖路徑 */
  background-size: cover; /* 自動調整背景圖片大小以填滿容器 */
  background-position: center; /* 將背景圖片置中 */
  opacity: 0.5; /* 設置背景圖片透明度，根據需要調整 */
  z-index: -1; /* 將背景圖片放到標題容器的底層 */
}

.image-section {
    display: flex;
    justify-content: center;
    margin-bottom: 50px;
  }
  
.image {
  width: 50%; /* 設置圖片的最大寬度 */
  max-height: 500px; /* 設置最大高度 */
  height: auto;
  object-fit: cover; /* 保持比例填滿容器 */
  border: 2px solid gray;
}

.info{
  display: flex;
  justify-content: right;
}



</style>
