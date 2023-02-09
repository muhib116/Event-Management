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
                        <label class="w-[270px] flex flex-wrap relative">
                            <span class="absolute left-1 top-1/2 -translate-y-1/2 bg-white">{{date ? moment(date).format('MM/DD/YYYY') : 'Select date'}}</span>
                            <input class="w-[60%] flex text-left text-white" v-model="date" type="date" placeholder="Select date"/>
                        </label>
                        <button class="search-btn" type="button" @click="searchSubmit()"><i class="fas fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref,watchEffect } from 'vue';
import moment from 'moment';
const date = ref()
const keyword = ref('')

function searchSubmit() {
    Inertia.get(route('search-result'), {
        keyword: keyword.value,
        date: date.value
    })
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
    box-shadow: 0 0 0 1px #172853 inset !important;
}
@media (max-width: 768px) {
    .el-picker-panel__body {
        display: flex;
        flex-direction: column;
        min-width: 100% !important;
        width: 100% !important;
    }
    .el-date-range-picker__time-header {
        display: flex;
        flex-direction: column;
    }
    .el-picker-panel {
        width: 100% !important;
    }
    .el-date-range-picker__content {
        width: 100% !important;
    }
    .el-date-range-picker__editors-wrap {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }
    .el-date-range-picker__time-picker-wrap {
        width: 100%;
    }
}
</style>