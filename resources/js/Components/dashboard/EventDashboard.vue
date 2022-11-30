<template>
    <main class="dashboard">
        <!--  -->
        <h1 class="title">Your events</h1>
        <div class="events">

            <div @click="showEventPopup = true" class="create-new">
                <i class="fa-solid plus-icon fa-plus"></i>
                <p>Creat new event</p>
            </div>

            <div @click="(showBoxOfficePopup = true)" class="create-new">
                <i class="fa-solid plus-icon fa-plus"></i>
                <p>Creat new box office</p>
            </div>




            <div class="example">
                <div class="top">
                    <div class="img-box">
                        <img src="../../assets/images/document.svg" class="folder" alt="Folder Icon">
                        <img src="../../assets/images/star-bars.svg" class="star" alt="Star Icon">
                    </div>
                </div>
                <div class="bottom">
                    <div class="name">Example Box Office</div>
                    <img src="../../assets/images/dots.svg" class="dots" alt="dots">
                </div>
            </div>
            <a href="live/event" class="event">
                <div class="thumbnail">
                    <img src="../../assets/images/apple.jpg" alt="Thumbnail">
                    <span>Draft</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">Odio nihil ducimus quas...</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="date">Started 11 hours ago</div>
                        <div class="state">Tickets Sold</div>
                    </div>
                </div>
            </a>
            <a href="live/event" class="event">
                <div class="thumbnail">
                    <img src="../../assets/images/thumbnail.png" alt="Thumbnail">
                    <span>Ended</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">TEST EMM</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="date">Ended 4 Days ago</div>
                        <div class="state">Tickets Sold</div>
                    </div>
                </div>
            </a>
            <a href="live/event" class="event">
                <div class="thumbnail">
                    <img src="../../assets/images/thumbnail.png" alt="Thumbnail">
                    <span>Ended</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">TEST EMM</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="date">Ended 4 Days ago</div>
                        <div class="state">Tickets Sold</div>
                    </div>
                </div>
            </a>
            <a href="live/event" class="event">
                <div class="thumbnail">
                    <img src="../../assets/images/virtural-event.png" alt="Thumbnail">
                    <span>Ended</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">TEST EMM</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="date">Ended 4 Days ago</div>
                        <div class="state">Tickets Sold</div>
                    </div>
                </div>
            </a>
            <a href="live/event" class="event">
                <div class="thumbnail">
                    <img src="../../assets/images/digital-marketing.png" alt="Thumbnail">
                    <span>Ended</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">TEST EMM</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="date">Ended 4 Days ago</div>
                        <div class="state">Tickets Sold</div>
                    </div>
                </div>
            </a>
            <a href="live/event" class="event">
                <div class="thumbnail">
                    <img src="../../assets/images/thumbnail.png" alt="Thumbnail">
                    <span>Ended</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">TEST EMM</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="date">Ended 4 Days ago</div>
                        <div class="state">Tickets Sold</div>
                    </div>
                </div>
            </a>
        </div>

        <NewEventPopup v-model="showEventPopup" />
        <BoxOfficePopup v-model="showBoxOfficePopup" />
    </main>
</template>

<script setup>
    import { ref } from 'vue'
    import NewEventPopup from './popup/NewEventPopup.vue';
    import BoxOfficePopup from './popup/BoxOfficePopup.vue';
    const showEventPopup = ref(false)
    const showBoxOfficePopup = ref(false)
</script>

<style lang="scss" scoped>

</style>