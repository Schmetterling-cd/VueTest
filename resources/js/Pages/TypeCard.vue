<template>
    <Navigation />
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Добавление типа</h2>
        </div>
    </header>
    <div class="container mt-3">
        <div class="row p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-3">
            <div class="col-6">
                <div class="row">
                    <InputLabel for="id" value="Идентификационный номер" class="col-5 fs-6 fw-bold" />
                    <p id="id" class="col-1">{{ type.id }}</p>
                </div>
                <div class="row align-items-center mt-3">
                    <InputLabel for="name" value="Название типа" class="col-5 fs-6 fw-bold" />

                    <TextInput id="name" type="text" v-model="type.name" class="col-4 mt-1 block" required autofocus
                        autocomplete="username" />

                    <InputError class="mt-2" />
                </div>

                <button @click="updateType()" class="btn btn-success mt-3">Сохранить</button>
            </div>
            <div class="col-6">
                <table class="table text-center table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col-4">Название</th>
                            <th scope="col-4">Тип</th>
                            <th scope="col-4">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="specialization in type.specializations">
                            <th class="col-4" scope="row">{{ specialization.name }}</th>
                            <td class="col-4">
                                <div v-if="specialization.type === 'S'">Строка</div>
                                <div v-if="specialization.type === 'N'">Число</div>
                                <div v-if="specialization.type === 'D'">Дата</div>
                            </td>
                            <td class="col-4">
                                <div class="row"><a :href="route('TypeCard', type.id)" class="col-6"
                                        style="color: green;">Изменить</a>
                                    <p @click="deleteSpec(specialization)" class="col-6" style="color: red;">Удалить</p>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="newRow">
                            <td class="col-4">
                                <TextInput id="name" type="text" v-model="newSpecialization.name" class="col-4 mt-1 block w-full" required autofocus
                        autocomplete="username" />
                            </td>
                            <td class="col-4">
                                <select v-model="newSpecialization.type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    <option value="S">Строка</option>
                                    <option value="N">Число</option>
                                    <option value="D">Дата</option>
                                </select>
                            </td>
                            <td class="col-4">
                                <div class="row">
                                    <p @click="addSpec()" class="col-6" style="color: green;">Сохранить</p>
                                    <p @click="newRow = false" class="col-6" style="color: red;">Убрать</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button @click="newRow = true" class="btn btn-secondary mt-3">Добавить характеристику</button>
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
export default {
    components: { Navigation, Footer, InputLabel, TextInput, InputError },
    data() {
        return {
            type: this.$page.props.type,
            newRow: false,
            newSpecialization: {
                name: '',
                type: '',
            },
        }
    },
    methods:{
        addSpec(){
            axios.post('/addTypeSpec',{
                equipment_type_id: this.type.id,
                name: this.newSpecialization.name,
                type: this.newSpecialization.type,
            }).then((response)=>{
                this.type.specializations = response.data;
                this.newSpecialization= {name: '', type: ''};
                this.newRow = false;
            })
        },
        deleteSpec(specialization){
            axios.post('/deleteTypeSpec',{
                id: specialization.id,
                equipment_type_id: this.type.id,
            }).then((response)=>{
                this.type.specializations = response.data;
            })
        },
        updateType(){
            axios.post('/updateType',{
                id: this.type.id,
                name: this.type.name,
            })
        }
    }
}
</script>