<template>
    <div class="modal">
        <h2 class="text-black">Generate Report for Product ID: {{ productId }}</h2>
        <form @submit.prevent="submitReport" class="space-y-4 mt-4">
            <label for="start-date" class="label">Start Date:</label>
            <input id="start-date" class="input w-full p-2 border rounded" type="date" v-model="form.startDate" required />

            <label for="end-date">End Date:</label>
            <input id="end-date" class="input w-full p-2 border rounded" type="date" v-model="form.endDate" required />

            <label for="type">Type of Product Transaction</label>
            <select v-model="form.type" id="type" class="w-full p-2 border rounded" required>
                <option value="" disabled selected>Select the type of report</option>
                <option value="restock">Restocks</option>
                <option value="packaged">Packagings</option>
                <option value="tanzaniaBulk">Tanzania Bulk Orders</option>
            </select>

            <div class="flex justify-between items-center">
                <button type="submit" class="btn">Submit</button>
                <button type="button" class="btn" @click="$emit('close')">Cancel</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import {ref} from 'vue'
import {useForm} from "@inertiajs/vue3";
const props = defineProps({
    productId: Number,
});


const type = ref()
const form = useForm({
    productId:props.productId,
    startDate:'',
    endDate:'',
    type:''
})


const submitReport = () => {
    console.log(props.productId +' '+ form.startDate + ' '+ form.endDate)
    form.get(route('product.reportStock'))

};

</script>

<style>
.modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
</style>
