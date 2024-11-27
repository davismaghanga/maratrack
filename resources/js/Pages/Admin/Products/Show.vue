<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({product:Object})
</script>

<template>
    <Head title="View Product"/>
    <AuthenticatedLayout>
        <div class="text-white block">
            <p><strong>Name:</strong>{{product.name}}</p>
            <p><strong>Opening Stock:</strong>{{product.opening_stock}}</p>
            <p><strong>Current Stock:</strong>{{product.current_stock}}</p>
            <p><strong>Closing Stock:</strong>{{product.closing_stock}}</p>
            <p><strong>Packaged Products:</strong>{{product.packaged_products}}</p>
        </div>
    </AuthenticatedLayout>

</template>
