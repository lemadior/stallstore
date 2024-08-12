
<template>
     <footer class="footer">
        <div class="footer__left">
            <p>© 2024. All rights reserved</p>
        </div>

        <div class="footer__middle">
            <Link :href="route('about')" :class="{'active' : $page.component === 'Store/About'}">About Me</Link>
            <Link :href="route('category')" :class="{'active' : $page.component === 'Store/Category'}">Categories</Link>
            <Link :href="route('cart.show')" :class="{'active' : $page.component === 'Store/Cart'}">Cart</Link>
            <Link :href="route('orders.show')" :class="{'active' : $page.component === 'Store/Orders'}">Orders</Link>
        </div>

        <div class="footer__separator"></div>

        <div class="footer__right">
            <p>Design by ME</p>
        </div>
    </footer>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
</script>
