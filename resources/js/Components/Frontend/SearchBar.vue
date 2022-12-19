<template>
    <div class="search-bar">
        <div class="container">
            <form action="#">
                <div class="search-barmain">
                    <div class="search-left">
                        <input type="search" v-model="keyword" placeholder="Search by events, name, location, and more">
                    </div>
                    <div class="search-right">
                        <!-- <div class="date-field"> -->
                        <div class="w-[270px]">
                            <el-date-picker
                                v-model="daterange"
                                class="w-full border-none py-3 h-[40px]"
                                type="datetimerange"
                                start-placeholder="Start Date"
                                end-placeholder="End Date"
                                :default-time="defaultTime2"
                            />
                            <!-- <input class="datepicker_1 w-full block" type="date" value="Select date" data-zdp_readonly_element="false" /> -->
                        </div>
                        <button class="search-btn" type="button" @click="searchSubmit()"><i class="fas fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref } from '@vue/reactivity';
const daterange = ref('')
const keyword = ref('')
const defaultTime2 = [
  new Date(2000, 1, 1, 12, 0, 0),
  new Date(2000, 2, 1, 8, 0, 0),
] // '12:00:00', '08:00:00'

function searchSubmit() {
    Inertia.get(route('search-result'), {
        keyword: keyword.value,
        daterange: daterange.value
    });
    // console.log();
}

</script>

<style>
.block {
  padding: 30px 0;
  text-align: center;
  border-right: solid 1px var(--el-border-color);
  flex: 1;
}
.block:last-child {
  border-right: none;
}
.block .demonstration {
  display: block;
  color: var(--el-text-color-secondary);
  font-size: 14px;
  margin-bottom: 20px;
}
.el-range-editor.is-active,
.el-range-editor.is-active:hover {
    box-shadow: 0 0 0 1px #4F4CEE inset !important;
}
</style>