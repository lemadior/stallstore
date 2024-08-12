<template>
    <div :class="class">
        <h5>{{ name }}</h5>
        <p><input :type="type" v-model="model" :placeholder="placeholder"/></p>
        <ValidationError :message="message" />
    </div>
</template>

<script setup>
    import ValidationError from '../Components/ValidationError.vue';
    import {
        defineProps,
        defineModel,
    } from 'vue';

    const model = defineModel({
        type: null,
        required: true
    });

    defineProps({
        name: {
            type: String,
            required: true
        },
        type: {
            type: String,
            default: 'text'
        },
        placeholder: String,
        message: String,
        class: String
    });
</script>
