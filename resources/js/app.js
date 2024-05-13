import { createApp } from 'vue'; // Import createApp function from Vue 3
import router from './router.js'; // Import your router configuration
import './bootstrap'; // Import bootstrap or any other dependencies

// Remove this line as it's not needed in Vue 3
// window.Vue = require('vue').default;

// Import your Vue components without the .default suffix
import Page404 from './components/index/page404.vue';
import Home from './components/index/Home.vue';
import Articles from './components/index/articles.vue';
import Login from './components/loginRegister/Login.vue';
import Register from './components/loginRegister/Register.vue';
import AddPost from './components/addPost/AddPost.vue';
import Verify from './components/verify/Verify.vue';
import Profile from './components/profile/Profile.vue';
import Post from './components/post/Post.vue';
import ArticleRead from './components/articles/article.vue';
import App from './components/App.vue';


// Create a new Vue app instance using createApp
const app = createApp({
    // App options here
});

// Register your components using the component method

app.component('App', App);
app.component('home', Home);
app.component('login', Login);
app.component('register', Register);
app.component('addPost', AddPost);
app.component('verify', Verify);
app.component('profile', Profile);
app.component('post', Post);
app.component('articles', Articles);
app.component('articleRead', ArticleRead);
app.component('page404', Page404);

// Use the router with the app
app.use(router);

// Mount the app to the element with id 'app'
app.mount('#app');
