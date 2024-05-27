<template>
    <div class="container mt-[100px] z-[0] absolute">
        <div class="row justify-content-center mt-4">
            <div class="col">
                <p class="display-6"><strong>新增紀錄</strong><small>*為必填</small></p>
                <div class="line"></div>
                <form class="mt-4" @submit.prevent="showConfirmation">
                    <div class="mb-3">
                        <label for="type" class="form-label"><p class="require">*</p>類別：</label>
                        <select class="form-select" id="type" name="type" v-model="post.type" required>
                            <option value="leisure">休閒類</option>
                            <option value="study">學術研究類</option>
                            <option value="campus">校園生活類</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label"><p class="require">*</p>項目名稱：</label>
                        <input type="text" class="form-control" id="title" name="title" v-model="post.title" @input="fetchSimilarTitles" placeholder="丟松果最快速" required>
                        <ul v-if="similarTitles.length" class="form-control suggestion-list">
                            <p>相似項目：</p>
                            <li v-for="title in similarTitles" :key="title" @click="selectTitle(title)" class="form-control">{{ title }}</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label for="recordScore" class="form-label"><p class="require">*</p>完成紀錄：</label>
                        <input type="text" class="form-control" id="recordScore" name="recordScore" v-model="post.recordScore" placeholder="100(km/hr)" required>
                    </div>
                    <div class="mb-3">
                        <label for="recorder" class="form-label"><p class="require">*</p>完成者：</label>
                        <input type="text" class="form-control" id="recorder" name="recorder" v-model="post.recorder" placeholder="王小明" required>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label for="date" class="form-label col"><p class="require">*</p>完成日期：<small>（請點選月曆圖示選擇日期）</small></label>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="date" name="date" v-model="post.date" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label for="proveFile" class="form-label col"><p class="require">*</p>證明檔案：<small>（請將檔案上傳至Google Drive或YouTube等平台，貼上共享連結）</small></label>
                        </div>
                        <input type="url" class="form-control" id="proveFile" name="proveFile" v-model="post.proveFile" placeholder="https://drive.google.com/..." required>
                    </div>
                    <div class="mb-3">
                        <label for="awardSpeech" class="form-label">得獎感言：</label>
                        <textarea class="form-control" id="awardSpeech" name="awardSpeech" v-model="post.awardSpeech" style="resize: none;" rows="5">無</textarea>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label for="cover" class="form-label col">封面圖片：<small>（僅限上傳png和jpg檔，橫版照片為佳）</small></label>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="cover" name="cover" @change="handleFileUpload" accept="image/png, image/jpeg">
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

export default {
    name: 'addPost',
    data() {
        return {
            post: {
                title: '',
                date: '',
                recorder: '',
                awardSpeech: '',
                type: '',
                recordScore: '',
                proveFile: '',
                cover: null,
            },
            similarTitles: [],
            errorMessage: '',
            userId: null,
        };
    },
    mounted(){
        const userId = document.getElementById('app').dataset.userId;
        if(userId){
            this.userId = userId;
        }
    },
    methods: {
        handleFileUpload(event) {
            this.post.cover = event.target.files[0];
        },
        async fetchSimilarTitles() {
            if (this.post.title.length) {
                try {
                    const response = await axios.get(`http://127.0.0.1:8000/api/similar-titles`, {
                        data: {
                            title: this.post.title
                        }
                    });
                    this.similarTitles = response.data;
                } catch (error) {
                    console.error('Error fetching similar titles:', error);
                }
            } else {
                this.similarTitles = [];
            }
        },
        selectTitle(title) {
            this.post.title = title;
            this.similarTitles = [];
        },
        async showConfirmation() {
            if (this.post.cover) {
                if (this.post.cover.type !== 'image/png' && 
                    this.post.cover.type !== 'image/jpg' && 
                    this.post.cover.type !== 'image/jpeg') {
                    window.alert('封面圖片僅限上傳png和jpg檔！');
                    return; 
                }
            }
            const confirmationMessage = `類別：${this.post.type}\n項目名稱：${this.post.title}\n完成紀錄：${this.post.recordScore}\n完成者：${this.post.recorder}\n完成日期：${this.post.date}\n證明檔案：${this.post.proveFile}\n得獎感言：${this.post.awardSpeech}`;
            if (window.confirm(`請檢查您的輸入是否正確。\n\n${confirmationMessage}`)) {
                const formData = new FormData();
                formData.append('user_id', this.userId);
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
                    const response = await axios.post("http://127.0.0.1:8000/api/add-post", formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    if (response.status === 200) {
                        alert(response.data.message);
                        window.location.href = '/';
                    }
                } catch (error) {
                    if (error.response && error.response.status === 422) {
                        this.errorMessage = error.response.data.errors;
                    } else {
                        this.errorMessage = "There was an error submitting the form!";
                    }
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
select{
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

.suggestion-list {
    border: 1px solid #ccc;
    max-height: 150px;
    overflow-y: auto;
}

.suggestion-list li {
    cursor: pointer;
    background: #f8f8f8;
    border-bottom: 1px solid #ccc;
    margin-bottom: 3px;
}

.suggestion-list li:hover {
    background: #ececec;
}
</style>