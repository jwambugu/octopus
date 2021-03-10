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
};

export default {
    state,
    getters,
    mutations,
    actions,
};
