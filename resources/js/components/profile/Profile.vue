<template>
    <div class="container mt-[100px] z-[0] absolute">
        <div class="row justify-content-center mt-4">
            <div class="col">
                <h3 class="display-6"><strong>個人資料</strong></h3>
                <div class="line"></div>
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
                <div class="text-center">
                    <button v-if="isOwnProfile" class="btn btn-primary" @click="editProfile">編輯</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const profile = ref({
    name: '王小明',
    gender: '男',
    email: 'example@example.com',
    bio: '早安',
    department: '資訊管理學系',
    grade: '大二'
});

const isOwnProfile = ref(true); 

const editProfile = () => {
    
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
</style>