<template>
    <div class="call-to-action container">
        <div class="row">
            <div class="call-to-action-text span12">
                <div class="ca-text">
                    <p>
                        <span style="color: orange; font-weight: bold">ID: {{ room.id }}</span>;
                        <span style="color: green; font-weight: bold">Дата создания: {{ room.created_at }}</span>;
                        <span style="color: black; font-weight: bold">Дата брони: {{ room.reserverd_at }}</span>;
                        <span v-show="room.user_name" style="color: green; font-weight: bold">Пользователь: {{ room.user_name }};</span>
                        <span style="color: gray; font-weight: bold">{{ room.is_appruved }}</span>;
                        <a @click="showEdit" style="cursor: pointer; color: #0e90d2; font-weight: bold">Редактировать; </a>
                        <a @click="deleteReservRoom(room.id)" style="cursor: pointer; color: red; font-weight: bold">Удалить</a>
                    </p>
                    <p id="editBlock" :style="editBlockStyle">
                        <input type="date" :value="editRooms.date" @input="editRooms.date = $event.target.value">
                        <input v-if="this.$store.getters.getUser.isAdmin"
                               type="text"
                               placeholder="ID пользователя"
                                :value="editRooms.userId">
                        <input type="checkbox" :checked="editRooms.isAppruved" v-model="editRooms.isAppruved">

                        <button type="submit" @click.prevent="this.$emit('setEdit', this.editRooms)">Сохранить</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['room'],
    emits: ['setEdit'],
    data() {
        return {
            editRooms: {
                date: null,
                userId: null,
                isAppruved: false
            },
            editBlockStyle: {
                display: 'none'
            }
        }
    },
    methods: {
        showEdit() {
            this.editBlockStyle.display = 'block'
            this.editRooms.date = this.room.reserverd_at
            this.editRooms.userId = this.room.user_id
            this.editRooms.id = this.room.id
        }
    }
}
</script>

