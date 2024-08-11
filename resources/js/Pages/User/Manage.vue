<template>
<Link :href="`/create-user`">Add User</Link>
    <table>
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td><Link :href="`/edit-user/${user.id}`">{{user.id}}</Link></td>
                <td><Link :href="`/edit-user/${user.id}`">{{user.name}}</Link></td>
                <td>{{user.email}}</td>
                <td>{{user.phone_number}}</td>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
defineProps({
    users: {
        type: Array,
        required: true
    }
})
</script>
