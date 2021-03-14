import { errorHandler } from "../../utils";

const state = {};

const getters = {};

const mutations = {};

const actions = {
    UPDATE_PROFILE: ({}, payload) => {
        return new Promise((resolve, reject) => {
            const { name, email, phone_number } = payload;

            axios
                .put("/update-profile", {
                    name,
                    email,
                    phone_number,
                })
                .then(({ data }) => {
                    resolve(data.data);
                })
                .catch((error) => reject(errorHandler(error)));
        });
    },
    CHANGE_PASSWORD: ({}, payload) => {
        return new Promise((resolve, reject) => {
            const {
                current_password,
                password,
                password_confirmation,
            } = payload;

            axios
                .put("/change-password", {
                    current_password,
                    password,
                    password_confirmation,
                })
                .then(({ data }) => {
                    console.log(data);
                    resolve(data.data);
                })
                .catch((error) => reject(errorHandler(error)));
        });
    },
};

export default {
    state,
    getters,
    mutations,
    actions,
};
