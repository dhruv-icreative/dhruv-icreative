export default {
    namespaced: true,

    state() {
        return {
            loading: false,
            apiContext: {},
            club: {}
        };
    },

    getters: {
        isLoading(state) {
            return state.loading;
        }
    },

    mutations: {
        setLoading(state, value) {
            state.loading = value;
        },

        setApiContext(state, apiContext) {
            state.apiContext = apiContext;
        },

        setClub(state, newClub) {
            state.club = newClub;
        }
    }
}
