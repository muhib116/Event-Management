import { ref } from 'vue'

const imageFromApi = ref([])
const preloader = ref(false)

export default function useFileUpload() {
    const imagePreview = (file, item, key) => {
        let FR = new FileReader()
        FR.readAsDataURL(file)
        FR.onload = () => {
            item[key] = FR.result
        }
    }

    const handleImageUpload = async (file, type='banner', eventId) => 
    {
        preloader.value = true

        const formData = new FormData()
        formData.append('file', file)
        formData.append('type', type)
        await axios.post(`store/file-upload/${eventId}`, formData)
        
        preloader.value = false
        getImages(eventId)
    }

    const getImages = async (eventId) => {
        let { data } = await axios.get(`files/${eventId}`)
        imageFromApi.value = data
    }

    const deleteImage = async (id) => {
        return await axios.get(`file-delete/${id}`)
    }

    return {
        handleImageUpload,
        getImages,
        deleteImage,
        preloader,
        imageFromApi
    }
}