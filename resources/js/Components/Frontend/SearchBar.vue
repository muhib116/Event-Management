<template>
    <div class="search-bar">
        <div class="container">
            <form action="#">
                <div class="search-barmain">
                    <div class="search-left">
                        <input type="search" placeholder="Search by events, name, location, and more">
                    </div>
                    <div class="search-right">
                        <!-- <div class="date-field"> -->
                        <div class="w-[270px]">
                            <input class="datepicker_1 w-full block" type="date" value="Select date" data-zdp_readonly_element="false" />
                        </div>
                        <button class="search-btn" type="button"><i class="fas fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>

</style>