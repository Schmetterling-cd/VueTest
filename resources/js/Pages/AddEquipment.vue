<template>
    <Navigation />
    <Head title="Добавление техники" />
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Добавление техники</h2>
        </div>
    </header>

    <div class="container mt-3">
        <div class="row p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-3">
            <div class="col-6">
                <div class="row">
                    <InputLabel for="id" value="Идентификационный номер" class="col-5 fs-6 fw-bold" />
                    <p id="id" class="col-1">б/н</p>
                </div>
                <div class="row align-items-center">
                    <InputLabel for="type" value="Тип техники" class="col-5 fs-6 fw-bold" />
                    <select id="type" @change="changeType()" v-model="newEquipment.equipment_type_id"
                        class="col-7 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block">
                        <option v-for="type in types" :value="type.id">{{ type.name }}</option>
                    </select>
                </div>
                <div class="row align-items-center mt-3">
                    <InputLabel for="name" value="Название техники" class="col-5 fs-6 fw-bold" />

                    <TextInput id="name" type="text" v-model="newEquipment.name" class="col-7 mt-1 block" required autofocus
                        autocomplete="username" />

                    <InputError class="mt-2" />
                </div>
                <div class="row align-items-center mt-3">
                    <InputLabel for="coast" value="Цена BYN/ч" class="col-5 fs-6 fw-bold" />

                    <TextInput id="coast" type="text" v-model="newEquipment.coast" class="col-7 mt-1 block" required
                        autofocus autocomplete="username" />

                    <InputError class="mt-2" />
                </div>
                <div class="row align-items-center mt-3">
                    <InputLabel for="photo" value="Фото" class="col-5 fs-6 fw-bold" />

                    <input id="photo" ref="file" type="file" @change="addPhoto()"
                        class="col-7 mt-1 block border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                </div>
                <button @click="saveEquipment()" class="btn btn-success mt-5">Сохранить</button>
            </div>
            <div class="col-6">
                <table class="table text-center table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Название</th>
                            <th scope="col">Значение</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="specialization in newEquipment.specializations">
                            <td class="col-4">{{ specialization.name }}</td>
                            <td class="col-4">
                                <TextInput id="coast" type="text" v-model="specialization.value" class="mt-1 block w-full"
                                    required autofocus autocomplete="username" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <Footer />
</template>

<script>
import Navigation from '@/Components/Navigation.vue';
import Footer from '@/Components/Footer.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import axios from 'axios';
import { Head } from '@inertiajs/vue3';

export default {
    components: { Navigation, Footer, InputLabel, TextInput, InputError, Head },
    data() {
        return {
            newEquipment: {
                user_id : this.$page.props.auth.user.id,
                name: '',
                coast: '',
                photo: null,
                equipment_type_id: null,
                specializations: [],
            },
            types: [],
            formData: new FormData(),
        }
    },
    beforeCreate() {
        axios.get('/fetchTypes').then((response) => {
            this.types = response.data;
        });
    },
    methods: {
        changeType() {
            console.log(this.newEquipment.equipment_type_id);
            axios.get('/fetchSpecializations', {
                params: {
                    id: this.newEquipment.equipment_type_id,
                }
            }).then((response) => {
                this.newEquipment.specializations = response.data;
                console.log(this.newEquipment.specializations);
            });
        },
        addPhoto() {
            this.formData.append('file', this.$refs.file.files[0]);
        },
        saveEquipment() {
            this.formData.append('equipment', JSON.stringify(this.newEquipment) );
            axios.post('/createEquipment',
                this.formData,{
                headers: {
                    'Content-Type': 'multipart/form-data; charset=utf-8',
                }
            }).then((response) => {
                route('EquipmentCard', response.data)
            });
        }
    }
}
</script>