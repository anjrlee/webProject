<template>
    <div class="main-container">
        <div class="container mt-[100px] z-[0] absolute">
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
                    <div v-for="item in items" :key="item.id" class="table-row" @click="showItemcontent(item)">
                        <div class="table-cell">{{ item.title }}</div>
                        <div class="table-cell">{{ item.author }}</div>
                        <div class="table-cell">{{ item.published }}</div>
                        <div class="table-cell">{{ item.Istatus }}</div>
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
                        <p class="label"><strong>完成紀錄: </strong>{{ selectItem.recordScore}}</p>
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
import App from '../App.vue'; // 导入 App.vue 
import 'bootstrap'; // 导入 Bootstrap 样式
import 'bootstrap/dist/css/bootstrap.min.css'; // 导入 Bootstrap CSS
//import axios from 'axios';

export default {
    components: {
        App
    },
    data(){
        return{
            items: [],
            selectItem: null,
            itemTable: true
        };
    },
    methods:{
        getItems(){
            /*axios.get('/.api/items')
                .then(Response => {
                    this.items = Response.data;
                })
                .catch(error => {
                    console.log(error);
                });
            },
            this.items = item;*/
            const mdata = [
                {id: 1, title: '丟松果大賽最高速度', author: '王曉明', published: '2024/3/12', Istatus: '待審核'},
                {id: 2, title: '丟松果大賽最遠距離', author: '陳一一', published: '2024/4/5', Istatus: '待審核'}
            ];
            this.items = mdata;
        },
        showItemcontent(item){
            this.selectItem = item;
            this.itemTable = false;
            /*axios.get('/api/items/${item.id}')
                .then(Response => {
                    this.selectItem = Response.data,map(item => ({
                        ...item,
                        Instatus: '待審核'
                    }));
            })
            .catch(error => {
                    console.log(error);
                });
            */
        },
        goback(){
            this.itemTable = true; 
            this.selectItem = null;  
        },
        approve(itemId){
            this.itemTable=true;
            this.selectItem.Istatus = '許可';
            this.selectItem = null; 
            /*axios.post('api/items/${itemId}/approve')
                .then(Response => {
                    console.log('已許可', Response.data);
                    this.selectItem = null;
                    this.getItems();
                });*/
        },
        reject(itemId){
            this.itemTable=true;
            this.selectItem.Istatus = '拒絕';
            this.selectItem = null; 
            /*axios.post('api/items/${itemId}/reject')
                .then(Response => {
                    console.log('已拒絕', Response.data);
                    this.selectItem = null;
                    this.getItems();
                });*/
        },
    },
    mounted(){
        this.getItems();
    }
};
</script>

<style scoped>
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
        top: 450px;
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
        top: 450px;
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
