<template>
    <div class="container">
        <div class="header row">
            <div class="span12">
                <div class="navbar">
                    <div class="navbar-inner">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <div class="nav-collapse collapse">
                            <ul class="nav pull-right">
                                <li v-show="this.$store.getters.getApiToken">
                                    <router-link :to="{ name: 'home' }">Забронировать</router-link>
                                </li>
                                <li v-if="!this.$store.getters.getUser.name">
                                    <a href="/register">Регистрация</a>
                                </li>
                                <li v-else>
                                    <a @click="deleteToken" style="cursor: pointer">{{ this.$store.getters.getUser.name }} - Выход</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <router-view v-show="this.$store.getters.getApiToken"/>

    <div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="copyright span4">
                    <p>Тестовое - RESTFull серис бронирования</p>
                </div>
            </div>
        </div>
    </footer>
    </div>
</template>

<script>
import { mapMutations } from 'vuex'

export default {
    mounted() {
        this.getToken()
        if (this.$store.getters.getApiToken != null) this.getUser()
    },
    methods: {
        ...mapMutations(['registeredUser', 'updateToken']),
        async getUser() {
            let response = await fetch(`${ this.$store.getters.getApiDomain }/api/user`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${ this.$store.getters.getApiToken }`
                }
            })

            let user = await response.json();
            this.$store.commit('registeredUser', user)
        },
        getToken() {
            let token =  localStorage.getItem('token')
            if (token != null) this.$store.commit('updateToken', { token: token })
        },
        deleteToken() {
            localStorage.removeItem('token')
            this.$store.commit('updateToken', { token: null })
            window.location.href = this.$store.getters.getApiDomain
        }
    }
}
</script>
