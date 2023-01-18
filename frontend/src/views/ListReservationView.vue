<template>
    <header-content>
        <h2>Список /</h2>
        <p>Мои даты бронирования</p>
    </header-content>
    <div class="call-to-action container">
        <div class="row">
            <div class="call-to-action-text span12">
                <div class="ca-text">
                    <p>
                        <span style="color: orange; font-weight: bold">ID: 1</span>;
                        <span style="color: green; font-weight: bold">Дата создания: 17.01.2023 20:34</span>;
                        <span style="color: black; font-weight: bold">Дата брони: 20.01.2023</span>;
                        <span style="color: red; font-weight: bold">Не подтверждена</span>
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
    }
}
</script>

