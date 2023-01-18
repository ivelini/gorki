<template>
    <header-content>
        <h2>Список /</h2>
        <p>Мои даты бронирования</p>
    </header-content>
    <div v-for="room in reservedRooms" class="call-to-action container" :key="room.id">
        <div class="row">
            <div class="call-to-action-text span12">
                <div class="ca-text">
                    <p>
                        <span style="color: orange; font-weight: bold">ID: {{ room.id }}</span>;
                        <span style="color: green; font-weight: bold">Дата создания: {{ room.created_at }}</span>;
                        <span style="color: black; font-weight: bold">Дата брони: {{ room.reserverd_at }}</span>;
                        <span v-show="room.user_name" style="color: green; font-weight: bold">Пользователь: {{ room.user_name }};</span>
                        <span style="color: gray; font-weight: bold">{{ room.is_appruved }}</span>;
                        <a @click="deleteReservRoom(room.id)" style="cursor: pointer; color: red; font-weight: bold">Удалить</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HeaderContent from "@/components/HeaderContent";

export default {
    components: {
        HeaderContent
    },
    data() {
        return {
            api: {
                domain: 'http://127.0.0.1:8000'
            },
            reservedRooms: []
        }
    },
    mounted() {
        if (this.getToken() != null) {
            this.getListReservedRooms()
        }
    },
    methods: {
        getToken() {
            return localStorage.getItem('token')
        },
        async getListReservedRooms() {
            let response = await fetch(`${ this.api.domain }/api/rooms`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${ this.getToken() }`
                },
            })

            this.reservedRooms = await response.json();
        },
        async deleteReservRoom(id) {
            let response = await fetch(`${ this.api.domain }/api/rooms/${ id }`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${ this.getToken() }`
                },
            })
            let result = await response.json()

            if (result.status == 'OK') await this.getListReservedRooms()
        }
    }
}
</script>

