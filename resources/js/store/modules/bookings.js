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
            const { phoneNumber, paymentID } = payload;

            axios
                .post("/bookings/lipa-na-mpesa", {
                    phone_number: phoneNumber,
                    payment_id: paymentID,
                })
                .then(({ data }) => {
                    resolve(data.data);
                })
                .catch((error) => reject(errorHandler(error)));
        });
    },
    CONFIRM_MPESA_PAYMENT: ({}, payload) => {
        return new Promise((resolve, reject) => {
            const { uuid } = payload;

            axios
                .post(`/bookings/${uuid}/confirm-mpesa-payment`)
                .then(({ data }) => {
                    resolve(data.data);
                })
                .catch((error) => reject(errorHandler(error)));
        });
    },
    CANCEL_BOOKING: ({}, payload) => {
        return new Promise((resolve, reject) => {
            const { uuid } = payload;

            axios
                .post(`/bookings/cancel-booking`, {
                    uuid,
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
