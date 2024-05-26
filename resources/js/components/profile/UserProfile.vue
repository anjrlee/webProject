<template>
    <div class="container mt-[100px] z-[0] absolute">
      <div class="row justify-content-center mt-4">
        <div class="col">
          <h3 class="display-6 d-inline"><strong>個人資料</strong></h3>
          <div class="line mt-3"></div>
          <div class="mt-4 mb-3">
            <p id="name">姓名：{{ profile.name }}</p>
          </div>
          <div class="mt-4 mb-3">
            <p id="gender">性別：{{ profile.gender }}</p>
          </div>
          <div class="mt-4 mb-3">
            <p id="departmentGrade">系級：{{ profile.department }} {{ profile.grade }}</p>
          </div>
          <div class="mt-4 mb-3">
            <p id="email">Email：{{ profile.email }}</p>
          </div>
          <div class="mt-4 mb-3">
            <p id="bio">自我介紹：{{ profile.bio }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        profile: {
          name: '',
          gender: '',
          email: '',
          bio: '',
          department: '',
          grade: ''
        },
        isOwnProfile: false,
        loggedInUser: null
      };
    },
    mounted() {
      this.fetchUserProfile();
  
      const userMetaTag = document.querySelector("meta[name='user']");
      if (userMetaTag) {
        try {
          this.loggedInUser = JSON.parse(userMetaTag.getAttribute('content'));
          this.isOwnProfile = this.loggedInUser.username === this.$route.params.username;
        } catch (error) {
          console.error('Failed to parse user meta tag content:', error);
        }
      }
    },
    methods: {
      fetchUserProfile() {
        const username = this.$route.params.name;
  
        axios.get(`/api/userprofile/${id}`)
          .then(response => {
            this.profile = response.data;
          })
          .catch(error => {
            console.error('Failed to fetch user profile:', error);
          });
      }
    },
    watch: {
      '$route.params.email': 'fetchUserProfile'
    }
  };
  </script>
  
  <style scoped>
  .container {
    left: 50%;
    transform: translate(-50%, 0%);
  }
  
  .line {
    height: 1%;
    border-top: solid #000000;
  }
  
  p {
    font-size: 1.5rem;
  }
  
  .btn-black {
    background-color: #000000;
    color: #ffffff;
    border: none;
  }
  
  .btn-black:hover {
    background-color: #2f2f2f;
  }
  </style>
  