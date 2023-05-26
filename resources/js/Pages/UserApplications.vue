<template>
    <Navigation />

    <Head title="Техника" />
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Список заказов</h2>
        </div>
    </header>
    <div class="container mb-3">
        <div class="card mt-3" v-for="application in applications">
            <div class="row g-0">
                <div class="col-md-4" style="height: 100%; width: 150px;">
                    <img :src="'data:image/png;base64,' + (application.equipment.photo)" class="card-img-top ph">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title fw-bold fs-4">Заказ на {{ application.equipment.name }}</h5>
                        <p class="card-text">{{ application.address.city + "," +
                            application.address.street + "," + application.address.house }}</p>
                        <p class="card-text">С {{ application.date_from }}, по {{ application.date_to }}</p>
                        <p class="card-text">Стоимость {{ application.coast }} руб.</p>
                        <p v-if="application.status_id === 0" class="card-text text-warning">Обрабатывется</p>
                        <p v-if="application.status_id === 1" class="card-text text-success">Одобрена</p>
                        <p v-if="application.status_id === 2" class="card-text text-danger">Отклонена</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>

<script>
import { mapActions, mapMutations, mapGetters } from 'vuex';
import Navigation from '@/Components/Navigation.vue';
import { useForm } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import axios from 'axios';
import { Head } from '@inertiajs/vue3';

export default {
    components: { Navigation, Footer, Head },
    data() {
        return {
            applications: {},
        }
    },
    beforeCreate() {
        axios.get('/fetchUserApplications', {
            params: {
                user_id: this.$page.props.auth.user.id,
            }
        }).then((response) => {
            this.applications = response.data;
        });
    },
    methods: {
        deleteEquipment(id) {

        }
    },
}


</script>