const state = {
    properties: [],
    total: 0,
    lastPage: 0,
    currentPage: 0,
    links: "",
    page: 1,
    isListView: false,
};

const getters = {
    getProperties: (state) => state.properties,
    getPaginationLinks: (state) => state.links,
    getIsListView: (state) => state.isListView,
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
};

const actions = {
    GET_PROPERTIES: ({ commit }, payload) => {
        const { page } = payload;
        axios
            .get("/properties/fetch-properties", {
                params: {
                    page,
                },
            })
            .then(({ data }) => {
                commit("setProperties", data.data);
                console.log(data);
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
