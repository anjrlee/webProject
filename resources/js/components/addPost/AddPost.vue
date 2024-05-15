<template>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col">
                <p class="display-6"><strong>新增紀錄</strong><small>*為必填</small></p>
                <div class="line"></div>
                <form class="mt-4">
                    <div class="mb-3">
                        <label for="title" class="form-label"><p class="require">*</p>項目名稱：</label>
                        <input type="text" class="form-control" id="title" placeholder="丟松果最快速" required>
                    </div>
                    <div class="mb-3">
                        <label for="recordScore" class="form-label"><p class="require">*</p>完成紀錄：</label>
                        <input type="text" class="form-control" id="recordScore" placeholder="100(km/hr)" required>
                    </div>
                    <div class="mb-3">
                        <label for="recorder" class="form-label"><p class="require">*</p>完成者：</label>
                        <input type="text" class="form-control" id="recorder" placeholder="王小明" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label"><p class="require">*</p>完成日期：<small>請點選月曆圖示選擇日期</small></label>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="date" required>
                            </div>
                        </div>
                    </div>



                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3">
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1"
                                    value="option1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    First radio
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                                    value="option2">
                                <label class="form-check-label" for="gridRadios2">
                                    Second radio
                                </label>
                            </div>
                            <div class="form-check disabled">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3"
                                    value="option3" disabled>
                                <label class="form-check-label" for="gridRadios3">
                                    Third disabled radio
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Example checkbox
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import App from '../App.vue'; 
import 'bootstrap'; 
import 'bootstrap/dist/css/bootstrap.min.css'; 

export default {
    components: {
        App
    },
}
</script>

<style scoped>
.line {
    height: 1%;
    border-top: solid #000000;
}

form,
input {
    font-size: 1.5rem;
}

small{
    font-size: 0.9rem;
    color: #ff0000;
    margin-left: 1%;
    white-space: nowrap;
    display: inline-block;
}

.require{
    color: #ff0000;
    display: inline-block;
}
</style>