<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Table from "@/Pages/Users/Table.vue";
import {Head} from "@inertiajs/vue3";
import {storeToRefs} from "pinia";
import {useUsersStore} from "@/Store/UsersStore.js";
import {computed} from "vue";

const title = "BackOffice"
const {users} = storeToRefs(useUsersStore());

const {fetchUsers} = useUsersStore();

fetchUsers();


const filteredUsers = computed(() => {
    return users.value.filter((user) => {
        return user.role.toLowerCase() === 'backoffice';
    });
});



</script>
<template>
    <Head><title>BackOffice</title></Head>

    <AuthenticatedLayout>

        <Table :user-type="title" :users="filteredUsers"/>

    </AuthenticatedLayout>

</template>
