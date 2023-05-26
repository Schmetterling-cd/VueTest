<script setup>
import Footer from '@/Components/Footer.vue';
import Navigation from '@/Components/Navigation.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const mail = useForm({
    email: '',
    name: '',
    text: '',
});


</script>

<template>
    <div>

        <Head title="Контакты" />
        <Navigation></Navigation>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Контакты</h2>
            </div>
        </header>
        <div class="container-fluid bg-gray-100">

            <div class="container pt-5 pb-5">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-3">
                    <div class="space-y-4">

                        <h2 class="fw-bold fs-3 mb-3">Контактная информация</h2>

                        <p class="fw-bold mb-2">Общество с ограниченной ответственностью "Вальб и К"</p>
                        <p class="fw-bold mb-2">Холдинг MegaHolod ltd.</p>
                        <p class="fw-bold">Юр. адрес:</p>
                        <p class="mb-2">Гомельская обл., г. Гомель, ул. Могилевская, д. 27</p>
                        <p class="fw-bold">УНП</p>
                        <p class="mb-2">491339000</p>
                        <p class="fw-bold">Приёмная</p>
                        <p class="mb-2">+375 232 26-46-08</p>

                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <h2 class="fw-bold fs-3 mb-3">Обратная связь</h2>

                    <form @submit.prevent="submit" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="name" value="Имя" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="mail.name" required
                                autofocus autocomplete="username" />

                            <InputError class="mt-2" :message="mail.errors.name" />
                        </div>

                        <div>
                            <InputLabel for="email" value="Эл. почта" />

                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="mail.email" required
                                autofocus autocomplete="username" />

                            <InputError class="mt-2" :message="mail.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="text" value="Ваш вопрос" />

                            <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="6" maxLength="815"></textarea>
                        </div>

                        <div class="flex items-center gap-4">
                            <button class="btn btn-primary">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <Footer></Footer>
    </div>
</template>