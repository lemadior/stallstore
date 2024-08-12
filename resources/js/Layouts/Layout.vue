<template>
    <div class="wrapper">
        <Header />
        <CategoriesNavigation :current="current"/>

        <main>
            <slot @update-name="handleNameUpdate"></slot>
       </main>

       <Footer />
    </div>
</template>

<script setup>
   import Header from '@/Pages/Components/Header.vue';
   import Footer from '@/Pages/Components/Footer.vue';
   import CategoriesNavigation from '@/Pages/Components/CategoriesNavigation.vue';

    const props = defineProps({
        current: {
            type: String,
            required: false,
        },
    });

    function handleNameUpdate(newName) {
        current.value = newName;
    }
</script>
