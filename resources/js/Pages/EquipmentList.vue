<template>
    <Navigation />
    <Head title="Техника" />
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Список техники</h2>
        </div>
    </header>
    <div class="container mt-4">
        <a :href="route('AddEquipment')" class="btn btn-secondary mb-3">Добавить технику</a>
        <div class="row">
            <div className="col-3 align-self-center mb-5" v-for="equipment in equipments">
            <div className="card product" style="height: 500px; width: 18rem;">
                <div className="market-img photo" style="height: 100%; width: 100%;">
                    <img :src="'data:image/png;base64,' + (equipment.photo)" class="card-img-top ph"
                        >
                </div>
                <div className="card-body">
                    <h3 className="card-title fs-5 fw-bold">{{ equipment.name }}</h3>
                    <p className="card-text">Стоимость: {{ equipment.coast }} р/ч</p>
                    <a :href="route('EquipmentCard', equipment.id)" className="btn btn-warning ml-2 mt-2">Редактировать</a>
                    <button @click="deleteEquipment(equipment.id)" className="btn btn-danger ml-2 mt-2">Удалить</button>
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
            equipments: [],
        }
    },
    beforeCreate() {
        axios.get('/fetchEquipments').then((response) => {
            this.equipments = response.data;
        });
    },
    methods: {
        deleteEquipment(id){
            axios.post('/deleteEquipment', {
                id: id,
            }).then((response) =>{
                console.log(response.data);
                this.equipments = response.data;
            })
        }
    },
}


</script>