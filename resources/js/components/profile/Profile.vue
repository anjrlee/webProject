<template>
    <div class="container mt-[100px] z-[0] absolute">
        <div class="row justify-content-center mt-4">
            <div class="col">
                <h3 class="display-6 d-inline"><strong>個人資料</strong></h3>
                <router-link to="/profile/edit" v-if="isOwnProfile" class="btn btn-black d-inline float-right"><i class="bi bi-pencil-square fs-5"></i>編輯</router-link>
                <button @click="logout" class="btn btn-danger d-inline float-right me-3">登出</button> 
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
import 'bootstrap'; 
import 'bootstrap/dist/css/bootstrap.min.css'; 
import 'bootstrap-icons/font/bootstrap-icons.css';
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default{
    data() {
        return {
            profile: {},
            isOwnProfile: true
        };
    },
    mounted() {

        axios.get('/user', { withCredentials: true })
            .then(response => {

                this.profile = response.data;
            })
            .catch(error => {
                console.error(error);
                // 处理错误
            });
    }
};
// 登出
async function logout() {
    try {
        await axios.post('/logout'); 
    } catch (error) {
        console.error('登出失敗', error);
    }
}
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