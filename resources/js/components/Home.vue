<template>
    <div class="container">
        <div class="w-4/5 h-4/5 absolute left-[10%] top-[15%]">
          <div class="relative h-[45%] w-full flex m-[2%] " v-for="i in 3">
            <div class="bg-gray-200 relative h-[94%] w-[30%] m-[3%] cursor-pointer" v-for="j in 3"></div>
          </div>
          <div class="w-full h-[10%] relative"></div>
        </div>
        
    </div>
  </template>
  
  <script setup>
    console.log('Component mounted(home).')
    
  </script>