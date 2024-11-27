<script setup>
import { useForm } from '@inertiajs/vue3'
defineProps(['products'])
const form = useForm(
    { product_id: '', closing_stock: '' }
);

function closeProduct(){
    form.post(route('products.closeStock'))
}

</script>

<template>
    <div class="p-4">
        <h1 class="text-2xl font-semibold mb-4">Close Stock</h1>
        <div class="text-red-500 mt-2 rounded-2xl border-gray-800">
            {{form.errors.error}}
        </div>
        <form @submit.prevent="closeProduct" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Product</label>
                <select v-model="form.product_id" class="w-full p-2 border rounded" required>
                    <option v-for="product in products" :key="product.id" :value="product.id">{{ product.name }}</option>
                </select>
                <div v-if="form.errors.product_id" class="text-red-500">
                    {{form.errors.product_id}}
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Closing Stock Amt</label>
                <input v-model="form.closing_stock" type="number" class="w-full p-2 border rounded" placeholder="Closing Stock" min="0" required />
                <div v-if="form.errors.closing_stock" class="text-red-500">
                    {{form.errors.closing_stock}}
                </div>
            </div>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Submit</button>
        </form>
    </div>
</template>
