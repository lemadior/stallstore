<template>
    <small class="error" v-show="message">{{ message }}</small>
</template>

<script setup>
    import { defineProps } from 'vue';

    defineProps({
        message: String
    });
</script>

<style scoped>
    .error {
        color: red;
        font-size: 12px;
    }
</style>
