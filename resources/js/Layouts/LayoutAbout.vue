<template>
     <div class="wrapper">
        <MainHeader />

        <main>
            <slot />
        </main>

        <Footer />
    </div>
</template>

<script setup>
    import MainHeader from '@/Pages/Components/MainHeader.vue';
    import Footer from '@/Pages/Components/Footer.vue';
</script>
