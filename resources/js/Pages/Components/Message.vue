<template>
    <div v-show="success">
        <p class="success">
            {{ success }}
        </p>
    </div>
    <div v-show="error">
        <p class="error">
            {{ success }}
        </p>
    </div>
</template>

<script setup>
    import { usePage } from '@inertiajs/vue3';
    import { computed } from 'vue';

    const page = usePage();

    const success  = computed(() => page.props.flash.success);

    const error  = computed(() => page.props.flash.error);
</script>

<style scoped>
    .success, .error {
        width: 100%;
        color: white;
        padding-block: 15px;
        text-align: center;
        font-family: 'RobotoRegular';
        font-size: 18px;
    }

    .success {
        background-color: #51b779;;
    }

    .error {
        background-color: red;
    }
</style>
