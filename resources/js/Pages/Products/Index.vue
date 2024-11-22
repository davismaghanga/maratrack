<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'


defineProps(['products'])
</script>

<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <div>
            <ol>
                <li v-for="product in products" :key="product.id" class="text-white">{{product.name}}
                    <Link :href="route('products.show',{product:product.id})" as="button" type="button">View</Link>
                    <Link :href="route('products.edit',{product:product.id})" as="button" type="button">Edit</Link>
                    <Link :href="route('products.destroy',{product:product.id})" as="button" method="delete" type="button">Delete</Link>
                </li>
            </ol>
        </div>
    </AuthenticatedLayout>
</template>
