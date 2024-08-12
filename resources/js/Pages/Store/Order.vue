<template>
    <Head title="Order" />

    <section>
        <div class="container show__order">
            <div class="page__heading">
                Order {{ order.serial }}
                <span>{{ orderDate }}</span>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="order">
                <div class="name">
                    <h5>Name</h5>
                    <p>{{ user.name }}</p>
                </div>

                <div class="phone">
                    <h5>Phone</h5>
                    <p>{{ user.phone }}</p>
                </div>

                <div class="email">
                    <h5>Email</h5>
                    <p>{{ user.email }}</p>
                </div>

                <div class="order__products">
                    <h5>Products</h5>
                    <table>
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Product name</th>
                                <th>Quantity</th>
                                <th>Total price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in productsData">
                                <td>{{ product['sku'] }}</td>
                                <td>{{ product['name'] }}</td>
                                <td>{{  product['quantity'] }}</td>
                                <td>UAH {{ product['total'] }}₴</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="price">
                    <h5>Summary price</h5>
                    <p>UAH {{ summary }}₴</p>
                </div>
            </div>
        </div>

    </section>
</template>

<script setup>
    import {
        defineProps,
        ref,
        computed
    } from 'vue';

    const orderDate = ref('');

    const props = defineProps({
        order: {
            type: Object,
            required: true
        },
        productsData: {
            type: Object,
            required: true,
        },
        user: {
            type: Object,
            required: true
        }
    });

    const summary = computed(() => {
        const cartProducts = Object.entries(props.productsData);

        return cartProducts.reduce((sum, product, index) => {
            return sum + product[1].total;
        }, 0);
    });

    // Reformat incoming date to the format 'YYYY-mm-dd'
    orderDate.value = (new Date(props.order.created_at)).toISOString().split('T')[0];
</script>
