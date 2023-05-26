<template>
    <Navigation />

    <Head title="Оформление заявки на технику" />
    <header class="bg-white shadow">
        <div class="container pt-5 pb-5">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-3">
                <div class="row space-y-4">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary fs-4">Заказ</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div className="row market-img photo" style="height: 100%; width: 150px;">
                                    <img :src="'data:image/png;base64,' + ($page.props.equipment.photo)"
                                        class="card-img-top">
                                </div>
                                <div>
                                    <h6 class="my-0">{{ $page.props.equipment.name }}</h6>
                                    <small class="text-muted">Кол-во суток {{ days }}</small>
                                </div>

                                <span class="text-muted">{{ $page.props.equipment.coast }} руб/сутки</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>К оплате</span>
                                <strong>{{ $page.props.equipment.coast * days }} руб.</strong>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Информация о заказе</h4>
                        <form class="needs-validation" @submit.prevent="saveApplication()">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <InputLabel for="name" class="form-label ">Имя</InputLabel>

                                    <TextInput id="name" v-model="application.name" type="text" class="form-control col-5 fs-6" required
                                        autofocus autocomplete="username"></TextInput>
                                    <InputError class="mt-2" :message="application.errors.name"/>
                                </div>

                                <div class="col-sm-6">
                                    <InputLabel for="secondname" class="form-label ">Фамилия</InputLabel>

                                    <TextInput id="secondname" v-model="application.secondname" type="text" class="form-control col-5 fs-6" required
                                        autofocus autocomplete="username"></TextInput>
                                    <InputError class="mt-2" :message="application.errors.secondname"/>
                                </div>

                                <div class="col-12">
                                    <InputLabel for="email" class="form-label ">Эл. почта</InputLabel>

                                    <TextInput id="email" v-model="application.mail" type="text" class="form-control col-5 fs-6" required
                                        autofocus autocomplete="username"></TextInput>
                                    <InputError class="mt-2" :message="application.errors.mail"/>
                                </div>

                                <div class="col-12">
                                    <InputLabel for="phone" class="form-label ">Телефон</InputLabel>

                                    <TextInput id="phone" v-model="application.phone" type="text" class="form-control col-5 fs-6" required
                                        autofocus autocomplete="username"></TextInput>
                                    <InputError class="mt-2" :message="application.errors.phone"/>
                                </div>

                                <div class="col-12">
                                    <InputLabel class="form-label ">Адресс</InputLabel>
                                    <select @change="setInputs()" v-model="address" class="form-control w-50">
                                        <option v-for="address in addresses" :value="address.id">{{ address.city + ',' + address.street + ',' + address.house}}</option>
                                    </select>
                                    <div class="row">
                                        <div class="col-4">
                                            <InputLabel for="city" class="form-label ">Город</InputLabel>

                                            <TextInput id="city" v-model="application.city" type="text" class="form-control col-5 fs-6"
                                                required autofocus autocomplete="username"></TextInput>
                                            <InputError class="mt-2" :message="application.errors.city"/>
                                        </div>
                                        <div class="col-4">
                                            <InputLabel for="street" class="form-label ">Улица</InputLabel>

                                            <TextInput id="street" v-model="application.street" type="text" class="form-control col-5 fs-6"
                                                required autofocus autocomplete="username"></TextInput>
                                            <InputError class="mt-2" :message="application.errors.street"/>
                                        </div>
                                        <div class="col-4">
                                            <InputLabel for="house" class="form-label ">Дом</InputLabel>

                                            <TextInput id="house" v-model="application.house" type="text" class="form-control col-5 fs-6"
                                                required autofocus autocomplete="username"></TextInput>
                                            <InputError class="mt-2" :message="application.errors.house"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="date" class="form-label">Выберите дату</label>
                                    <VueDatePicker id="date" v-model="date" range no-disabled-range
                                        :disabled-dates="disabledDates" :min-date="new Date()"
                                        @update:model-value="countDays()" />
                                </div>
                            </div>



                            <hr class="my-4">


                            <button class="w-100 btn btn-primary btn-lg">Отправить на обработку</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <Footer />
</template>

<script>
import Footer from '@/Components/Footer.vue';
import Navigation from '@/Components/Navigation.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { addDays, subDays } from 'date-fns';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import axios from 'axios';

export default {
    components: { Footer, Navigation, Head, VueDatePicker, InputLabel, InputError, TextInput, useForm },
    data() {
        let dates = [];
        this.$page.props.dates.forEach(date => {
            dates.push(new Date(date));
        });
        return {
            equipments: [],
            date: ref(),
            disabledDates: dates,
            days: 0,
            address: {},
            addresses: [],
            application: useForm({
                name: '',
                secondname: '',
                mail: '',
                city: '',
                street: '',
                house: '',
                phone: '',
                address: null,
            }) ,
        }
    },
    beforeCreate() {
        axios.get('/fetchUserAddress', { params: {user_id : this.$page.props.auth.user.id}}).then((response) => {
            console.log(response.data);
            this.addresses = response.data;
        });
    },
    methods: {
        countDays() {
            console.log(this.date)
            let from = new Date(this.date[0]);
            let to = new Date(this.date[1]);

            this.days = Math.floor((to - from) / (1000 * 60 * 60 * 24)) + 1;
        },
        saveApplication(){
            this.application.user_id = this.$page.props.auth.user.id;
            this.application.date_from = this.date[0];
            this.application.date_to = this.date[1];
            this.application.coast = this.$page.props.equipment.coast * this.days;
            this.application.equipment_id = this.$page.props.equipment.id;
            console.log(this.application);
            axios.post('/addApplication', this.application).then((response)=>{
               window.location.href = '/applications';
            });
        },
        setInputs(){
            let address = this.addresses.find(address => address.id === this.address);
            console.log(address);
            this.application.city = address.city;
            this.application.street = address.street;
            this.application.house = address.house;
            this.application.address = this.address;
        }
    },

}
</script>