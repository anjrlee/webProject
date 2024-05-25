<template>
    <div class="main-container">
      <div class="container mt-[100px] z-[0] absolute">
        <div class="filter-buttons">
          <button @click="filterItems('all')" :class="{ active: filter === 'all' }">所有</button>
          <button @click="filterItems('no')" :class="{ active: filter === 'no' }">待審核</button>
          <button @click="filterItems('approved')" :class="{ active: filter === 'approved' }">已批准</button>
          <button @click="filterItems('rejected')" :class="{ active: filter === 'rejected' }">已拒絕</button>
        </div>
  
        <div v-show="itemTable" class="showable">
          <p class="form__title"><strong>審核列表</strong></p>
          <hr class="form--separator">
          <div class="table">
            <div class="table__title">
              <div class="table-cell">項目名稱</div>
              <div class="table-cell">發表者</div>
              <div class="table-cell">發表時間</div>
              <div class="table-cell">狀態</div>
            </div>
            <div v-for="item in filteredItems" :key="item.id" class="table-row" @click="showItemcontent(item)">
              <div class="table-cell">{{ item.title }}</div>
              <div class="table-cell">{{ item.recorder }}</div>
              <div class="table-cell">{{ item.date }}</div>
              <div class="table-cell">{{ item.ifProved }}</div>
            </div>
          </div>
        </div>
  
        <div id="Itemcontent" v-if="selectItem">
          <div class="header-row">
            <p class="form__title"><strong>審核列表</strong></p>
            <button @click="goback" class="button3">返回</button>
          </div>
          <hr class="form--separator">
          <form class="mt-4">
            <div class="mb-3">
              <p class="label"><strong>項目名稱: </strong>{{ selectItem.title }}</p>
              <p class="label"><strong>完成紀錄: </strong>{{ selectItem.recordScore }}</p>
              <p class="label"><strong>完成者: </strong>{{ selectItem.recorder }}</p>
              <p class="label"><strong>完成日期: </strong>{{ selectItem.date }}</p>
              <p class="label"><strong>證明檔案: </strong>{{ selectItem.proveFile }}</p>
            </div>
            <button @click="approve(selectItem.id)" class="button1">許可</button>
            <button @click="reject(selectItem.id)" class="button2">拒絕</button>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        items: [],
        selectItem: null,
        itemTable: true,
        filter: 'all',
      };
    },
    computed: {
      filteredItems() {
        if (this.filter === 'all') {
          return this.items;
        }
        return this.items.filter(item => item.ifProved === this.filter);
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
      async approve(id) {
        try {
          const response = await axios.post(`/api/posts/${id}/approve`);
          console.log(response.data);
          this.fetchPosts();
        } catch (error) {
          console.error('Error approving post:', error);
        }
      },
      async reject(id) {
        try {
          const response = await axios.post(`/api/posts/${id}/reject`);
          console.log(response.data);
          this.fetchPosts();
        } catch (error) {
          console.error('Error rejecting post:', error);
        }
      },
      async fetchPosts() {
        try {
          const response = await axios.get('/api/posts');
          this.items = response.data;
        } catch (error) {
          console.error('Error fetching posts:', error);
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
  margin-bottom: 20px;
  margin-top: 20px;

}

.filter-buttons button {
  margin: 0 10px;
  padding: 10px 20px;
  border: none;
  background-color: #f0f0f0;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.3s;
  border-radius: 20px;
}

.filter-buttons button.active {
  background-color: #f0c575;
  color: #fff;
  transform: scale(1.1);
}

.filter-buttons button:hover {
  background-color: #ffc115;
  color: #fff;
  transform: scale(1.05);
}
    .main-container{
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form__title{
        font-size: 40px;
        margin-top: 20px;
    }

    .form--separator{
        height: 1%;
        border-top: solid #000000;
        margin-top: 1px;
        margin-bottom: 10px;
    }

    .table{
        display: table;
        width: 100%;
        text-align: center;
    }

    .table__title{
        display: table-header-group;
        font-weight: bold;
        font-size: 30px;
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
        font-size: 30px;
        margin-left: 12%;
    }

    .button1{
        position: absolute;
        top: 550px;
        left: 400px;
        width: 130px;
        text-align: center;
        font-size: 30px;
        color: white;
        background: #6FD586;
        border-radius: 15px;
    }

    .button2{
        position: absolute;
        top: 550px;
        left: 700px;
        width: 130px;
        text-align: center;
        font-size: 30px;
        color: white;
        background: #E64C4C;
        border-radius: 15px;
    }

    .button3{
        width: 100px;
        text-align: center;
        font-size: 20px;
        color: white;
        background: #007bff;
        border-radius: 15px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
