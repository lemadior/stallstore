<template>
    <Head title="Checkout" />

    <section>
        <div class="container show__order">
            <div class="page__heading">
                Checkout
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form class="order" @submit.prevent="submit">
                <TextInput
                    name="Name"
                    type="text"
                    v-model="formData.name"
                    :message="errors.name"
                    class="name"
                    placeholder="Type name and surname"
                />

                <TextInput
                    name="Phone"
                    type="tel"
                    v-model="formData.phone"
                    :message="errors.phone"
                    class="phone"
                    placeholder="Type phone number"
                />

                <TextInput
                    name="Email"
                    type="email"
                    v-model="formData.email"
                    :message="errors.email"
                    class="email"
                    placeholder="Type Your email"
                />

                <div class="order__products">
                    <h5>Cart Products</h5>
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
                            <tr v-for="(product, index) in productsData" :key="index">
                                <td>{{ product['sku'] }}</td>
                                <td>{{ product['name'] }}</td>
                                <td>{{ product['quantity'] }}</td>
                                <td>UAH {{ product['total'] }}₴</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="price">
                    <h5>Summary price</h5>
                    <p>UAH {{ summary }}₴</p>
                </div>

                <div class="cart__buttons">
                    <Link :href="route('checkout.store')":data="formData" @error="handleErrors" method="post" as="button" class="confirm_order">Confirm Order</Link>
                </div>

            </form>
        </div>
    </section>
</template>

<script setup>
    import TextInput from '../Components/TextInput.vue';
    import { useForm, usePage } from '@inertiajs/vue3';
    import {
        defineProps,
        ref,
        computed
    } from 'vue';

    const page = usePage();

    const form = useForm({
        name: null,
        phone: null,
        email: null
    });

    const props = defineProps({
        productsData: {
            type: Object,
            required: true,
        }
    });

    const summary = computed(() => {
        const cartProducts = Object.entries(props.productsData);

        return cartProducts.reduce((sum, product, index) => {
            return sum + product[1].total;
        }, 0);
    });

    const submit =() => {
        form.post(route('checkout.store'));
    };

    const formData = ref({
        name: '',
        email: '',
        phone: '',
        user_id: page.props.auth.user.id,
        products_data: props.productsData
    });

    const errors = ref({});

    const handleErrors = (responseErrors) => {
        errors.value = responseErrors;
    }
</script>
