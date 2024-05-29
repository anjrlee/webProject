<template>
  <div>
    <div v-show="Signup" class="container__form container--signup">
      <form @submit.prevent="handleSignup" class="form" id="formS">
        <h2 class="form__title"><strong>註冊</strong></h2>
        <hr class="form--separator">
        <label for="username">用戶名</label>
        <input type="text" class="input" placeholder="名字需小於20個字元" v-model="SignupUsername" />
        <span v-if="usernameError" class="error-message">{{ usernameError }}</span>
        <label for="email">電子郵件</label>
        <input type="email" class="input" v-model="SignupEmail" placeholder="xxx@gmail.com"/>
        <label for="department">系級</label>
        <input type="text" class="input" placeholder="例:資管二" v-model="SignupDepartment" />
        <label for="password">密碼</label>
        <input type="password" class="input" placeholder="密碼需大於6個字元" v-model="SignupPassword" />
        <!-- <div style="transform:scale(0.77);"> <VueRecaptcha :sitekey="data_v2SiteKey" @verify="recaptchaVerified" @expire="recaptchaExpired" @fail="recaptchaFailed"/></div>  -->
        <span v-if="passwordError" class="error-message">{{ passwordError }}</span>
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
        <div style="transform:scale(0.70);"> <VueRecaptcha :sitekey="data_v2SiteKey" @verify="recaptchaVerified" @expire="recaptchaExpired" @fail="recaptchaFailed"/></div> 
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
import { reactive } from 'vue';
import VueRecaptcha from 'vue3-recaptcha2';

export default {
  components: {
    VueRecaptcha,
  },
  props: {
    msg: {
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
      passwordError: '',
      usernameError: '',
      departmentError: '',
      data_v2SiteKey: '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
      recaptchaToken: '',
      recaptchaVerify:true
    };
  },
  setup(props) {
    onMounted(() => {
      if(props.msg){
          console.log("test:",props.msg);
         if(props.msg==="true"){
          Swal.fire('註冊成功', "請登入", 'success');
         }else{
          Swal.fire('驗證碼錯誤', "請點email連結以再次驗證", 'error');
         }
      }
    });
  },
  methods: {

    async handleSignup() {
      /*const submitResult = await (async () => {
         await this.submitForm();
      })();
      if(this.recaptchaVerify==false){
          return ;
      }*/
      Swal.showLoading();
      this.clearErrors();
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const response = await axios.post('/register', {
          name: this.SignupUsername,
          email: this.SignupEmail,
          password: this.SignupPassword,
          department: this.SignupDepartment,
          _token: csrfToken
        });
        //Swal.fire('註冊成功!', response.data.message, 'success');
        Swal.fire('註冊成功!', "請前往信箱並點驗證信連結以完成註冊", 'success');
        this.resetSignupForm();
      } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
          this.handleSignupErrors(error.response.data.errors);
        } else if (error.message !== undefined && error.message !== null) {
          Swal.fire('註冊失敗', error.message, 'error');
        } else {
          Swal.fire('註冊失敗', '未知錯誤', 'error');
        }
      }

    },
    recaptchaVerified(response_token) {
      //console.log(response_token);
      this.recaptchaToken = response_token;
      // 連接後端API，給後端進行認證
      // Connect to your Backend service.
    },
    recaptchaExpired() {
      // 驗證過期後進行的動作
      // After recaptcha is expired, the action you can do.
      console.log('驗證過期啦QAQ');
    },
    recaptchaFailed() {
      // 驗證失敗進行的動作
      // After recaptcha is failed, the action you can do.
    },
    async submitForm() {
  
      if (!this.recaptchaToken) {
        alert('请完成 reCAPTCHA 验证');
        return ;
      }
      try {
        const response = await axios.post('/verify-recaptcha', {
          token: this.recaptchaToken
        });
        console.log("test",response.data);
        if (response.data.success) {   
          this.recaptchaVerify= true;
          return ;
        } else {
          return false;
        }
      } catch (error) {
        console.error('Error:', error);
        return false;
      }
    
    },
    async handleLogin() {
      const submitResult = await (async () => {
         await this.submitForm();
    })();
      if(this.recaptchaVerify==false){
          return ;
      }
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const response = await axios.post('/login', {
          email: this.LoginEmail,
          password: this.LoginPassword,
          _token: csrfToken
        });
        if (response.status === 200) {
            localStorage.setItem('userEmail', response.data.user.email);
            router.push('/');
          Swal.fire({
            title: '登入成功',
            text: '您已成功登入',
            icon: 'success',
            confirmButtonText: '確定'
          }).then(() => {
            window.location.href = response.data.redirect;
          });
        }
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

    handleSignupErrors(errors) {
      if (errors.name) {
        this.usernameError = errors.name[0];
      }
      if (errors.password) {
        this.passwordError = errors.password[0];
      }
      if (errors.department) {
        this.departmentError = errors.department[0];
      }
      if (errors.email) {
        this.emailError = errors.email[0];
      }
    },

    clearErrors() {
      this.emailError = '';
      this.passwordError = '';
      this.usernameError = '';
      this.departmentError = '';
    },

    resetSignupForm() {
      this.SignupUsername = '';
      this.SignupEmail = '';
      this.SignupPassword = '';
      this.SignupDepartment = '';
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
    margin-top: 150px;
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
    margin-top: 150px;
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
    top: 175px;
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
    top: 175px;
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
