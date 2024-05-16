<template>
    <div class="container mt-[100px] z-[0] absolute">
        <div class="row justify-content-center mt-4">
            <div class="col">
                <h3 class="display-6 d-inline"><strong>編輯個人資料</strong></h3>
                <button class="btn btn-black d-inline float-right" @click="save()"><i class="bi bi-floppy fs-5"></i>儲存</button>
                <div class="line mt-3"></div>
                <form>
                    <div class="mt-4 mb-3">
                        <label for="name" class="form-label">姓名：</label>
                        <input type="text" class="form-control" id="name" v-model="profile.name">
                    </div>
                    <div class="mt-4 mb-3">
                        <label for="gender" class="form-label">性別：</label>
                        <select class="form-select" id="gender" v-model="profile.gender">
                            <option value="男">男</option>
                            <option value="女">女</option>
                            <option value="非二元性別">非二元性別</option>
                            <option value="不願意透露">不願意透露</option>
                        </select>
                    </div>
                    <div class="mt-4 mb-3">
                        <label for="department" class="form-label">系所：</label>
                        <input type="text" class="form-control" id="department" v-model="profile.department">
                    </div>
                    <div class="mt-4 mb-3">
                        <label for="grade" class="form-label">年級：</label>
                        <input type="text" class="form-control" id="grade" v-model="profile.grade">
                    </div>
                    <div class="mt-4 mb-3">
                        <p id="email">Email：{{ profile.email }}</p>
                    </div>
                    <div class="mt-4 mb-3">
                        <label for="bio" class="form-label">自我介紹：</label>
                        <textarea class="form-control" id="bio" style="resize: none;" rows="5">{{ profile.bio }}</textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router'; 

const router = useRouter();
const profile = ref({
    name: '王希銘',
    gender: '男',
    email: 'example@example.com',
    bio: '早安',
    department: '資訊管理學系',
    grade: '大二'
});

const save = () => {
    router.push('/profile');
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

form,
p,
input,
textarea, 
select {
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