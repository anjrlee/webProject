<template>
    <div>
      <div class="h-full w-full relative">
        <img :src="coverImage" class="h-full w-full" />
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps, computed } from 'vue';
  
  const props = defineProps(['data']);
  
  const coverImage = computed(() => {
    return props.data.cover && props.data.cover.trim() !== ''
      ? props.data.cover
      : '/images/recordImg/default.jpg';
  });
  </script>
  