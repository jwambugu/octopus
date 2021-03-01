import Vue from "vue";
import Vuex from "vuex";

// Modules
import properties from "./modules/properties";
import bookings from "./modules/bookings";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        properties,
        bookings,
    },
});
