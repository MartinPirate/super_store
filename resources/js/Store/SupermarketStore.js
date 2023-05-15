import {defineStore} from 'pinia'
import {axiosInstance} from "@/Plugins/axiosInstance.js";
import {loading} from "@/Plugins/loading.js";
import Swal from "sweetalert2";

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

        async fetchSupermarketById(id) {
            this.loading = true
            try {
                this.supermarket = await axiosInstance
                    .get(`/supermarkets/${id}`)
                    .then((response) => response.data.data);

                console.log(this.supermarket)
            } catch (error) {
                // @ts-ignore
                this.error = error;
            } finally {
                this.loading = false;
            }
        },

        async createSupermarket(supermarket) {
            try {
                this.loading = true
                await fetch(`/api/v1/supermarkets`, {
                    method: "POST",
                    body: JSON.stringify(supermarket),
                    headers: {
                        "Content-Type": "application/json",
                    }
                }).then((response) => {
                    if (response.ok) {
                        return response.json().then((data) => {
                            Swal.fire("Success", "Supermarket Added Successfully", "success");
                            this.supermarkets.unshift(data.data);
                        });
                    } else {
                        return response.json().then((data) => {
                            Swal.fire("Error", data.message, "error");
                        });
                    }


                })
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },


    }


})
