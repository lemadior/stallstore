<template>
    <header class="header">
        <div class="header__logo">
            <Link :href="route('about')"><img :src="logoBig" alt="Logo Main"></Link>
            <span class="shop_name">Simple Shop</span>
        </div>

        <div class="header__menu">
            <nav>
                <ul>
                    <li><Link :href="route('category')" :class="{'active' : $page.component === 'Store/Category'}">Categories</Link></li>
                    <li><Link :href="route('cart.show')" :class="{'active' : $page.component === 'Store/Cart'}">Cart</Link></li>
                    <li><Link :href="route('orders.show')">Orders</Link></li>
                    <li><Link :href="route('cart.show')" :class="{'nonempty' : cartItemCount, 'empty' : !cartItemCount }">
                            <div class="header__menu_cart" :class="{'nonempty' : cartItemCount, 'empty' : !cartItemCount }"><span class="cart__badge">{{ cartItemCount }}</span></div>
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<script setup>
    import { computed } from 'vue';

    import { usePage } from '@inertiajs/vue3';

    const logoBig = '/storage/store/LogoBig.png';

    const page = usePage();

    const cartItemCount = computed(() => page.props.cartItemCount);
</script>
