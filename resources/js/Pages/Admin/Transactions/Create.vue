<script setup>
import {Head, useForm} from '@inertiajs/vue3'
defineProps(['products'])
const form = useForm(
    { product_id: '', type: 'restock', client_id:null, packaged_products:0, quantity: '' }
);
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

function recordTransaction(){
    form.post(route('transactions.store'))
}

</script>

<template>
    <Head title="Restock/Package (Admin)" />
    <AuthenticatedLayout>
        <div class="p-4">
            <h1 class="text-2xl font-semibold mb-4">Restock/Package</h1>
            <div v-if="$page.props.flash.success" class="text-gray-600 bg-green-400 w-full border-gray-200 px-2">
                {{$page.props.flash.success}}
            </div>
            <div class="text-red-500 mt-2 rounded-2xl w-full border-gray-200">
                {{form.errors.error}}
            </div>

            <form @submit.prevent="recordTransaction" class="space-y-4">
                <div>
                    <label>Product</label>
                    <select v-model="form.product_id" class="w-full p-2 border rounded" required>
                        <option v-for="product in products" :key="product.id" :value="product.id">{{ product.name }}</option>
                    </select>
                    <div v-if="form.errors.product_id" class="text-red-500">
                        {{form.errors.product_id}}
                    </div>
                </div>
                <div>
                    <label>Type</label>
                    <select v-model="form.type" class="w-full p-2 border rounded" required>
                        <option value="">Select an option</option>
                        <option value="restock">Restock</option>
                        <option value="packaged">Packaged</option>
                    </select>
                    <div v-if="form.errors.type" class="text-red-500">
                        {{form.errors.type}}
                    </div>
                </div>

                <div>
                    <label>Quantity Packaged/Restocked (kgs):</label>
                    <input v-model="form.quantity" type="number" class="w-full p-2 border rounded" placeholder="Quantity" required min="0" step="0.01"/>
                    <div v-if="form.errors.quantity" class="text-red-500">
                        {{form.errors.quantity}}
                    </div>
                </div>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Submit</button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
