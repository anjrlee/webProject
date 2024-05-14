<template>
    <div class="container">
        <App class="navbar"></App>
        <p>addPost</p>
    </div>
</template>

<script>
import App from '../App.vue';

export default {
  components: {
    App 
  },
}
</script>

<style scoped>
    .navbar{
        height: 120px;
    }
    .container{
        background-color: #d3d3d3;
        height: 100vh;
        overflow: hidden;
    }
</style>