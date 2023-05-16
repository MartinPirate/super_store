<script setup>

import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {reactive, ref} from "vue";
import {storeToRefs} from "pinia";
import {useSupermarketStore} from "@/Store/SupermarketStore.js";
import DialogModal from "@/Components/DialogModal.vue";
import {useLocationStore} from "@/Store/LocationStore.js";
import {useUsersStore} from "@/Store/UsersStore.js";

/*modals variables*/
let showDetailsModal = ref(false);
let showCreateModal = ref(false);
let showEditModal = ref(false);
let showDeleteModal = ref(false);
let showUploadSuppliersModal = ref(false);


const suppliersCSV = ref(null);

const {supermarkets, supermarket, loading, error} = storeToRefs(useSupermarketStore());

const {locations} = storeToRefs(useLocationStore());

const {users} = storeToRefs(useUsersStore());


const {
    fetchSupermarkets,
    fetchSupermarketById,
    createSupermarket,
    updateSupermarket,
    deleteSupermarket,
    uploadAttachment
} = useSupermarketStore();
const {fetchLocations} = useLocationStore();
const {fetchUsers} = useUsersStore();

fetchSupermarkets();
fetchUsers();
fetchLocations();



const createForm = reactive({
    name: '',
    location_id: '',
    manager_id: '',
});

const editForm = reactive({
    id: '',
    name: '',
    location_id: '',
    manager_id: '',
});

const deleteForm = reactive({
    id: '',

});

const uploadCSvForm = reactive({
    id: '',
    csvfile: ''
})


const openDetailsModal = async (id) => {
    await fetchSupermarketById(id)
    console.log(supermarket)
    showDetailsModal.value = true;
};

const closeDetailsModal = () => {
    showDetailsModal.value = false;
};

const OpenCreateModal = async () => {
    showCreateModal.value = true;
}

const closeCSVModal = () => {
    showUploadSuppliersModal.value = false
}

const closeCreateModal = () => {
    showCreateModal.value = false;
}
const closeEditModal = () => {
    showEditModal.value = false;
}

const openDeleteModal = (id) => {
    deleteForm.id = id;
    showDeleteModal.value = true;
};
const closeDeleteModal = () => {
    showDeleteModal.value = false;
}

const uploadCSVModal = (id) => {
    uploadCSvForm.id = id
    showUploadSuppliersModal.value = true
}
const addSupermarket = async () => {

    const newSupermarket = {
        'name': createForm.name,
        'location_id': createForm.location_id,
        'manager_id': createForm.manager_id
    }
    await createSupermarket(newSupermarket);

    showCreateModal.value = false;

}

const openEditModal = (supermarket) => {
    editForm.id = supermarket.id;
    editForm.name = supermarket.name;
    editForm.location_id = supermarket.location_id;
    showEditModal.value = true;
};

const updateSuData = async () => {

    const supermarket = {
        id: editForm.id,
        name: editForm.name,
        location_id: editForm.location_id
    };
    await updateSupermarket(supermarket);

    closeEditModal();

}

const deleteSupermarketById = () => {
    deleteSupermarket(deleteForm.id)
    showDeleteModal.value = false;
};


const uploadSuppliers = async () => {

    const file = suppliersCSV.value.files[0];
    const formData = new FormData();
    console.log(uploadCSvForm.id)
    formData.append('id', uploadCSvForm.id);
    formData.append('file', file);
    await uploadAttachment(formData);

    closeCSVModal();


}


</script>

<template>
    <Head><title>SuperMarkets</title></Head>

    <AuthenticatedLayout>

        <div
            class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
            <div class="w-full mb-1">
                <div class="mb-4">
                    <nav class="flex mb-5" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                            <li class="inline-flex items-center">
                                <a href="#"
                                   class="inline-flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                                    <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                    </svg>
                                    Home
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="#"
                                       class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">supermarkets</a>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                                          aria-current="page">List</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Supermarkets</h1>
                </div>
                <div class="sm:flex">
                    <div
                        class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                        <label for="users-search" class="sr-only">Search</label>
                        <div class="relative mt-1 lg:w-64 xl:w-96">
                            <input type="text" v-model="supermarketSearch"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Search from Supermarkets">
                        </div>
                    </div>
                    <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                        <button type="button" data-modal-toggle="add-user-modal"
                                @click="OpenCreateModal"
                                class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            Add Supermarket
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all" aria-describedby="checkbox-1" type="checkbox"
                                               class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Name
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Location
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Manager
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Created At
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Updated At
                                </th>

                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Actions
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
                                   v-for="item in supermarkets" :key="item.id">
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="w-4 p-4"
                                    @click="openDetailsModal(item.id)"
                                >
                                    <div class="flex items-center">
                                        <input id="checkbox-194556" aria-describedby="checkbox-1" type="checkbox"
                                               class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-194556" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    <div class="text-base font-semibold text-gray-900 dark:text-white">{{ item.name }}
                                    </div>
                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ item.name }}
                                    </div>
                                </td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ item.location }}
                                </td>
                                <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">
                                    {{ item.manager }}
                                </td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ item.created_at }}
                                </td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ item.updated_at }}
                                </td>
                                <td class="p-4 space-x-2 whitespace-nowrap">
                                    <button type="button" id="updateProductButton"
                                            @click="openEditModal(item)"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                            <path fill-rule="evenodd"
                                                  d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        Update
                                    </button>

                                    <button type="button" id="uploadSuppliersButton"
                                            @click="uploadCSVModal(item.id)"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                            <path fill-rule="evenodd"
                                                  d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        Upload Suppliers
                                    </button>


                                    <button type="button" id="deleteProductButton"
                                            @click="openDeleteModal(item.id)"
                                            data-drawer-target="drawer-delete-product-default"
                                            data-drawer-show="drawer-delete-product-default"
                                            aria-controls="drawer-delete-product-default" data-drawer-placement="right"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


        <!--  Details Modal  -->

        <DialogModal :show="showDetailsModal" id="delete-user-modal">
            <!-- Modal content -->
            <template #title>
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-semibold dark:text-white">
                        {{ supermarket.name }} Details
                    </h3>
                    <button type="button"
                            @click="closeDetailsModal"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                            data-modal-toggle="add-user-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </template>

            <!-- Modal body -->

            <template #content>

                <div class="p-2 pt-0 text-center">
                    <div class="mt-2 ">
                        <dl class="divide-y divide-gray-100">
                            <div class="px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Name</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ supermarket.name }}
                                </dd>
                            </div>
                            <div class="px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Location</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ supermarket.location }}
                                </dd>
                            </div>

                            <div class="px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Manager</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ supermarket.manager }}
                                </dd>
                            </div>

                            <div class="px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Created Date</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ supermarket.created_at }}
                                </dd>
                            </div>

                            <div class="px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Updated Date</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ supermarket.updated_at }}
                                </dd>
                            </div>

                            <div class="px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Employees</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"
                                    v-show="supermarket.employees.data">
                                    <ul class="list-style-type: disc" v-for="item in supermarket.employees.data">
                                        Name:
                                        <li>{{ item.name }}, Phone: {{ item.phone }}, Location: {{ item.location }}</li>
                                    </ul>
                                </dd>
                            </div>

                            <div class="px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Suppliers</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"
                                    v-show="supermarket.suppliers.data.length !==0">
                                    <ul class="list-none" v-for="item in supermarket.suppliers.data">
                                        Name:
                                        <li>{{ item.name }}, Phone: {{ item.phone }}, Location: {{ item.location }}</li>
                                    </ul>
                                </dd>
                            </div>

                        </dl>
                    </div>

                </div>
            </template>

            <!-- Modal footer -->
            <template #footer>
                <button
                    @click="closeDetailsModal"
                    class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                    data-modal-toggle="delete-user-modal">
                    close Modal
                </button>

            </template>

        </DialogModal>


        <!--  create modal-->
        <DialogModal :show="showCreateModal" id="add-create-modal">
            <!-- Modal content -->
            <template #title>
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-semibold dark:text-white">
                        Add new SuperMarket
                    </h3>
                    <button type="button"
                            @click="closeCreateModal"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                            data-modal-toggle="add-user-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </template>

            <!-- Modal body -->

            <template #content>
                <div class="p-6 space-y-6">
                    <form action="#">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" v-model="createForm.name"
                                       class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Supermarket Name" required="">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <div>
                                    <label for="role"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Select Location</label>
                                    <select
                                        v-model="createForm.location_id"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    >
                                        <option v-for="location in locations" :key="location.id"
                                                :value="location.id">
                                            {{ location.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <div>
                                    <label for="role"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Set a Manager (Optional)</label>
                                    <select
                                        v-model="createForm.manager_id"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    >
                                        <option v-for="user in users" :key="user.id">{{ user.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </template>

            <!-- Modal footer -->
            <template #footer>
                <div class="items-center p-2 border-t border-gray-200 rounded-b dark:border-gray-700">
                    <button
                        @click="addSupermarket"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        type="submit">Add Supermarket
                    </button>
                </div>
            </template>

        </DialogModal>

        <!--    Edit Modal    -->
        <DialogModal :show="showEditModal" id="edit-user-modal">
            <!-- Modal content -->
            <template #title>
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-semibold dark:text-white">
                        Edit Supermarket
                    </h3>
                    <button type="button"
                            @click="closeEditModal"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                            data-modal-toggle="add-user-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </template>

            <!-- Modal body -->

            <template #content>
                <div class="p-6 space-y-6">
                    <form action="#">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">

                                <input type="hidden" v-model="editForm.id">
                                <label for="name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" v-model="editForm.name"
                                       class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="Subject Name" required="">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <div>
                                    <label for="role"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Select Location</label>
                                    <select
                                        v-model="editForm.location_id"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    >
                                        <option v-for="location in locations" :key="location.id"
                                                :value="location.id">
                                            {{ location.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <div>
                                    <label for="role"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Set a Manager (Optional)</label>
                                    <select
                                        v-model="editForm.manager_id"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    >
                                        <option v-for="user in users" :key="user.id">{{ user.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </template>

            <!-- Modal footer -->
            <template #footer>
                <div class="items-center p-2 border-t border-gray-200 rounded-b dark:border-gray-700">
                    <button
                        @click="updateSuData"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        type="submit">Update Supermarket
                    </button>
                </div>
            </template>

        </DialogModal>


        <!--  Delete Modal  -->

        <DialogModal :show="showDeleteModal" id="delete-user-modal">
            <!-- Modal content -->
            <template #title>
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-semibold dark:text-white">
                        Delete Supermarket
                    </h3>
                    <button type="button"
                            @click="closeDeleteModal"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                            data-modal-toggle="add-user-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </template>

            <!-- Modal body -->

            <template #content>

                <input type="hidden" v-model="deleteForm.id">
                <div class="p-6 pt-0 text-center">
                    <svg class="w-16 h-16 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Are you sure you want to delete this
                        Subject?</h3>
                    <button
                        @click="deleteSupermarketById(deleteForm.id)"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800">
                        Yes, I'm sure
                    </button>
                    <button
                        @click="closeDeleteModal"
                        class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                        data-modal-toggle="delete-user-modal">
                        No, cancel
                    </button>
                </div>
            </template>

            <!-- Modal footer -->
            <template #footer>

            </template>

        </DialogModal>


        <!-- Upload CSV modal  -->

        <DialogModal :show="showUploadSuppliersModal" id="uploadCSVfile">
            <!-- Modal content -->
            <template #title>
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-semibold dark:text-white">
                        Upload Suppliers CSV
                    </h3>
                    <button type="button"
                            @click="closeCSVModal"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                            data-modal-toggle="add-user-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </template>

            <!-- Modal body -->

            <template #content>

                <input type="hidden" v-model="uploadCSvForm.id">
                <div class="p-6 pt-0 text-center">

                    <div class="flex items-center justify-center w-full mt-8">
                        <label for="dropzone-file"
                               class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                     stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                    class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Excell file(MAX. 5mbs)</p>
                            </div>
                            <input ref="suppliersCSV" id="dropzone-file" type="file"
                                   @change="handleFileUpload"/>
                        </label>
                    </div>

                </div>
            </template>

            <!-- Modal footer -->
            <template #footer>
                <div class="items-center p-2 border-t border-gray-200 rounded-b dark:border-gray-700">
                    <button
                        @click="uploadSuppliers"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        type="submit">Upload Suppliers
                    </button>
                </div>

            </template>

        </DialogModal>


    </AuthenticatedLayout>


</template>
