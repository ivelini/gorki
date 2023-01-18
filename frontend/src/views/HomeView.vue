<template>
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
                    <button type="submit">Забронировать</button>
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
    }
}
</script>
