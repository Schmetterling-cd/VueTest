<script setup>
import Footer from '@/Components/Footer.vue';
import Navigation from '@/Components/Navigation.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Главная" />
    <Navigation></Navigation>
    <div class="container-fluid bg-gray-100 pt-4 pb-4">
        <div className="container">
            <div class="w-100 row align-items-center ">
                <div class="col-8 h-75">
                    <h1 class="h1-special w-75">Сервис аренды спецтехники</h1>
                    <p class="w-50 pt-4 pb-4">Надёжный и простой способ горячей аренды всех видов спецтехники и самосвалов
                    </p>
                    <a role="button" href="/market" class="btn btn-warning">Заказать технику</a>
                </div>
                <div class="col-4">
                    <img class="rounded" src="../../../public/images/main/img-001.jpg" />
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 pb-5">

        <div class="container">
            <div class="row justify-content-around text-center">
                <div class="col align-self-center">
                    <h2>Спецшеринг — это сервис аренды спецтехники. Никакой платы за пользование сервисом или регистрацию,
                        вы платите за часы аренды.</h2>
                    <p>Зачем содержать свой парк, если можно иметь доступ к 7 000 единицам техники, которые не нужно
                        обслуживать, заправлять, и держать в штате машиниста.</p>
                </div>
            </div>
            <div class="row justify-content-around pt-5 pb-5">
                <div class="col-3 align-self-center">
                    <h1 class="lending_number border-bottom">100+</h1>
                    <p>Единицы спецтехники доступны для аренды</p>
                </div>
                <div class="col-3 align-self-center">
                    <h1 class="lending_number border-bottom">300+</h1>
                    <p>Корпоративных клиентов заказывают технику в Спецшеринг</p>
                </div>
                <div class="col-3">
                    <div class="row border-bottom">
                        <div class="col-2">
                            <h2 class="lending_number">6</h2>
                        </div>
                        <div class="col-8 align-self-center">
                            <h5>Регионов присутствия сервиса</h5>
                        </div>
                    </div>
                    <div class="row">
                        <p>Брестская, Витебская, Гомельская, Гродненская, Могилёвская, Минская</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-around text-center">
                <img class="w-75" src="../../../public/images/main/img-002.png" />
            </div>
        </div>
    </div>
    <div class="container-fluid bg-gray-100">
        <div className="container">
        <div className="w-100 row align-items-center mb-3">
            <div className="col-12">
                <h1 className="h1-special">Популярная техника</h1>
            </div>
        </div>
    </div>
    </div>
    <Footer></Footer>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
