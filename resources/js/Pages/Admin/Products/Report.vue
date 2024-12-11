<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from "vue";
import { format } from "date-fns";

defineProps(['transactions'])

const columns = ref([
    { title: "ID", data: "id" },
    { title: "Product Name", data: "product.name" },
    { title: "Transaction Type", data: "type" },
    { title: "Quantity", data: "quantity" },
    { title: "Operator", data: "user.name" },
    {
        title: "Date",
        data:"created_at",
        render:(data) =>format(new Date(data),"yyyy-MM-dd HH:mm:ss")

    }
]);
</script>

<template>
    <Head title="Product Transaction Report"/>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <DataTable
                            :data="transactions"
                            :columns="columns"
                            class="display"
                        >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Transaction Type</th>
                                <th>Quantity (kg/l)</th>
                                <th>Operator</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
