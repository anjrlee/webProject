<template>
    <div v-show="Signup" class="container__form container--signup">
        <form @submit.prevent="handleSignup" class="form" id=formS>
        <h2 class="form__title"><strong>註冊</strong></h2>
        <hr class="form--separator">
        <label for="username">用戶名</label>
        <input type="text" class="input" v-model="SignupUsername"/>
        <label for="email">電子郵件</label>
        <input type="email" class="input" v-model="SignupEmail"/>
        <label for="password">密碼</label>
        <input type="password" class="input" v-model="SignupPassword"/>
        <button type="submit" class="button3">註冊</button>
        </form>
    </div>

    <div v-show="Login" class="container__form container--login">
        <form @submit.prevent="handleLogin" class="form" id="formL">
        <h2 class="form__title"><strong>登入</strong></h2>
        <hr class="form--separator">
        <label for="email">電子郵件</label>
        <input type="email" class="input" v-model="LoginEmail"/>
        <label for="password">密碼</label>
        <input type="password" class="input" v-model="LoginPassword"/>
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
</template>

<script>
    export default{
        data(){
            return{
            SignupUsername: '',
            SignupEmail: '',
            SignupPassword: '',
            LoginEmail: '',
            LoginPassword: '',
            Signup: false,
            Login: true,
            pageL: true,
            pageR: false
            };
        },
        methods:{
            handleSignup(){
              console.log('註冊',  this.SignupUsername, this.SignupEmail, this.SignupPassword);
            },
            handleLogin(){
              console.log('登入', this.LoginEmail, this.LoginPassword);
            },
            gotoSignup(){
              this.Signup=true;
              this.Login=false;
              this.pageL=false;
              this.pageR=true;
            },
            gotoLogin(){
              this.Signup=false;
              this.Login=true;
              this.pageL=true;
              this.pageR=false;
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
    height: 300px;
  }

  .container--login{
    right: 60px;
    width: 230px;
    height: 300px;
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
    height: 300px;
  }

  .overlay--pageR{
    right: 60px;
    width: 230px;
    height: 300px;
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
</style>
