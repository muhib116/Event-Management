import { useAuth0 } from '@auth0/auth0-vue'
import { ref, watch, onMounted, computed } from 'vue'

const userInfo = ref({})

export default function useAuth(){
    const { loginWithRedirect, logout, user, isAuthenticated } = useAuth0()
    const login = (user) => {
        loginWithRedirect()
    }
    const logoutNow = () => {
        logout({ returnTo: window.location.origin })
        // localStorage.clear("userInfo")
    }


    watch(() => {
        userInfo.value = {
            name: user.value?.name,
            email: user.value?.email,
            picture: user.value?.picture
        }

        if(!localStorage.isAuthenticated){
            localStorage.userInfo = JSON.stringify(userInfo.value)
            localStorage.isAuthenticated = isAuthenticated.value
        }
    })

    onMounted(() => {
        userInfo.value = {
            name: user.value?.name,
            email: user.value?.email,
            picture: user.value?.picture,
            isAuthenticated: isAuthenticated?.value
        }
        if(!localStorage.userInfo){
            localStorage.userInfo = JSON.stringify(userInfo.value)
        }
    })

    const isLogIn = computed(() => {
        if(localStorage.userInfo){
            let data = JSON.parse(localStorage.userInfo)
            if(data.name){
                return true
            }
        }

        return false
    })

    const userSession = () => {
        if(localStorage.userInfo){
            return JSON.parse(localStorage.userInfo)
        }
    }

    return {
        login,
        logoutNow,
        isLogIn
    }
}