<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import {storeToRefs} from "pinia";
import {useUsersStore} from "@/Store/UsersStore.js";
import {computed} from "vue";
import ManagerTable from "@/Pages/Users/ManagerTable.vue";

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

        <ManagerTable :user-type="title" :users="filteredUsers"/>


    </AuthenticatedLayout>

</template>
