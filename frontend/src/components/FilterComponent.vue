<template>
    <div class="call-to-action container">
        <div class="row">
            <div class="call-to-action-text span12">
                <div class="ca-button">
                    <a @click="reset" style="cursor: pointer">Сброс</a>
                </div>
                <div class="ca-button">
                    <a @click="filter.is_appruved = 0" style="cursor: pointer">Не подтверждена</a>
                </div>
                <div class="ca-button">
                    <a @click="filter.is_appruved = 1" style="cursor: pointer">Подтверждена</a>
                </div>
                <div class="ca-button">
                    <input type="text" v-model="filter.limit"
                           placeholder="Количество">
                </div>
                <div class="ca-button">
                    <input type="text" v-model="filter.user_id"
                           placeholder="ID пользователя">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    emits: ['setFilter'],
    data() {
        return {
            filter: {
                user_id: null,
                limit: null,
                is_appruved: null,
            },
            urlFilter: {}
        }
    },
    watch: {
        filter: {
            handler(val) {
                for (let key in val) {
                    if (val[key] != null && val[key] != '') {
                        this.urlFilter[key] = val[key]
                    } else {
                        delete this.urlFilter[key]
                    }
                }
                this.$emit('setFilter', this.urlFilter)
            },
            deep: true
        },
    },
    methods: {
        reset() {
            for (let key in this.filter) {
                this.filter[key] = null
            }
            for (let key in this.urlFilter) {
                delete this.urlFilter[key]
            }
        }
    }
}
</script>
