<template>
    <div class="ticket-item" :class="quantity&&'active-box'">

        <h2>{{ ticket.ticket_name }}</h2>
        <p>{{ ticket.ticket_description }}</p>
        <div class="ticket-btmcnt">
            <h4>
                {{ ticket.ticket_type == 'Free' || !ticket.price || ticket.price == 0 ? 'Free' : `$. ${ticket.price}` }}
            </h4>
            <form action="#" method="POST">
                <div class="quantity">
                    <span @click="quantity>0&&quantity--" class="input-number-decrement">
                        <img src="@/assets/frontend/images/minus.svg" alt="">
                    </span>
                    <input class="input-number active" type="text" v-model="quantity">
                    <span @click="quantity++" class="input-number-increment">
                        <img src="@/assets/frontend/images/plus.svg" alt="">
                    </span>                     
                </div>
            </form>  
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    defineProps({
        ticket: Object
    })

    const quantity = ref(0)
</script>

<style lang="scss" scoped>

</style>