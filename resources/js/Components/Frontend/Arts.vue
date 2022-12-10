<template>
    <div class="upcome-area pt-0">
        <div class="container">
            <div class="upcome-upper">
                <h2>Browse Arts</h2>
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
            </div>
            

            <div class="main-content relative">
                <Carousel ref="myCarousel" :settings="settings" :breakpoints="breakpoints">
                    <Slide v-for="(item, index) in demoData" :key="index">
                        <div class="upcome-item">
                            <div class="upcome-banr">
                                <img :src="item.path" :alt="item.title">
                            </div>
                            <div class="upcome-cnt">
                                <div class="upcome-cntleft">
                                    <h4>{{ item.month }}</h4>
                                    <p>{{ item.day }}</p>
                                </div>
                                <div class="upcome-cntright">
                                    <h4>{{ item.title }}</h4>
                                    <p>{{ item.price }}</p>
                                    <p><i class="fas fa-map-marker-alt"></i> {{ item.location }} </p>
                                </div>
                            </div>
                        </div>
                    </Slide>
                
                    <template #addons>
                        <Pagination />
                    </template>
                </Carousel>

                <div class="absolute top-1/2 transform -translate-y-10 flex gap-2 w-full justify-between">
                    <button @click="myCarousel.prev()" class="px-[12px] py-2 rounded bg-[#4f4cee] text-white">
                        <svg width="10" height="17" viewBox="0 0 10 17" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.87137 2.49918L3.83995 8.53059L9.87137 14.562L8.66508 16.9746L0.2211 8.53059L8.66508 0.0866089L9.87137 2.49918Z" fill="currentColor"/>
                        </svg>                            
                    </button>
                    <button @click="myCarousel.next()" class="px-[12px] py-2 rounded bg-[#4f4cee] text-white">
                        <svg width="10" height="18" viewBox="0 0 10 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.237671 14.9882L6.26909 8.95674L0.237671 2.92532L1.44395 0.512756L9.88794 8.95674L1.44395 17.4007L0.237671 14.9882Z" fill="currentColor" />
                        </svg>                            
                    </button>
                </div>
            </div>
        </div>
    </div>
  </template>
  
<script setup>
    import { Carousel, Slide, Pagination } from 'vue3-carousel'
    import '@/assets/frontend/carouselStyle.css'
    import useUpcomingEvents from './useUpcomingEvents'
    import { ref } from 'vue'

    const myCarousel = ref(null)
    const { demoData } = useUpcomingEvents()
  
    const settings = {
        itemsToShow: 1,
        snapAlign: 'center',
    }

    const breakpoints = {
        // 700px and up
        700: {
          itemsToShow: 3,
          snapAlign: 'center',
        },
        // 1024 and up
        1024: {
          itemsToShow: 4,
          snapAlign: 'start',
        },
      }
  </script>