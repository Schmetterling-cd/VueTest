<template>
    <Navigation />
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Каталог</h2>
        </div>
    </header>

    <Head title="Каталог" />

    <div class="container mt-4">
        <div class="row">
            <div  className="col-3 align-self-center mb-5" v-for="equipment in equipments">
                <a :href="route('ProductCard', equipment.id )" className="card product" style="height: 500px; width: 18rem;">
                    <div className="row market-img photo" style="height: 400px; width: 100%;">
                        <img :src="'data:image/png;base64,' + (equipment.photo)" class="card-img-top">
                    </div>
                    <div className="card-body">
                        <h3 className="card-title fs-5 fw-bold">{{ equipment.name }}</h3>
                        <p className="card-text">Стоимость: {{ equipment.coast }} р/ч</p>
                        <a :href="route('application', equipment.id)"
                            className="btn btn-primary mt-2">Заказать</a>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <Footer />
</template>

<script>
import { mapActions, mapMutations, mapGetters } from 'vuex';
import { Head } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import Navigation from '@/Components/Navigation.vue';
import { ref } from 'vue';
import { addDays, subDays } from 'date-fns';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
export default {
    name: 'Market',
    components: { Head, Footer, Navigation, VueDatePicker },
    data() {
        return {
            equipments: [],
            date: ref(),
            disabledDates : [addDays(new Date(), 1), addDays(new Date(), 2), addDays(new Date(), 3)],
        }
    },
    beforeCreate() {
        axios.get('/fetchEquipments').then((response) => {
            this.equipments = response.data;
        });
    },
    methods: {
        writeConsole(line){
            console.log(line);
        }
    }
}
</script>