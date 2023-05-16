<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Table from "@/Pages/Users/Table.vue";
import {Head} from "@inertiajs/vue3";
import {storeToRefs} from "pinia";
import {useUsersStore} from "@/Store/UsersStore.js";
import {computed} from "vue";
import Managers from "@/Pages/Users/Managers.vue";

const title = "Managers"
const {users} = storeToRefs(useUsersStore());

const {fetchUsers} = useUsersStore();

fetchUsers();


const filteredUsers = computed(() => {
    return users.value.filter((user) => {
        return user.role.toLowerCase() === 'manager';
    });
});


</script>
<template>
    <Head><title>Managers</title></Head>

    <AuthenticatedLayout>

        <Table :user-type="title" :users="filteredUsers"/>


    </AuthenticatedLayout>

</template>
