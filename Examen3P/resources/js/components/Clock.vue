<template>
    <div>
        <h1>World Clock</h1>
        <div v-for="city in cities" :key="city.name" class="city">
            <h2>{{ city.name }}</h2>
            <p>{{ city.time }}</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            cities: [],
        };
    },
    methods: {
        fetchTime() {
            axios.get('/time').then((response) => {
                this.cities = response.data;
            });
        },
    },
    mounted() {
        this.fetchTime();
        setInterval(this.fetchTime, 1000); // Actualizar cada segundo
    },
};
</script>

<style>
.city {
    margin-bottom: 20px;
}
</style>
