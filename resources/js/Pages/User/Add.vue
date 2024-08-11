<template>
<form @submit.prevent="create">
    <lable>Name</lable>
    <input type="text" v-model="form.name"/>
    <lable>Email</lable>
    <input type="text" v-model="form.email"/>
    <lable>Phone</lable>
    <input type="text" v-model="form.phone_number"/>
    <lable>Address</lable>
    <input type="text" v-model="form.address"/>

    <button type="submit">Submit</button>
</form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';


defineProps({
    user: {
        type: Object,
        required: true
    }
})

const form = useForm({
    name: null,
    email: null,
    phone_number: null,
    address: null
});

const create = () => form.post('/store-user');
</script>
