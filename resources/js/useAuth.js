import { useAuth0 } from '@auth0/auth0-vue'
import { ref, watchEffect, onMounted, computed } from 'vue'


const userInfo = ref({})
export default function useAuth(){
    const { loginWithRedirect, logout, user, isAuthenticated, isLoading, login:_login } = useAuth0()
    const login = () => {
        // localStorage.setItem('temp_url', window.location.href);
        loginWithRedirect()
    }

    watchEffect(() => {
        if(!isLoading.value){
            // let temp_url = localStorage.getItem('temp_url');
            // if (temp_url) {
            //     localStorage.removeItem('temp_url');
            //     window.location.href = temp_url;
            // }
            userInfo.value = {
                name: user.value?.name,
                email: user.value?.email,
                image: user.value?.picture
            }
        }
    })

    return {
        login,
        logout,
        isAuthenticated,
        userInfo,
        isLoading
    }
}