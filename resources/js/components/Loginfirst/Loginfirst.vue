
<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">未授權的訪問</div>
                    <div class="card-body">
                        <p>此功能僅供已登入的用戶使用!</p>
                        <p>請點按下面按鈕前往登入頁面</p>
                        <button @click="loginfirst">前往登入頁面~</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>


export default {

    methods: {
        async loginfirst() {
            try {
                window.location.href = '/login';
            } catch (error) {
                console.error('switch failed', error);
            }
        },
    },
}
</script>
<style scoped>
button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 12px;
    padding: 10px 24px;
}
</style>
