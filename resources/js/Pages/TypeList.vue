<template>
    <Navigation />
    <Head title="Главная" />
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Список типов</h2>
        </div>
    </header>
    <div class="container mt-4">
        <button @click="newRow = true" class="btn btn-secondary mb-3">Добавить тип</button>
        <table class="table text-center table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ИН</th>
                    <th scope="col">Название</th>
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="type in types">
                    <th class="col-4" scope="row">{{type.id}}</th>
                    <td class="col-4">{{ type.name }}</td>
                    <td class="col-4"><div class="row"><a :href="route('TypeCard', type.id)" class="col-6" style="color: green;">Изменить</a><p @click="deleteType(type)" class="col-6" style="color: red;">Удалить</p></div></td>
                </tr>
                <tr v-if="newRow">
                    <th class="col-4" scope="row">б/н</th>
                    <td class="col-4"><input v-model="newType" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"/></td>
                    <td class="col-4"><div class="row"><p @click="saveType()" class="col-6" style="color: green;">Сохранить</p><p @click="newRow = false" class="col-6" style="color: red;">Убрать</p></div></td>
                </tr>
            </tbody>
        </table>
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
            types: [],
            newRow: false,
            newType: '',
        }
    },
    beforeCreate() {
        axios.get('/fetchTypes').then((response) => {
            this.types = response.data;
        });
    },
    methods: {
        changeType(type){
            $this.route('TypeCard', type.id);
        },
        deleteType(type){
            axios.delete('/deleteType',{params:{id: type.id}})
                .then((response)=>{axios.get('/fetchTypes').then((response) => {
            this.types = response.data;
        });});
        },
        saveType(){
            axios.post('/createType',{name: this.newType})
                .then((response)=>{axios.get('/fetchTypes').then((response) => {
            this.types = response.data;
            this.newRow = false;
            this.newType = '';
        });});
        },
    },
}


</script>