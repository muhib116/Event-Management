<template>
    <div class="selling-area">
        <div class="container">
            <div class="upcome-upper">
                <h2>Top Selling</h2>
            </div>

            <div class="row">
                <div v-for="top_selling in $page.props.top_selling_events" :key="top_selling.id" class="col-md-4">
                    <Link :href="route('event.details', top_selling.slug)">
                        <div class="selling-item rounded overflow-hidden">
                            <img :src="get_banner(top_selling.images)" alt="" class="aspect-video object-cover object-center">
                            <div class="selling-cnt">
                                <h4>{{ top_selling.name }}</h4>
                                <p>{{ top_selling.tickets_stock_limit - top_selling.ticket_sold }} tickets left!</p>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3';
    import useEvent from '@/Pages/useEvent.js'

    const { get_banner } = useEvent()
</script>

<style lang="scss" scoped>

</style>