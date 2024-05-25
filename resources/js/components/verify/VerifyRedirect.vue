<template>
    <div></div>
  </template>
  
  <script>
  import Swal from 'sweetalert2';
  
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
              window.location.href = "/verify"; 
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
  
  