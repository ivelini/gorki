import { createStore } from 'vuex'

export default createStore({
  state: {
      user: {
          isAdmin: false
      },
      api: {
          domain: 'http://127.0.0.1:8000'
      },
  },
  getters: {
      getUser(state) {
          return state.user
      },
      getApiDomain(state) {
          return state.api.domain
      }
  },
  mutations: {
      registeredUser(state, user) {
          user.role == 'Administrator' ?
              state.user.isAdmin = true :
              state.user.isAdmin = false
          state.user.name = user.name
      }
  },
  actions: {
  },
  modules: {
  }
})
