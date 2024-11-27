<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({client:Object})
</script>

<template>
    <Head title="View Client"/>
    <AuthenticatedLayout>
        <div class="text-white block">
            <p><strong>Name:</strong>{{client.name}}</p>
            <p><strong>Country:</strong>{{client.country}}</p>
        </div>
    </AuthenticatedLayout>

</template>
