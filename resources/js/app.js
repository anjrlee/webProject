import { createApp } from 'vue'; // Import createApp function from Vue 3
import router from './router.js'; // Import your router configuration
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUser,faNewspaper,faPencil,faGlasses,faSchool,faGraduationCap,faRightFromBracket,faKey, faK} from '@fortawesome/free-solid-svg-icons'
import { faReadme} from '@fortawesome/free-brands-svg-icons'
import './bootstrap.js'; // Import bootstrap or any other dependencies

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
import Edit from './components/profile/Edit.vue';
import Post from './components/post/Post.vue';
import ArticleRead from './components/articles/article.vue';
import App from './components/App.vue';
import UserProfile from './components/profile/UserProfile.vue';


// Create a new Vue app instance using createApp
const app = createApp({
    // App options here
});

library.add(
    faUser,faNewspaper,faPencil,faGlasses,faSchool,faReadme,faGraduationCap,faRightFromBracket,faKey
)
// Register your components using the component method

app.component('font-awesome-icon', FontAwesomeIcon)
app.component('App', App);
app.component('home', Home);
app.component('login', Login);
app.component('register', Register);
app.component('addPost', AddPost);
app.component('verify', Verify);
app.component('profile', Profile);
app.component('edit', Edit);
app.component('post', Post);
app.component('articles', Articles);
app.component('articleRead', ArticleRead);
app.component('page404', Page404);
app.component('UserProfle', UserProfile);

// Use the router with the app
app.use(router);

// Mount the app to the element with id 'app'
app.mount('#app');
