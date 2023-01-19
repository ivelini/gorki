<template>
    <div>
    <header-content>
        <h2>Забронировать /</h2>
        <p>Выбрать дату бронирования</p>
    </header-content>
    <div class="contact-us container">
        <div class="row">
            <div class="contact-form span7">
                <div>
                    <label for="name" class="nameLabel">Дата</label>
                    <input id="date" type="date">
                    <input v-if="this.$store.getters.getUser.isAdmin"
                           id="userId"
                           type="text"
                           placeholder="ID пользователя">

                    <button type="submit" @click.prevent="sendReserv">Забронировать</button>
                </div>
            </div>
        </div>
    </div>

        <filter-component
            @set-filter="addFilter($event)"/>

        <reserved-room-component
            v-for="room in reservedRooms" :key="room.id"
            :room="room"
            @set-edit="onSetEdit($event)"
            @set-delete="deleteReservRoom($event)"/>

    </div>
</template>
<script>
import HeaderContent from "@/components/HeaderContent";
import ReservedRoomComponent from "@/components/ReservedRoomComponent";
import FilterComponent from "@/components/FilterComponent";

export default {
    components: {
        HeaderContent,
        ReservedRoomComponent,
        FilterComponent
    },
    data() {
        return {
            reservedRooms: [],
        }
    },
    mounted() {
        if (this.$store.getters.getApiToken != null) {
            this.getListReservedRooms()
        }
    },
    methods: {
        async sendReserv() {
            let date = document.querySelector('#date');
            let userId =document.querySelector('#userId');

            if (date.value.length === 0) {
                date.focus()
            } else {
                let oData = new FormData()

                oData.append('date', date.value)

                if (userId != null && userId.value.length >= 0) {
                    oData.append('userId', userId.value)
                } else {
                    oData.append('userId', this.$store.getters.getUser.id)
                }

                let response = await fetch(`${ this.$store.getters.getApiDomain }/api/rooms`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${ this.$store.getters.getApiToken }`
                    },
                    body: oData
                })

                let result = await response.json();

                if (result.status == 'OK') {
                    date.value = null
                    if (userId != null) userId.value = null
                    await this.getListReservedRooms()
                }
            }
        },
        async getListReservedRooms(filter = null) {
            let url = `${ this.$store.getters.getApiDomain }/api/rooms`
            if (filter != null) url += filter

            let response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${ this.$store.getters.getApiToken }`
                },
            })

            this.reservedRooms = await response.json();
        },
        async deleteReservRoom(id) {
            let response = await fetch(`${ this.$store.getters.getApiDomain }/api/rooms/${ id }`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${ this.$store.getters.getApiToken }`
                },
            })
            let result = await response.json()

            if (result.status == 'OK') await this.getListReservedRooms()
        },
        async onSetEdit(event) {
            let response = await fetch(`${ this.$store.getters.getApiDomain }/api/rooms/${ event.id }`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${ this.$store.getters.getApiToken }`
                },
                body: JSON.stringify(event)
            })

            let result = await response.json()
            console.log(event)


            if (result.status == 'OK') await this.getListReservedRooms()

        },
        addFilter(urlFilter) {
            this.$router.replace({name: 'home', query: urlFilter });
            let query = ''
            for(let key in urlFilter) {
                query += `&${ key }=${ urlFilter[key] }`
            }
            query = query.replace('&', '?')
            this.getListReservedRooms(query)
        }
    }

}
</script>
