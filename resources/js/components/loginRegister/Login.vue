<template>
  <div>
      <div v-show="Signup" class="container__form container--signup">
          <form @submit.prevent="handleSignup" class="form" id="formS">
              <h2 class="form__title"><strong>註冊</strong></h2>
              <hr class="form--separator">
              <label for="username">用戶名</label>
              <input type="text" class="input" v-model="SignupUsername" />
              <label for="email">電子郵件</label>
              <input type="email" class="input" v-model="SignupEmail" />
              <label for="department">系級(例:資管二)</label>
              <input type="text" class="input" v-model="SignupDepartment" />
              <label for="password">密碼</label>
              <input type="password" class="input" v-model="SignupPassword" />
              <button type="submit" class="button3">註冊</button>
          </form>
      </div>

      <div v-show="Login" class="container__form container--login">
          <form @submit.prevent="handleLogin" class="form" id="formL">
              <h2 class="form__title"><strong>登入</strong></h2>
              <hr class="form--separator">
              <label for="email">電子郵件</label>
              <input type="email" class="input" v-model="LoginEmail" />
              <span v-if="emailError" class="error-message">{{ emailError }}</span>
              <label for="password">密碼</label>
              <input type="password" class="input" v-model="LoginPassword" />
              <span v-if="passwordError" class="error-message">{{ passwordError }}</span>
              <button type="submit" class="button4">登入</button>
          </form>
      </div>

      <div class="overlay__panel overlay--pageL" v-show="pageL">
          <button @click="gotoSignup" class="button1">註冊</button>
      </div>
      <div class="overlay__panel overlay--pageR" v-show="pageR">
          <button @click="gotoLogin" class="button2">登入</button>
      </div>

      <div class="container__overlay">
          <div class="overlay"></div>
      </div>
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import { onMounted } from 'vue';

export default {
  props: {
    flashMessage: {
      type: String,
      default: ''
    }
  },
  data() {
      return {
          SignupUsername: '',
          SignupEmail: '',
          SignupPassword: '',
          SignupDepartment: '',
          LoginEmail: '',
          LoginPassword: '',
          Signup: false,
          Login: true,
          pageL: true,
          pageR: false,
          emailError: '',
          passwordError: ''
      };
  },
  setup(props) {
    onMounted(() => {
      if(props.flashMessage){
         if(props.flashMessage==="true"){
          Swal.fire('註冊成功', "請登入", 'success');
         }else{
          Swal.fire('驗證碼錯誤', "請點email連結以再次驗證", 'error');
         }
      }else{
        console.log("no");
      }
      
    });
  },
  methods: {

    async handleSignup() {
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const response = await axios.post('/register', {
            name: this.SignupUsername,
            email: this.SignupEmail,
            password: this.SignupPassword,
            department: this.SignupDepartment,
            _token: csrfToken
        });
        Swal.fire('註冊成功!', response.data.message, 'success');
        this.SignupUsername = '';
        this.SignupEmail = '';
        this.SignupPassword = '';
        this.SignupDepartment = '';
      } catch (error) {
        if (error.response) {
            Swal.fire('註冊失敗', error.response.data.message || '未知錯誤', 'error');
        } else if (error.request) {
            Swal.fire('註冊失敗', '無法收到響應', 'error');
        } else if (error.message !== undefined && error.message !== null) {
            Swal.fire('註冊失敗', error.message, 'error');
        } else {
            Swal.fire('註冊失敗', '未知錯誤', 'error');
        }
      }
    },
    
    async handleLogin() {
      this.emailError = '';
      this.passwordError = '';
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const response = await axios.post('/login', {
            email: this.LoginEmail,
            password: this.LoginPassword,
            _token: csrfToken
        });
        if (response.status === 200) {
          Swal.fire({
            title: '登入成功',
            text: '您已成功登入',
            icon: 'success',
            confirmButtonText: '確定'
          }).then(() => {
            window.location.href = response.data.redirect;
          });
        }
        console.log('登入成功', response.data);
      } catch (error) {
        if (error.response && error.response.data) {
          if (error.response.data.field === 'email') {
            this.emailError = error.response.data.message;
          } else if (error.response.data.field === 'password') {
            this.passwordError = error.response.data.message;
          }
        } else {
          Swal.fire('登入失敗', error.response ? error.response.data.message : '未知錯誤', 'error');
        }
      }
    },

    gotoSignup() {
      this.Signup = true;
      this.Login = false;
      this.pageL = false;
      this.pageR = true;
    },
    gotoLogin() {
      this.Signup = false;
      this.Login = true;
      this.pageL = true;
      this.pageR = false;
    }
  }
};
</script>


<style scoped>
  h2{
    margin-top: 30px;
  }

  label{
    font-size: 15px;
    margin-bottom: 5px;
  }

  input{
    width: 80%;
    margin-bottom: 10px;
    border-radius: 7px;
    opacity: 0.7;
  }

  .button3{
    text-align: center;
    width:40%;
    font-size: 20px;
    margin-top:5px;
    color: white;
    background: #010000;
    opacity: 0.25;
    border-radius: 10px;
  }

  .button4{
    text-align: center;
    width:40%;
    font-size: 20px;
    margin-top:15px;
    color: white;
    background: #010000;
    opacity: 0.25;
    border-radius: 10px;
  }

  .form__title{
    text-align: center;
    margin-top: 20px;
    font-size: 25px;
  }

  .form--separator{
    width: 85%;
    margin-top: 5px;
    margin-bottom: 5px;
    border-bottom: 1px solid black;
  }

  .container__form{
    background-color: #eee;
    opacity: 0.8;
    float: right;
    margin-top: 190px;
    border-radius: 20px;
    position: absolute;
  }
  .form{
    display: flex;
    flex-direction: column;
    align-items: center; 
  }

  .container--signup{
    right: 300px;
    width: 230px;
    height: 400px;
  }

  .container--login{
    right: 60px;
    width: 230px;
    height: 400px;
  }

  .overlay{
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: url('/images/login/login_bg.jpg');
    background-size: cover;
    opacity: 0.5;
    z-index: -1;
  }

  .overlay__panel{
    background-color: #eee;
    opacity: 0.75;
    float: right;
    margin-top: 190px;
    border-radius: 20px;
    position: absolute;
  }
  
  .overlay--pageL{
    right: 300px;
    width: 230px;
    height: 400px;
  }

  .overlay--pageR{
    right: 60px;
    width: 230px;
    height: 400px;
  }

  .button1{
    position: absolute;
    top: 125px;
    right: 65px;
    width: 100px;
    text-align: center;
    font-size: 30px;
    color: white;
    background: #010000;
    opacity: 0.25;
    border-radius: 15px;
  }

  .button2{
    position: absolute;
    top: 125px;
    right: 65px;
    width: 100px;
    text-align: center;
    font-size: 30px;
    color: white;
    background: #010000;
    opacity: 0.25;
    border-radius: 15px;
  }
  .input{
    text-align: center;
  }
  .error-message {
    color: red;
    font-size: 0.9em;
}
</style>
