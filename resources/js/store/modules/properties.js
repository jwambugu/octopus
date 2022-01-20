import { errorHandler } from "../../utils";

const state = {
    properties: [],
    total: 0,
    lastPage: 0,
    currentPage: 0,
    links: "",
    page: 1,
    isListView: false,
    loadingProperties: false,
    vacationTypes: [],
    loadingVacationTypes: true,
    popularVacations: [],
    loadingPopularVacations: true,
    vacationAddresses: [],
};

const getters = {
    getProperties: (state) => state.properties,
    getPaginationLinks: (state) => state.links,
    getIsListView: (state) => state.isListView,
    getLoadingProperties: (state) => state.loadingProperties,
    getVacationTypes: (state) => state.vacationTypes,
    getLoadingVacationTypes: (state) => state.loadingVacationTypes,
    getPopularVacations: (state) => state.popularVacations,
    getLoadingPopularVacations: (state) => state.loadingPopularVacations,
    getVacationAddresses: (state) => state.vacationAddresses,
};

const mutations = {
    setProperties: (state, data) => {
        state.properties = data.properties;
        state.total = data.total;
        // state.lastPage = data.lastPage;
        // state.currentPage = data.currentPage;
        state.links = data.links;
        state.page = data.page;
    },
    setIsListView: (state, isListView) => (state.isListView = isListView),
    setLoadingProperties: (state, loadingProperties) =>
        (state.loadingProperties = loadingProperties),
    setVacationTypes: (state, types) => (state.vacationTypes = types),
    setLoadingVacationTypes: (state, loading) =>
        (state.loadingVacationTypes = state.loadingVacationTypes = loading),
    setPopularVacations: (state, vacations) =>
        (state.popularVacations = vacations),
    setLoadingPopularVacations: (state, loading) =>
        (state.loadingPopularVacations = loading),
    setVacationAddresses: (state, loading) =>
        (state.vacationAddresses = loading),
};

const actions = {
    GET_PROPERTIES: ({ commit }, payload) => {
        commit("setLoadingProperties", true);

        return new Promise((resolve, reject) => {
            const {
                page,
                property_types,
                bedrooms,
                city,
                sortBy,
                address,
                type,
            } = payload;

            const url =
                type === "vacation"
                    ? "/vacations/get-vacations"
                    : "/api/properties";

            axios
                .get(url, {
                    params: {
                        page,
                        property_types,
                        bedrooms,
                        city,
                        sortBy,
                        address,
                    },
                })
                .then(({ data }) => {
                    commit("setProperties", data.data);
                    commit("setLoadingProperties", false);

                    resolve();
                })
                .catch((err) => reject(errorHandler(err)));
        });
    },
    SET_IS_LIST_VIEW: ({ commit }, payload) => {
        const { isListView } = payload;

        commit("setIsListView", isListView);
    },
    RATE_PROPERTY: ({}, payload) => {
        return new Promise((resolve, reject) => {
            const { ratings, uuid } = payload;

            axios
                .post(`/vacations/rate-property`, {
                    ratings,
                    uuid,
                })
                .then(({ data }) => {
                    resolve(data.data);
                })
                .catch((error) => reject(error));
        });
    },
    GET_AVAILABLE_VACATION_TYPES: ({ commit }) => {
        return new Promise((resolve, reject) => {
            axios
                .get(`/vacations/available-types`)
                .then(({ data }) => {
                    const { vacationTypes } = data.data;

                    commit("setVacationTypes", vacationTypes);
                    commit("setLoadingVacationTypes", false);

                    resolve();
                })
                .catch((error) => reject(error));
        });
    },
    GET_POPULAR_VACATIONS: ({ commit }) => {
        return new Promise((resolve, reject) => {
            axios
                .get(`/vacations/popular`)
                .then(({ data }) => {
                    const { properties } = data.data;

                    commit("setPopularVacations", properties);
                    commit("setLoadingPopularVacations", false);

                    resolve();
                })
                .catch((error) => reject(error));
        });
    },
};

export default {
    state,
    getters,
    mutations,
    actions,
};
