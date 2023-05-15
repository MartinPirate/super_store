import {defineStore} from "pinia";
import {axiosInstance} from "@/Plugins/axiosInstance.js";

export const useUsersStore = defineStore('users', {
    state: () => ({
        user: null,
        error: null,
        loading: false,
        users: [],
    }),
    getters: {},
    actions: {
        async fetchUsers() {
            this.loading = true
            try {
                this.users = await axiosInstance
                    .get("/users")
                    .then((response) => response.data.data);


            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },

    },
})
