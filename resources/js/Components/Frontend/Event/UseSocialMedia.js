import { ref, computed } from 'vue'

const title     = ref('')
const url       = ref('')
const hashtags  = ref('')
const postImg   = ref('')

const twitter = computed(()=>{
    return `https://twitter.com/share?url=${url.value}&text=${title.value}`
})
const facebook = computed(()=>{
    return `https://www.facebook.com/sharer.php?u=${url.value}`
})
const pinterest = computed(()=>{
    return `https://pinterest.com/pin/create/bookmarklet/?media=${postImg.value}&url=${url.value}&is_video=false&description=${title.value}`
})


export default function useSocialMedia(){
    return {
        twitter,
        facebook,
        pinterest,
        title,
        url,
        hashtags,
        postImg
    }
}