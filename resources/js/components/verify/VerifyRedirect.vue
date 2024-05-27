<template>
  <div></div>
</template>

<script>
import Swal from 'sweetalert2';
import axios from 'axios';

export default {
  name: 'Verify',

  mounted() {
    this.showLoginPrompt();
  },

  methods: {
    showLoginPrompt() {
      Swal.fire({
        title: "Administrator Login",
        input: "password",
        inputAttributes: {
          autocapitalize: "off"
        },
        showCancelButton: true,
        confirmButtonText: "Login",
        showLoaderOnConfirm: true,
        preConfirm: (code) => {
          if (code === "111403530") {
            sessionStorage.setItem("verified", "true");
            console.log('Setting sessionStorage verified to true');
            return axios.post('/set-session')
              .then(response => {
                console.log('Session set response:', response.data);
                window.location.href = "/verify"; 
              })
              .catch(error => {
                Swal.showValidationMessage("請求失敗: " + error);
              });
          } else {
            Swal.showValidationMessage("登入碼錯誤");
          }
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.cancel) {
          window.location.href = "/";
        }
      });
    }
  }
};
</script>
