<script setup>
import {Head, useForm} from '@inertiajs/vue3'
const form = useForm({
    name:null,
    country:null
});
function create(){
    form.post(route('clients.store'))
}
</script>

<template>
    <Head title="Create Client"/>
    <form @submit.prevent="create">
        <label for="name">Client Name:</label>
        <input id="name" v-model="form.name" />
        <div v-if="form.errors.name" class="text-red-500">
            {{form.errors.name}}
        </div>

        <label for="country">Country</label>
        <input id="country" v-model="form.country" />
        <div v-if="form.errors.country" class="text-red-500">
            {{form.errors.country}}
        </div>

        <button type="submit">Submit</button>
    </form>
</template>
