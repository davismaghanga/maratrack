<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps(['transaction','product','operator'])
</script>

<template>
    <Head title="View Product"/>
    <AuthenticatedLayout>
        <div class="text-white block">
            <p><strong>Product Name:</strong>{{props.product.name}}</p>
            <p><strong>Packaged/Restock:</strong>{{props.transaction.type}}</p>
            <p><strong>Qty Packed/Stocked:</strong>{{props.transaction.quantity}}</p>
            <p><strong>Packed/Stocked By:</strong>{{props.operator.name}}</p>
        </div>
    </AuthenticatedLayout>

</template>
