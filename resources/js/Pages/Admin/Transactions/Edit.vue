<script setup>
import { useForm } from '@inertiajs/vue3'
const props = defineProps(['product','product_id','products','clients','client_id','transaction'])
const form = useForm(
    { product_id: props.product_id, type: props.transaction.type, client_id:props.client_id, packaged_products:props.product.packaged_products, quantity:props.transaction.quantity}
);
import { computed } from "vue";
const isVisible = computed(() => form.type === "packaged");

function recordTransaction(){
    form.put(route('transactions.update',{transaction:props.transaction.id}))
}

</script>

<template>
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
                <label class="block text-sm font-medium text-gray-700">Product</label>
                <select v-model="form.product_id" class="w-full p-2 border rounded" required>
                    <option v-for="product in products" :key="product.id" :value="product.id">{{ product.name }}</option>
                </select>
                <div v-if="form.errors.product_id" class="text-red-500">
                    {{form.errors.product_id}}
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select v-model="form.type" class="w-full p-2 border rounded" required>
                    <option value="">Select an option</option>
                    <option value="restock">Restock</option>
                    <option value="packaged">Packaged</option>
                </select>
                <div v-if="form.errors.type" class="text-red-500">
                    {{form.errors.type}}
                </div>
            </div>

            <div v-if="isVisible">
                <label class="block text-sm font-medium text-gray-700">Packaged Products</label>
                <input v-model="form.packaged_products" type="number" class="w-full p-2 border rounded" placeholder="No of Packaged Products" min="0"/>
                <div v-if="form.errors.packaged_products" class="text-red-500">
                    {{form.errors.packaged_products}}
                </div>
            </div>

            <div v-if="isVisible">
                <label class="block text-sm font-medium text-gray-700">Client</label>
                <select v-model="form.client_id" class="w-full p-2 border rounded">
                    <option v-for="client in clients" :key="client.id" :value="client.id">{{ client.name }}</option>
                </select>
                <div v-if="form.errors.client_id" class="text-red-500">
                    {{form.errors.client_id}}
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                <input v-model="form.quantity" type="number" class="w-full p-2 border rounded" placeholder="Quantity" required />
                <div v-if="form.errors.quantity" class="text-red-500">
                    {{form.errors.quantity}}
                </div>
            </div>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Submit</button>
        </form>
    </div>
</template>
