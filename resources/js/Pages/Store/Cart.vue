<template>
    <Head title="Cart" />

    <section>
        <div class="container products">
            <div class="page__heading">
                Shopping Cart
            </div>
        </div>
    </section>

    <section class="cart__is_empty" :class="isCartEmpty">
        <div class="container">
            <div class="info">
                <p>
                    The cart is empty
                </p>
            </div>
        </div>
    </section>

    <section :class="{'hide' : isCartEmpty === 'show'}">
        <div class="container">
            <div class="cart">
                <table class="cart__table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">SKU</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(product, index) in productsData" :key="index">
                            <th scope="row"><Link :href="route('product.show', index)"><img :src="product['image']" alt=""></Link></th>
                            <td>{{ product['name'] }}</td>
                            <td>{{ product['sku'] }}</td>
                            <td class="quantity_column">
                                <div>
                                    <input
                                        type="text"
                                        v-model.text="productsQuantity[index]"
                                        class="quantity"
                                    />
                                    <Link
                                        :href="route('cart.update', { product_id: index, quantity: productsQuantity[index]})"
                                        method="patch"
                                        as="button"
                                        class="update"
                                    >
                                        ⟳
                                    </Link>
                                </div>
                                <Link :href="route('cart.delete', { product_id: index})" method="delete" as="button" class="delete">✕</Link>
                            </td>
                            <td>{{ product['price'] }}</td>
                            <td>{{ product['price'] * productsQuantity[index] }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="row" colspan="5">Summary</th>
                            <td class="summary">{{ summary }}</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="cart__buttons">
                    <Link :href="route('category')" id="continue_shopping" class="shopping">Continue Shopping</Link>
                    <Link :href="route('checkout.show')" id="checkout" class="checkout">Checkout</Link>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
    import {
        defineProps,
        onMounted,
        computed,
        ref
    } from 'vue';

    import { usePage } from '@inertiajs/vue3';

    const page = usePage();

    const isCartEmpty = ref('hide');

    const props = defineProps({
        productsData: {
            type: Object,
            required: true,
        }
    });

    const cartItemCount = computed(() => page.props.cartItemCount);

    const productsQuantity = ref([]);

    const quantities = ref([]);

    isCartEmpty.value = cartItemCount.value > 0 ? 'hide' : 'show';

    onMounted(() => {
        const cartProducts = Object.entries(props.productsData);

        cartProducts.forEach(product => productsQuantity.value[product[0]] = product[1].quantity);
    });

    const summary = computed(() => {
        const cartProducts = Object.entries(props.productsData);

        return cartProducts.reduce((sum, product, index) => {
            return sum + product[1].price * productsQuantity.value[product[0]];
        }, 0);
    });
</script>
