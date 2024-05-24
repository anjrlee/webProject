<template>
    <div class="container mt-[100px] z-[0] absolute">
        <div class="row justify-content-center mt-4">
            <div class="col">
                <h3 class="display-6 d-inline"><strong>個人資料</strong></h3>
                <router-link :to="{ name: 'edit-profile', query: profile }" v-if="isOwnProfile" class="btn btn-black d-inline float-right">
                    <i class="bi bi-pencil-square fs-5"></i>編輯
                </router-link>
                <button @click="logout" class="btn btn-danger d-inline float-right me-3">登出</button>
                <div class="line mt-3"></div>
                <div class="mt-4 mb-3">
                    <p id="name">姓名：{{ profile.name }}</p>
                </div>
                <div class="mt-4 mb-3">
                    <p id="gender">性別：{{ profile.gender }}</p>
                </div>
                <div class="mt-4 mb-3">
                    <p id="departmentGrade">系級：{{ profile.department }}</p>
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
            isOwnProfile: true,
            loggedInUser: null
        };
    },
    methods: {
        async logout() {
            try {
                await axios.post('/logout'); 
                window.location.href = '/login';
            } catch (error) {
                console.error('Logout failed', error);
            }
        },
    },
    mounted() {
        const userMetaTag = document.querySelector("meta[name='user']");
        if (userMetaTag) {
            try {
                this.loggedInUser = JSON.parse(userMetaTag.getAttribute('content'));
                // Assigning the loggedInUser data to profile
                this.profile = {
                    name: this.loggedInUser.name,
                    gender: this.loggedInUser.gender,
                    email: this.loggedInUser.email,
                    bio: this.loggedInUser.bio,
                    department: this.loggedInUser.department,
                    grade: this.loggedInUser.grade // Ensure you have a grade field if applicable
                };
                console.log(this.loggedInUser);
            } catch (error) {
                console.error('Failed to parse user meta tag content:', error);
            }
        }
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