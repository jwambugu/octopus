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
};

const getters = {
    getProperties: (state) => state.properties,
    getPaginationLinks: (state) => state.links,
    getIsListView: (state) => state.isListView,
    getLoadingProperties: (state) => state.loadingProperties,
};

const mutations = {
    setProperties: (state, data) => {
        state.properties = data.properties;
        state.total = data.total;
        state.lastPage = data.lastPage;
        state.currentPage = data.currentPage;
        state.links = data.links;
        state.page = data.page;
    },
    setIsListView: (state, isListView) => (state.isListView = isListView),
    setLoadingProperties: (state, loadingProperties) =>
        (state.loadingProperties = loadingProperties),
};

const actions = {
    GET_PROPERTIES: ({ commit }, payload) => {
        commit("setLoadingProperties", true);

        return new Promise((resolve, reject) => {
            const { page, propertyTypes, bedrooms, city, sortBy } = payload;

            axios
                .get("/properties/fetch-properties", {
                    params: {
                        page,
                        propertyTypes,
                        bedrooms,
                        city,
                        sortBy,
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
};

export default {
    state,
    getters,
    mutations,
    actions,
};
