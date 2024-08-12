<template>
    <Head title="Product" />

    <section>
        <div class="container products">
            <div class="page__heading">
                Product
                <span><strong>{{ product.name }}</strong></span>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="product">
                <img :src="imageUrl" :alt="product.name" />
                <div class="product__info">
                    <p class="sku">SKU: {{ product.sku }}</p>
                    <div class="description">
                        <h5>Description:</h5>
                        <p>
                            {{ product.description }}
                        </p>
                    </div>
                    <div class="price">
                        <h5>Price</h5>
                        <p>{{ product.price }}₴</p>
                    </div>

                    <Link :href="route('cart.store', {'product_id': product.id, 'quantity': 1 })"  method="post" as="button" class="button">Add to cart</Link>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
    import {
        defineProps,
        defineEmits,
        onMounted,
        ref,
        computed,

    } from 'vue';

    const props = defineProps({
        product: {
            type: Object,
            required: true,
        },
        imageUrl: {
            type: String,
            required: true
        }
    });

</script>

<style scoped>
    .sku {
        width: 100%;
        text-align: right;
    }
</style>
