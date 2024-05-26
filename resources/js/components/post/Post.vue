<template>
  <div class="container mt-[100px] z-[0] absolute">
    <div class="title"> 
      <div class="title-background"></div>
      <h1 class="title_text">{{ recordItem.title}}</h1>
    </div>

    <div class="image-section">
      <img :src= "recordItem.cover" class="image">

    </div>

    <div class="info-section">
      <img class="icon" src="/images/post/0.png">
      <h2>發文者: </h2><br>
      <router-link :to="'/userprofile/' + recordItem.user_id" class="info-detail">
        <p>{{ recordItem.username }}</p>
      </router-link>
      <img class="icon" src="/images/post/1.png">
      <h2>紀錄保持人: </h2><br>
      <p class="info-detail">{{ recordItem.recorder }}</p><br>
      <img class="icon" src="/images/post/2.png">
      <h2>紀錄: </h2><br>
      <p class="info-detail">{{ recordItem.recordScore }}</p><br>
      <img class="icon" src="/images/post/3.png">
      <h2>完成日期: </h2><br>
      <p class="info-detail"> {{ recordItem.date }}</p><br>
      <img class="icon" src="/images/post/4.png">
      <h2>種類: </h2><br>
      <p class="info-detail">{{ getTypeLabel(recordItem.type) }}</p><br>
    </div>

    <div class="award-section">
      <h2>得獎感言: </h2><br>
      <p>{{ recordItem.awardSpeech }}</p><br>
    </div>
  
  </div>
</template>
  
<script>
import axios from 'axios';
import { useRoute } from 'vue-router';

export default {
  data() {
    return {
      recordItem: {
        title: '',
        cover: '',
        recorder: '',
        recordScore: '',
        date: '',
        type: '',
        awardSpeech: '',
        user_id: '',
        username: '',
        id:''
      }
    };
  },
  methods: {
    getTypeLabel(type) {
      switch (type) {
        case 'study':
          return '學術研究類';
        case 'leisure':
          return '休閒類';
        case 'campus':
          return '校園生活類';
        default:
          return '';
      }
    },
    async fetchRecordItem() {
      const route = useRoute();
      const id = route.params.id;

      try {
        const response = await axios.get(`/api/post/${id}`);
        this.recordItem = response.data;

        // Fetch user's name based on user_id
        this.fetchUserName(this.recordItem.user_id);
      } catch (error) {
        console.error('Failed to fetch record item:', error);
      }
    },
    async fetchUserName(userId) {
      try {
        const response = await axios.get(`/api/userprofile/${userId}`);
        console.log('User profile data:', response.data);
        this.recordItem.username = response.data.name;
        this.recordItem.id = response.data.user_id;
      } catch (error) {
        console.error('Failed to fetch user name:', error);
      }
    }
  },

  mounted() {
    this.fetchRecordItem();
  }
};
</script>
  
<style scoped>

.container{
  left: 50%;
  transform: translate(-50%, 0%);
}
  
.title {
  position: relative; /* 使得內容可以相對於標題容器定位 */
  margin-top: 20px;
  margin-bottom: 50px;
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
  background-image: url('/images/post/title_bk.png'); 
  background-size: cover; /* 自動調整背景圖片大小以填滿容器 */
  background-position: center; 
  opacity: 1; /* 設置背景圖片透明度，根據需要調整 */
  z-index: -1; /* 將背景圖片放到標題容器的底層 */
}
  
.info-section {
  width: 40%;
  float: right;
}
  
.image-section {
  float: left;
  width: 50%;
  border: 2px solid gray;
}
  
.image {
  width: 100%; 
  max-height: 500px; 
  height: auto;
  object-fit: cover; /* 保持比例填滿容器 */
}
  
.award-section {
  clear: both;
  margin-top: 50px;
  border-top: 1px solid black; /* 添加分隔線 */
  padding-top: 10px;
}
  
.icon{
  max-width: 40px;
  height: auto;
  float: left;
  margin-right: 10px;
}

.info-detail{
  text-align: center;
}

</style>