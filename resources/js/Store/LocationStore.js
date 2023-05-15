import {defineStore} from "pinia";
import {axiosInstance} from "@/Plugins/axiosInstance.js";

export const useLocationStore = defineStore('locations', {
    state: () => ({
        location: null,
        error: null,
        loading: false,
        locations: [],
    }),
    getters : {

    },
    actions : {
        async fetchLocations() {
            this.loading = true
            try {
                this.locations = await axiosInstance
                    .get("/locations")
                    .then((response) => response.data.data);


            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },

    },
})
