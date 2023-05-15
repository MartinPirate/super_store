import {defineStore} from 'pinia'
import {axiosInstance} from "@/Plugins/axiosInstance.js";
import {loading} from "@/Plugins/loading.js";

export const useSupermarketStore = defineStore('supermarkets', {
    state: () => ({
        supermarket: null,
        error: null,
        loading: false,
        supermarkets: [],
    }),
    getters: {
        filterSupermarkets: (state) => {
            return (name) =>
                state.supermarkets.filter((smkt) => smkt.name === name);
        },
    },
    actions: {
        async fetchSupermarkets() {
            this.loading = true
            try {
                 this.supermarkets = await axiosInstance
                    .get("/supermarkets")
                    .then((response) => response.data.data);


            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },


    }


})