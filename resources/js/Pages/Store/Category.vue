<template>
    <Head title="Category" />

    <section>
        <div class="container products">
            <div class="page__heading">
                PRODUCTS
                <span>{{ capitalize(scrubCategory(current)) }}</span>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="products">
                <select @change="updateSort" v-model="selectedSort" class="sorting">
                    <option value="placeholder" selected disabled>Choose sorting</option>
                    <option value="asc" >&nbsp;ASC by Price&nbsp;</option>
                    <option value="desc" >&nbsp;DESC by Price&nbsp;</option>
                </select>

                <Link
                    class="product__cart no-underline"
                    v-for="product in products"
                    :key="product.id"
                    :href="route('product.show', product.id)"
                >
                    <img :src="'storage/' + product.image" :alt="product.name">
                    <div class="product__info">
                        <h5>{{  product.name }}</h5>
                        <div class="price">
                            UAH {{ product.price }}₴
                            <span class="old_price">599₴</span>
                            <span class="discount">20% OFF</span>
                        </div>
                        <Link :href="route('cart.store', {'product_id': product.id, 'quantity': 1 })"  method="post" as="button" class="button">Add to cart</Link>
                    </div>
                </Link>
            </div>
        </div>
    </section>
</template>

<script setup>
    import {
        defineProps,
        defineEmits,
        onMounted,
        computed,
        ref
    } from 'vue';

    const props = defineProps({
        current: {
            type: String,
            required: true,
        },
        products: Array,
    });

    const selectedSort = ref('placeholder');

    const emit = defineEmits(['update-name']);

    const products = computed(() => {
        return props.products.sort((a, b) => {
            if (selectedSort.value === 'asc') {
                  return a.price - b.price;
            } else if (selectedSort.value === 'desc') {
                  return b.price - a.price;
            }
        });
    });

    function scrubCategory(name) {
        return props.current === 'all' ? 'all categories' : props.current;
    }

    function emitNameToParent() {
        emit('update-name', scrubCategory(props.current));
    }

    function capitalize(str) {
        return (str.charAt(0).toUpperCase() + str.slice(1));
    }

    function updateSort(event) {
        selectedSort.value = event.target.value;
    }

    onMounted(() => {
        emitNameToParent();
    });
</script>

<style scoped>
    .no-underline {
        text-decoration: none;
    }
</style>
