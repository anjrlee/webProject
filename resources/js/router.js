import Vue from 'vue';
import Router from 'vue-router';

// 引用頁面的 Component
import Home from './components/Home.vue';
import ExampleComponent from './components/ExampleComponent.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Verify from './components/Verify.vue';
import AddPost from './components/AddPost.vue';

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
];

// 建立 Vue Router instance
const router = new Router({
  mode: 'history',
  routes
});

export default router;