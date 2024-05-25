<template>
  <div class="container mt-[100px] z-[0] absolute">
    <div class="title"> 
      <div class="title-background"></div>
      <h1 class="title_text">{{ articleItem.title }}</h1>
    </div>

    <p class="info">{{ articleItem.author + " " + articleItem.date }}</p>
    <p class="info">{{ articleItem.type }}</p>

    <div class="image-section">
      <img :src="articleItem.cover" class="image">
    </div>

    <p>{{ articleItem.content }}</p><br><hr><br>
    
    <h2>相關連結:</h2>
    <div v-for="i in links">
      <a :href="i">{{ i }}</a><br> 
    </div>       
        
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import { useRoute } from 'vue-router'
const route = useRoute()
const id=route.params.id
console.log(id);

const link1 = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
const link2 = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
const link3 = "https://cn.vuejs.org/guide/essentials/reactivity-fundamentals.html";



const articleItem = reactive({
    email: "user1@gmail.com",
    title: "研究室周刊-xxx老師的研究室在幹嘛?",
    cover: "/images/post/bk_test3.jpg",
    author: "王小名",
    type: "歷史",
    date: "2024/5/15",
    content: "有一個關於羅馬帝國的有趣趣聞是關於凱撒大帝的狂妄與機智。據說，在公元前47年，凱撒大帝與埃及的執政官克雷奧帕特拉七世發生了一段奇妙的故事。當時，凱撒大帝在埃及遇到了困境，他被包圍在亞歷山大港。克雷奧帕特拉七世是埃及最後一位法老女王，她決定與凱撒合作。凱撒大帝聽說了一種被稱為“神秘的埃及方法”的奇特計畫。克雷奧帕特拉七世命令將她裝在一個捲起來的地毯裡，然後送給凱撒作為禮物。凱撒大帝好奇地打開地毯，只見一個美麗的女子出現在他面前。這一計策讓凱撒大帝異想天開，他對克雷奧帕特拉七世深感興趣，並最終與她建立了密切的關係。這個趣聞揭示了古代羅馬的政治和外交手段，以及凱撒大帝在面對困境時的機智和決斷力。"
})

const links = reactive( [ link1, link2, link3 ] );



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
