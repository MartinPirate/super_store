import { App } from "vue";
import Swal from "sweetalert2";

export default {
    install: (app) => {
        app.config.globalProperties.$swal = Swal;
    },
};
