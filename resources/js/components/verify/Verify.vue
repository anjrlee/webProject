<template>
    <el-button :plain="true" @click="open2">Success</el-button>
  <el-button :plain="true" @click="open3">Warning</el-button>
    <div class="main-container">

        <button @click="logout" class="button3">登出管理者模式</button>
      
        <button @click="goback" v-show="!itemTable" class="">
              <img src="/images/verify/verify_back.png" alt="返回" class="back" />
        </button>

        <div class="filter-buttons">
          <button @click="filterItems('all')" :class="{ active: filter === 'all' }">所有</button>
          <button @click="filterItems('no')" :class="{ active: filter === 'no' }">待審核</button>
          <button @click="filterItems('approved')" :class="{ active: filter === 'approved' }">已批准</button>
          <button @click="filterItems('rejected')" :class="{ active: filter === 'rejected' }">已拒絕</button>
        </div>
  
        <div v-show="itemTable" class="showable">
          <p class="form__title"><strong>審核列表</strong></p>
          <hr class="form--separator">
          <div class="table-container">
            <div class="table">
              <div class="table__title">
                <div class="table-cell">項目名稱</div>
                <div class="table-cell">發表者</div>
                <div class="table-cell">發表時間</div>
                <div class="table-cell">狀態</div>
              </div>
              <div v-for="item in sortedFilteredItems" :key="item.id" class="table-row" @click="showItemcontent(item)">
                <div class="table-cell">{{ item.title }}</div>
                <div class="table-cell">{{ item.recorder }}</div>
                <div class="table-cell">{{ item.date }}</div>
                <div class="table-cell">{{ getstatus(item.ifProved) }}</div>
              </div>
            </div>
          </div>
        </div>
  
        <div class="Itemcontent" v-if="selectItem">
          <div class="header-row">
            <p class="form__title"><strong>審核列表</strong></p>
          </div>
          <hr class="form--separator mt-1 mb-4">
          <form class="mt-4">
            <div class="mb-3">
              <p class="label"><strong>項目名稱: </strong>{{ selectItem.title }}</p>
              <p class="label"><strong>完成紀錄: </strong>{{ selectItem.recordScore }}</p>
              <p class="label"><strong>完成者: </strong>{{ selectItem.recorder }}</p>
              <p class="label"><strong>完成日期: </strong>{{ selectItem.date }}</p>
              <p class="label"><strong>證明檔案: </strong>
                <a :href="selectItem.proveFile" target="_blank">
                  <span class="small-text">{{ selectItem.proveFile }}</span>
                </a>
              </p>
            </div>

          </form>
        </div>
      
        
        <div class="twobuttons"  v-if="selectItem">
            <el-button  @click="approve(selectItem.id)" class="button1">許可</el-button>
            <el-button @click="reject(selectItem.id)" class="button2">拒絕</el-button>
        </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { ElMessage } from 'element-plus';
import { offset } from '@popperjs/core';
  export default {
    data() {
      return {
        items: [],
        selectItem: null,
        itemTable: true,
        filter: 'no',
      };
    },
    computed: {
      filteredItems() {
        if (this.filter === 'all') {
          return this.items;
        }
        return this.items.filter(item => item.ifProved === this.filter);
      },
      sortedFilteredItems() {
        const priority = {
          'no': 1,
          'rejected': 2,
          'approved': 3
        };
        return this.filteredItems.sort((a, b) => priority[a.ifProved] - priority[b.ifProved]);
      },
    },
    methods: {
      filterItems(status) {
        this.filter = status;
      },
      showItemcontent(item) {
        this.selectItem = item;
        this.itemTable = false;
      },
      goback() {
        this.itemTable = true;
        this.selectItem = null;
      },
      logout() {
        axios.post('/remove-session')
              .then(response => {
                console.log('Session removed response:', response.data);
                window.location.href = "/"; 
              })
              .catch(error => {
                Swal.showValidationMessage("請求失敗: " + error);
              });
    },
      async approve(id) {
        try {
          const response = await axios.post(`/api/posts/${id}/approve`,{},{
            headers:{
              'x-Verified':sessionStorage.getItem('verified')
            }
          });
          this.goback();
          this.fetchPosts();
          ElMessage({
              message: 'Post approved successfully!',
              type: 'success',
              offset: 100
          });

          this.itemTable = true;
          this.selectItem = null;

        } catch (error) {
          console.error('Error approving post:', error);
        }
      },
      async reject(id) {
        try {
          const response = await axios.post(`/api/posts/${id}/reject`,{},{
            headers:{
              'x-Verified':sessionStorage.getItem('verified')
            }
          
          });
          console.log(response.data);
          this.goback();
          this.fetchPosts();
          ElMessage.error({
              message: 'Post has been rejected',
              offset: 100,
          })
          this.itemTable = true;
          this.selectItem = null;

        } catch (error) {
          console.error('Error rejecting post:', error);
        }
      },
      async fetchPosts() {
        try {
          const response = await axios.get('/api/verification');
          this.items = response.data;
        } catch (error) {
          console.error('Error fetching posts:', error);
        }
      },
      getstatus(status) {
        switch (status) {
          case 'no':
            return '未審核';
          case 'approved':
            return '已批准';
          case 'rejected':
            return '已拒絕';
          default:
            return status;
        }
      },
    },
    mounted() {
      this.fetchPosts();
    },
  };
  </script>

<style scoped>

.filter-buttons {
  display: flex;
  justify-content: center;
  margin-bottom: 50px;
  position: absolute;
  top: 150px;
}

.twobuttons {
  display: flex;
  justify-content: center;
  position: absolute;
  bottom: 10vh;
}

.filter-buttons button {
  margin: 0 10px;
  padding: 10px 20px;
  border: none;
  background-color: #f0f0f0;
  cursor: pointer;
  transition: transform 0.3s;
  border-radius: 20px;
  font-size: 20px;
}

.twobuttons button {
  margin: 0 25px;
  padding: 5px 20px;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.3s;
  transform: scaleX(1.05);
}
.filter-buttons button.active {
  background-color: #fbc531;
  color: #fff;
  transform: scale(1.1);
  width: 130px;
}

.filter-buttons button:hover {
  background-color: #f0c575;
  color: #fff;
  transform: scale(1.15);
}

.main-container{
    display: flex;
    flex-direction: column;
    align-items: center;
}

.form__title{
    font-size: 30px;
    margin-bottom: 15px;
}

.form--separator{
    height: 1%;
    border-top: solid #000000;
    margin-bottom: 10px;
}

.table-container{
  max-height: 400px;
  overflow-y: auto;
  -ms-overflow-style: none;
  scrollbar-width: none;
}

.table-container::-webkit-scrollbar{
  display: none;
}

.table{
    display: table;
    width: 100%;
    text-align: center;
}

.table__title{
    display: table-header-group;
    font-weight: bold;
    font-size: 25px;
}

.table-row{
    display: table-row;
    cursor: pointer;
}

.table-row:hover{
    background-color: rgba(196, 239, 239, 0.667)    
}

.table-cell{
    display: table-cell;
    padding: 8px;
    border-bottom: 1px solid #add;
}

.table-cell:last-child{
    text-align: center;
}

.header-row{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.label{
    font-size: 25px;
    margin-left: 12%;
}

.small-text{
    font-size: 15px;
}

.button1{
    text-align: center;
    font-size: 20px;
    color: white;
    background: #6FD586;
    border-radius: 15px;
}
.button1:hover {
  background: #57b86f;
  transform: scale(1.2);
  color: white;
}
.button2{
    text-align: center;
    font-size: 20px;
    color: white;
    background: #E64C4C;
    border-radius: 15px;
}
.button2:hover {
  background: #c43d3d;
  transform: scale(1.2);
  color: white;
}
.button3, .back{
    border: none;
    cursor: pointer;
    position: absolute;
}

.button3{
  background-color: rgb(128, 109, 81);
  top: 150px;
  right: 10%;
  border-radius: 10px;
  padding: 10px 20px;
  color: white;
  transition: transform 0.3s ease-in-out;
}
.button3:hover{
  background-color: rgb(62, 44, 26);
  transform: scale(1.1);
}
.back{
  width: 50px;
  height: 50px;
  top: 140px;
  left: 10%;
  transition: left 0.3s ease-in-out;
}
.back:hover{
  left: 9%;
}
.showable, .Itemcontent{
  width: 60vw;
  position: absolute;
  top: 200px;
  height: 65vh;
}
</style>
