<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from './ApplicationLogo.vue';


</script>

<template>
    <div className="container-fluid border-top">
        <div className="container">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5">
                <div class="col mb-3">
                    <a :href="route('main')" className="d-flex align-items-center mb-3 link-dark text-decoration-none">
                        <ApplicationLogo />
                    </a>
                    <p className="text-muted">© 2023</p>
                </div>

                <div className="col mb-3">

                </div>

                <div className="col mb-3">
                    <ul className="nav flex-column">
                        <li className="nav-item mb-2"><a href="#" className="nav-link p-0 text-muted">Крупному бизнесу</a>
                        </li>
                        <li className="nav-item mb-2"><a href="#" className="nav-link p-0 text-muted">Владельцам</a></li>
                        <li className="nav-item mb-2"><a href="#" className="nav-link p-0 text-muted">Шеринг</a></li>
                        <li className="nav-item mb-2"><a href="#" className="nav-link p-0 text-muted">Блог</a></li>
                    </ul>
                </div>

                <div className="col mb-3">
                    <ul className="nav flex-column">
                        <li className="nav-item mb-2"><a href="#" className="nav-link p-0 text-muted">Контакты</a></li>
                        <li className="nav-item mb-2"><a href="#"
                                className="nav-linkinstagram-0 text-muted">Документация</a></li>
                    </ul>
                </div>

                <div className="col mb-3">
                    <ul className="naclassv flex-column">
                        <li className="nav-item mb-2"><a href="#" className="nav-link p-0 text-muted">Служба поддержки</a>
                        </li>
                        <li className="nav-item mb-2"><a href="tel:+375293421550" className="nav-link p-0 text-muted">+375
                                (29) 342-15-50</a></li>
                        <li className="nav-item mb-2"><a className="nav-link p-0 text-muted"
                                href="mailto:lelyaalekseevna136@gmail.com?subject=Поддержка">lelyaalekseevna136@gmail.com</a>
                        </li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>

    <div className="container-fluid border-top">
        <div className="container">
            <footer className="d-flex flex-wrap justify-content-between align-items-center py-3 my-4">
                <div className="col-md-4 d-flex align-items-center">
                    <a href="/" className="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                        <svg className="bi" width="30" height="24">
                            <use xlinkHref="#bootstrap"></use>
                        </svg>
                    </a>
                    <span className="mb-3 mb-md-0 text-muted">© 2023 Спецшеринг</span>
                </div>

                <ul className="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li className="ms-3"><a href="https://twitter.com/Vladvad2002"><img
                                src="../../../public/images/twitter.svg" style="width: 50px; height: 50px" /></a>
                    </li>
                    <li className="ms-3"><a href="https://www.instagram.com/lelya_veinsberg/"><img
                                src="../../../public/images/instagram.svg" style="width: 50px; height: 50px" /></a>
                    </li>
                    <li className="ms-3"><a
                            href="https://www.facebook.com/people/%D0%90%D0%BB%D0%B5%D0%BD%D0%B0-%D0%98%D0%B2%D0%B0%D0%BD%D0%BE%D0%B2%D0%B0/pfbid02Z5kd5WqndUSp2X6w12vn6VuRoxGCJYYd92bgX3LnB5dQWTRXV3R3tAs354Qrdqkgl/?mibextid=ZbWKwL"><img
                                src="../../../public/images/facebook.svg" style="width: 50px; height: 50px" /></a>
                    </li>
                </ul>
            </footer>
        </div>
    </div>
</template>