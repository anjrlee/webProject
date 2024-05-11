<template>
    <div>
        <div class="h-full w-full relative">
            <img :src="props.data.cover" class="h-full w-full" />
        </div>
    </div>
</template>
<script setup>
import {defineProps} from 'vue'
const props = defineProps(['data'])
</script>