<template>
  <div class="container mt-[100px] z-[0] absolute">
    <div class="title"> 
      <div class="title-background"></div>
      <h1 class="title_text">{{ recordItem.title }}</h1>
    </div>
    
    <div class="main-content">
      <div class="image-section">
        <img :src="recordItem.cover" alt="Cover Image" class="image">
      </div>
      
      <div class="award-section">
        <h2 class="award-title">得獎感言:</h2>
        <p class="award-speech">{{ recordItem.awardSpeech }}</p>
      </div>
    </div>

    <div class="info-section">
      <div class="info-item">
        <img class="icon" src="/images/post/0.png">
        <h2 class="info-title">發文者:</h2>
        <router-link :to="'/userprofile/' + recordItem.user_id">
          <div class="router-sec">
            <p>{{ recordItem.username }}</p>
          </div>
        </router-link>
      </div>
      
      <div class="info-item">
        <img class="icon" src="/images/post/1.png">
        <h2 class="info-title">紀錄保持人:</h2>
        <p class="info-detail">{{ recordItem.recorder }}</p>
      </div>
      
      <div class="info-item">
        <img class="icon" src="/images/post/2.png">
        <h2 class="info-title">紀錄:</h2>
        <p class="info-detail">{{ recordItem.recordScore }}</p>
      </div>
      
      <div class="info-item">
        <img class="icon" src="/images/post/3.png">
        <h2 class="info-title">完成日期:</h2>
        <p class="info-detail">{{ recordItem.date }}</p>
      </div>
      
      <div class="info-item">
        <img class="icon" src="/images/post/4.png">
        <h2 class="info-title">種類:</h2>
        <p class="info-detail">{{ recordItem.type }}</p>
      </div>
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
    async fetchRecordItem() {
      const id = this.$route.params.id;

      try {
        const response = await axios.get(`/api/post/${id}`);
        const record = response.data;
        this.recordItem = response.data;
        this.recordItem.cover = record.cover || '/images/recordImg/default.jpg';
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
.container {
  left: 50%;
  transform: translate(-50%, 0%);
  max-width: 1200px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #fff;
}

.title {
  position: relative;
  margin-top: 20px;
  margin-bottom: 50px;
  word-wrap: break-word;
  text-align: center;
}

.title_text {
  margin: 0 auto;
  text-align: center;
}

.title-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('/images/post/title_bk.png');
  background-size: cover;
  background-position: center;
  border-radius: 10px;
  opacity: 1;
  z-index: -1;
}

.main-content {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.image-section {
  width: 100%;
  max-width: 800px;
  border: 2px solid gray;
  margin-bottom: 20px;
}

.image {
  width: 100%;
  max-height: 500px;
  height: auto;
  object-fit: cover;
}

.award-section {
  width: 100%;
  text-align: center;
  border-top: 1px solid black;
  padding-top: 20px;
  margin-bottom: 40px;
}

.award-speech {
  font-size: 20px;
  margin-top: 10px;
  text-align: left;
}

.info-section {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}

.info-item {
  width: calc(50% - 20px);
  margin: 10px;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  background-color: rgb(213, 199, 188);
}

.icon {
  max-width: 40px;
  height: auto;
  margin-bottom: 10px;
}

.info-title {
  font-size: 25px;
  margin-bottom: 10px;
}

.info-detail, .router-sec p {
  font-size: 20px;
  margin: 0;
}

.router-sec {
  padding: 10px;
  border-radius: 10px;
  margin: 0 auto;
  width: fit-content;
}

.award-title{
  text-align: left;
  font-size: 25px;
  margin-bottom: 10px;
}
</style>
