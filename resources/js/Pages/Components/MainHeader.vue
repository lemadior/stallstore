<template>
    <header class="header">
        <div class="header__logo">
            <Link :href="route('about')"><img :src="logoBig" alt="Logo Main"></Link>
            <span class="shop_name">Simple Shop</span>
        </div>

        <div class="header__menu">
            <Link :href="route('category')">Go to Store</Link>
        </div>
</header>
</template>

<script setup>
    const logoBig = '/storage/store/LogoBig.png';
</script>
