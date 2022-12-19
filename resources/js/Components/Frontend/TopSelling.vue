<template>
    <div class="selling-area">
        <div class="container">
            <div class="upcome-upper">
                <h2>Top Selling</h2>
                <a href="#">View All <i class="fas fa-chevron-right" aria-hidden="true"></i></a>
            </div>

            <div class="row">
                <div v-for="top_selling in $page.props.top_selling_events" :key="top_selling.id" class="col-md-4">
                    <div class="selling-item">
                        <img :src="top_selling.images[0].path" alt="">
                        <div class="selling-cnt">
                            <h4>{{ top_selling.name }}</h4>
                            <p>{{ top_selling.tickets_stock_limit - top_selling.ticket_sold }} tickets left!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>

</style>