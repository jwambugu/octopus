const state = {
    properties: [],
    total: 0,
    lastPage: 0,
    currentPage: 0,
    links: "",
    page: 1,
};

const getters = {
    getProperties: (state) => state.properties,
    getPaginationLinks: (state) => state.links,
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
};

export default {
    state,
    getters,
    mutations,
    actions,
};
