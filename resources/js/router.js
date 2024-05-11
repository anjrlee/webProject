import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/index/Home.vue';
import Articles from './components/index/articles.vue';
import Login from './components/loginRegister/Login.vue';
import Register from './components/loginRegister/Register.vue';
import AddPost from './components/addPost/AddPost.vue';
import Verify from './components/verify/Verify.vue';
import Profile from './components/profile/Profile.vue';
import Post from './components/post/Post.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: Home },
        { path: '/articles', component: Articles },
        { path: '/login', component: Login },
        { path: '/register', component: Register },
        { path: '/addpost', component: AddPost },
        { path: '/verify', component: Verify },
        { path: '/profile', component: Profile },
        { path: '/post/:id', component: Post, props: true }, // Example of dynamic route with props
        // Define your routes here
    ]
});

export default router;
