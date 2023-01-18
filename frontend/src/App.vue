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
                                <li>
                                    <router-link :to="{ name: 'home' }">Забронировать</router-link>
                                </li>
                                <li v-show="user.name">
                                    <router-link :to="{ name: 'list' }">Список</router-link>
                                </li>
                                <li v-if="!user.name">
                                    <a href="/register">Регистрация</a>
                                </li>
                                <li v-else>
                                    <a @click="deleteToken">{{ user.name }} - Выход</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <router-view/>

    <footer>
        <div class="container">
            <div class="row">
                <div class="copyright span4">
                    <p>Тестовое - RESTFull серис бронирования</p>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    data() {
        return {
            api: {
              domain: 'http://127.0.0.1:8000'
            },
            user: {
                name: ''
            }
        }
    },
    mounted() {
        if (this.getToken() != null) {
            this.getUser()
        }
    },
    methods: {
        async getUser() {
            let response = await fetch(`${ this.api.domain }/api/user`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${ this.getToken() }`
                }
            })

            let user = await response.json();

            this.user.name = user.name
        },
        getToken() {
            return localStorage.getItem('token')
        },
        deleteToken() {
            localStorage.removeItem('token')
            window.location.href = this.api.domain
        }
    }
}
</script>
