import { createRouter, createWebHistory,VueRouter  } from 'vue-router';
import Home from './components/index/Home.vue';
import page404 from './components/index/page404.vue';
import Articles from './components/index/articles.vue';
import ArticlesRead from './components/articles/article.vue';
import Login from './components/loginRegister/Login.vue';
import Register from './components/loginRegister/Register.vue';
import AddPost from './components/addPost/AddPost.vue';
import Verify from './components/verify/Verify.vue';
import Profile from './components/profile/Profile.vue';
import Edit from './components/profile/Edit.vue';
import Post from './components/post/Post.vue';


const router = createRouter(
    {
    history: createWebHistory(),
    routes: [
        { path: '/', component: Home },
        { path: '/404', component: page404 },
        { path: '/articles', component: Articles },
        { path: '/login', component: Login },
        { path: '/register', component: Register },
        { path: '/addpost', component: AddPost },
        { path: '/verify', component: Verify },
        { path: '/profile', component: Profile },
        { path: '/profile/edit', component: Edit },
        { path: '/post/:id', component: Post, props: true },
        { path: '/articleRead/:id', component: ArticlesRead, props: true },
/*         { path: '/:pathMatch(.*)',redirect: '/404'} */
        // Define your routes here
    ]
});

export default router;
