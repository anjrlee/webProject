import Vue from 'vue';
import Router from 'vue-router';

// 引用頁面的 Component
import Home from './components/Home.vue';
import ExampleComponent from './components/ExampleComponent.vue';
import Register from './components/loginRegister/Register.vue';
import Login from './components/loginRegister/Login.vue';
import Verify from './components/verify/Verify.vue';
import AddPost from './components/addPost/AddPost.vue';
import Profile from './components/profile/Profile.vue';
import Post from './components/post/Post.vue';

// 使用 Vue Router
Vue.use(Router);

// Route 設定
export const routes = [
  { path: '/home', component: Home, name: 'home' },
  { path: '/ExampleComponent', component: ExampleComponent, name: 'ExampleComponent' },
  { path: '/login', component: Login, name: 'login' },
  { path: '/verify', component: Verify, name: 'verify' },
  { path: '/addPost', component: AddPost, name: 'addPost' },
  { path: '/register', component: Register, name: 'register' },
  { path: '/profile', component: Profile, name: 'profile' },
  { path: '/post', component: Post, name: 'post' },
];

// 建立 Vue Router instance
const router = new Router({
  mode: 'history',
  routes
});

export default router;