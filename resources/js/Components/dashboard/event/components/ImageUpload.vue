<template>
    <label class="relative bg-red-100 grid  items-center justify-center">
        <div class="absolute cursor-pointer top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 truncate font-bold bg-white p-4 bg-opacity-80 rounded shadow-lg">
            + {{ title }}
            <input 
                hidden 
                type="file" 
                accept="image/*" 
                @change="(e) => {
                    callBack()
                    handleImageUpload(e.target.files[0], type, id)
                }"
            >
            <div v-if="preloader" class="text-orange-500 absolute top-1/2 right-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <svg width="24px" height="24px" viewBox="0 0 24 24" class="animate-spin h-10 w-10">
                    <path opacity="0.1" fill-rule="evenodd" clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="black"/>
                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"/>
                </svg>
            </div>
        </div>
    </label>
</template>

<script setup>
    import useFileUpload from '@/Components/useFileUpload.js'
    const {
        handleImageUpload,
        preloader
    } = useFileUpload()

    const props = defineProps({
        id: [Number, String],
        title: String,
        type: String,
        callBack: {
            type: Function,
            default: () => {}
        }
    })
</script>

<style lang="scss" scoped>

</style>