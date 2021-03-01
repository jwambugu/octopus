import { errorHandler } from "../../utils";

const state = {};

const getters = {};

const mutations = {};

const actions = {
    BOOK_PROPERTY: ({}, payload) => {
        return new Promise((resolve, reject) => {
            const { checkin_date, checkout_date, property_id } = payload;

            axios
                .post("/bookings/book-property", {
                    checkin_date,
                    checkout_date,
                    property_id,
                })
                .then(({ data }) => {
                    resolve(data.data);
                })
                .catch((error) => reject(errorHandler(error)));
        });
    },
    MAKE_MPESA_PAYMENT: ({}, payload) => {
        return new Promise((resolve, reject) => {
            const { phoneNumber, payment_id } = payload;

            axios
                .post("/bookings/lipa-na-mpesa", {
                    phone_number: phoneNumber,
                    paymentID: payment_id,
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
