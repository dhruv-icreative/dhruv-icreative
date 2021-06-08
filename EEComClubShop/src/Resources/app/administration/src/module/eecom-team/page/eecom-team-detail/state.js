export default {
    namespaced: true,

    state() {
        return {
            loading: false,
            apiContext: {},
            team: {}
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

        setTeam(state, newTeam) {
            state.team = newTeam;
        }
    }
}
