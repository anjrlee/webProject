<template>
    <div class="container mt-[100px] z-[0] absolute">
        <div class="row justify-content-center mt-4">
            <div class="col">
                <p class="display-6"><strong>新增紀錄</strong><small>*為必填</small></p>
                <div class="line"></div>
                <form class="mt-4" @submit.prevent="showConfirmation">
                    <div class="mb-3">
                        <label for="type" class="form-label"><p class="require">*</p>類別：</label>
                        <select class="form-select" id="type" required>
                            <option value="leisure">休閒類</option>
                            <option value="study">學術研究類</option>
                            <option value="campus">校園生活類</option>
                        </select>
                    </div>
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
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="cover" accept="image/png, image/jpeg">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-black">送出</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    name: 'addPost',
    data(){
        return{
            post:{
            title: '',
            date: '',
            recorder:'',
            awardSpeech: '',
            type: '',
            recordScore:'',
            proveFile:'',
            cover:null,
            },

        }
    },
    methods:{
        handleFileUpload(event) {
            this.post.cover = event.target.files[0];
        },

        async showConfirmation(){
            const type = document.getElementById('type').value;
            const title = document.getElementById('title').value;
            const recordScore = document.getElementById('recordScore').value;
            const recorder = document.getElementById('recorder').value;
            const date = document.getElementById('date').value;
            const proveFile = document.getElementById('proveFile').value;
            const awardSpeech = document.getElementById('awardSpeech').value;
            const cover = document.getElementById('cover').value;
            const confirmationMessage = `類別：${type}\n項目名稱：${title}\n完成紀錄：${recordScore}\n完成者：${recorder}\n完成日期：${date}\n證明檔案：${proveFile}\n得獎感言：${awardSpeech}\n封面圖片：${cover}`;
            if (window.confirm(`請檢查您的輸入是否正確。\n\n${confirmationMessage}`)) {
                const formData = new FormData();
                formData.append('type', this.post.type);
                formData.append('title', this.post.title);
                formData.append('recordScore', this.post.recordScore);
                formData.append('recorder', this.post.recorder);
                formData.append('awardSpeech', this.post.awardSpeech);
                formData.append('proveFile', this.post.proveFile);
                formData.append('date', this.post.date);
                if (this.post.cover) {
                    formData.append('cover', this.post.cover);
                }
                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    const response = await axios.post("http://127.0.0.1:8000/api/add-post", formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                        _token: csrfToken
                    });
                    if (response.status === 200) {
                        alert(response.data.message);
                    }
                }catch (error) {
                    console.error("There was an error submitting the form!", error);
                }

            }
        },

    }
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
textarea,
button,
select {
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

.btn-black {
    background-color: #000000;
    color: #ffffff;
    border: none;
}

.btn-black:hover {
    background-color: #2f2f2f;
}
</style>