<template>
    <Head title="Event Details" />
    <Master>
        <div class="result-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="result-left me-xl-5">
                            <div class="result-title">
                                <h2>Filters</h2>
                            </div>
                            <div class="stich-btn">
                                <label class="switch">
                                    <input type="checkbox" checked="">
                                    <span class="slider round"></span>
                                </label>
                                <span class="online online-checked">Online</span>
                            </div>

                            <div class="filter-item">
                                <h4>Location <i class="fas fa-chevron-up"></i> <i class="fas fa-chevron-down"></i></h4>
                                <form action="#" method="POST">
                                    <ul class="filter-disable">
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck1">
                                                <label for="ck1">International</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck2">
                                                <label for="ck2">Jakarta Selatan</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck3">
                                                <label for="ck3">Jakarta Timur</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck4">
                                                <label for="ck4">Tangerang Selatan</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck5">
                                                <label for="ck5">Jabodetabek</label>
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>

                            <div class="filter-item">
                                <h4>Categories <i class="fas fa-chevron-up"></i> <i class="fas fa-chevron-down"></i></h4>
                                <form action="#" method="POST">
                                    <ul>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck6">
                                                <label for="ck6">Concert</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck7">
                                                <label for="ck7">Arts</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck8" checked>
                                                <label for="ck8">Conference</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck9">
                                                <label for="ck9">Movies</label>
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>

                            <div class="filter-item border-0">
                                <h4>Price <i class="fas fa-chevron-up"></i> <i class="fas fa-chevron-down"></i></h4>
                                <div class="range-slider">
                                    <div id="slider-range"></div>
                                    <div class="range-cnt">
                                        <span id="slider-range-value1"></span>
                                        <span id="slider-range-value2"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="result-right">
                            <div class="result-forupr">
                                <h2>Search results for <span> “UX”</span></h2>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-xl-4">
                                    <div class="result-item">
                                        <img src="@/assets/frontend/images/ux-1.png" alt="">
                                        <div class="result-cnt">
                                            <div class="result-cntleft">
                                                <h4>SEP</h4>
                                                <p>20</p>
                                            </div>
                                            <div class="result-cntright">
                                                <h6>Conference · Online</h6>
                                                <h4>Coding 105: UI/UX Design</h4>
                                                <p>Rp. 200.000 - 550.000</p>
                                                <p><i class="fas fa-map-marker-alt"></i> Online</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="result-item">
                                        <img src="@/assets/frontend/images/ux-2.png" alt="">
                                        <div class="result-cnt">
                                            <div class="result-cntleft">
                                                <h4>SEP</h4>
                                                <p>22</p>
                                            </div>
                                            <div class="result-cntright">
                                                <h6>Conference · Online</h6>
                                                <h4>Intro to UX/UI Design</h4>
                                                <p>Rp. 200.000 - 550.000</p>
                                                <p><i class="fas fa-map-marker-alt"></i> Online</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="result-item">
                                        <img src="@/assets/frontend/images/ux-3.png" alt="">
                                        <div class="result-cnt">
                                            <div class="result-cntleft">
                                                <h4>SEP</h4>
                                                <p>23</p>
                                            </div>
                                            <div class="result-cntright">
                                                <h6>Conference · Online</h6>
                                                <h4>Skills U: UX/UI Design</h4>
                                                <p>Rp. 200.000 - 550.000</p>
                                                <p><i class="fas fa-map-marker-alt"></i> Online</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="result-item">
                                        <img src="@/assets/frontend/images/ux-4.png" alt="">
                                        <div class="result-cnt">
                                            <div class="result-cntleft">
                                                <h4>SEP</h4>
                                                <p>24</p>
                                            </div>
                                            <div class="result-cntright">
                                                <h6>Conference · Online</h6>
                                                <h4>UX/UI Design Workshop</h4>
                                                <p>Rp. 200.000 - 550.000</p>
                                                <p><i class="fas fa-map-marker-alt"></i> Online</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
</script>

<style lang="scss" scoped>

</style>