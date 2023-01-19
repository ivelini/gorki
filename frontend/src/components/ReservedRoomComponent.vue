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
                        <span style="color: gray; font-weight: bold">{{ room.appruvedStatus }}</span>;
                        <a @click="showEdit" style="cursor: pointer; color: #0e90d2; font-weight: bold">Редактировать; </a>
                        <a @click="this.$emit('setDelete', room.id)" style="cursor: pointer; color: red; font-weight: bold">Удалить</a>
                    </p>
                    <p id="editBlock" :style="editBlockStyle">
                        <input type="date" :value="editRooms.date" @input="editRooms.date = $event.target.value">
                        <template v-if="this.$store.getters.getUser.isAdmin">
                            <input type="text"
                                   placeholder="ID пользователя"
                                    :value="editRooms.userId"
                                    @input="editRooms.userId = $event.target.value">
                            <input type="checkbox"
                                   v-model="editRooms.isAppruved"
                                   :checked="editRooms.isAppruved" >
                        </template>

                        <button type="submit" @click.prevent="save">Сохранить</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['room'],
    emits: ['setEdit', 'setDelete'],
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
            console.log(this.room)
            this.editBlockStyle.display = 'block'
            this.editRooms.date = this.room.reserverd_at
            this.editRooms.userId = this.room.user_id
            this.editRooms.id = this.room.id
            this.editRooms.isAppruved = this.room.is_appruved
        },
        save() {
            this.$emit('setEdit', this.editRooms)
            this.editBlockStyle.display = 'none'
        }
    }
}
</script>

