import { createStore } from 'vuex'

export default createStore({
  state: {
      user: {
          isAdmin: false
      },
      api: {
          domain: 'http://127.0.0.1:8000',
          token: null,
      },
  },
  getters: {
      getUser(state) {
          return state.user
      },
      getApiDomain(state) {
          return state.api.domain
      },
      getApiToken(state) {
          return state.api.token
      }
  },
  mutations: {
      registeredUser(state, user) {
          user.role == 'Administrator' ?
              state.user.isAdmin = true :
              state.user.isAdmin = false
          state.user.name = user.name
          state.user.id = user.id
      },
      updateToken(state, payload) {
          state.api.token = payload.token
      }
  },
  actions: {
  },
  modules: {
  }
})
