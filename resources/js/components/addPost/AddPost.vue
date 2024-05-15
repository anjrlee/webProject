<template>
    <div class="container mt-[100px] z-[0] absolute">
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
                        <div class="row">
                            <label for="date" class="form-label col"><p class="require">*</p>完成日期：<small>（請點選月曆圖示選擇日期）</small></label>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label for="proveFile" class="form-label col"><p class="require">*</p>證明檔案：<small>（請將檔案上傳至Google Drive或YouTube等平台，貼上共享連結）</small></label>
                        </div>
                        <input type="url" class="form-control" id="proveFile" placeholder="https://drive.google.com/..." required>
                    </div>
                    <div class="mb-3">
                        <label for="awardSpeech" class="form-label">得獎感言：</label>
                        <textarea class="form-control" id="awardSpeech" style="resize: none;" rows="5">無</textarea>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label for="cover" class="form-label col">封面圖片：<small>（僅限上傳png和jpg檔）</small></label>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="file" class="form-control" id="cover" accept="image/png, image/jpeg">
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
import 'bootstrap'; 
import 'bootstrap/dist/css/bootstrap.min.css'; 

export default {
    
}
</script>

<style scoped>
.container{
  left: 50%;
  transform: translate(-50%, 0%);
}

.line {
    height: 1%;
    border-top: solid #000000;
}

form,
input,
textarea {
    font-size: 1.5rem;
}

small{
    font-size: 0.9rem;
    color: #ff0000;
    margin-left: 1%;
}

.require{
    color: #ff0000;
    display: inline-block;
}

</style>