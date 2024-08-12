<template>
    <section class="categories">
        <div class="container active">
            <ul>
                <li v-for="category in categories" :key="category.id">
                    <Link
                        :href="route('category', { name: category[0] })"
                        :class="{ 'active' : current === category[0] }"
                    >
                        {{ category[1] }}
                    </Link>
                </li>
            </ul>
        </div>
    </section>
    <Message />
</template>

<script setup>
    import Message from '../Components/Message.vue';

    const categoriesMap = {
        'all': 'All categories',
        'clothes': 'Clothes',
        'weapons': 'Weapons',
        'gadgets': 'Gadgets',
        'electronics': 'Electronics',
        'kitchenwares': 'Kitchenwares'
    };

    const categories = Object.entries(categoriesMap);

    const props = defineProps({
        current: {
            type: String
        }
    });
</script>
