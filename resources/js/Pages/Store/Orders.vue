<template>
    <Head title="Orders" />

    <section>
        <div class="container products">
            <div class="page__heading">
                Orders List
            </div>
        </div>
    </section>

    <section class="orders__is_empty hide">
        <div class="container">
            <div class="info">
                <p>
                    No orders found
                </p>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="cart">
                <table class="orders__table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Phone number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(order, index) in ordersData" :key="index">
                            <th scope="row">{{ order['serial'] }}</th>
                            <td>{{ order['name'] }}</td>
                            <td>{{ order['phone'] }}</td>
                            <td class="email">{{ order['email'] }}</td>
                            <td>{{ order['summary'] }}</td>
                            <td scope="col">{{ order['date'] }}</td>
                            <td>
                                <Link :href="route('order.show', {id: index})" method="get" as="button" class="show">👁</Link>
                                <Link :href="route('order.delete', {id: index})" method="delete" as="button" class="delete">✕</Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>


<script setup>
    import {
        defineProps,
    } from 'vue';

    const props = defineProps({
        ordersData: {
            type: Object,
            required: true,
        }
    });
</script>
