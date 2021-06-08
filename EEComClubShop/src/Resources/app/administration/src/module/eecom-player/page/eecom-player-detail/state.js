export default {
    namespaced: true,

    state() {
        return {
            loading: false,
            apiContext: {},
            player: {}
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

        setPlayer(state, newPlayer) {
            state.player = newPlayer;
        }
    }
}
