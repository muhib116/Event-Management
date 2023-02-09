import { ref, onMounted, computed } from "vue";

const languages = [
    {
        en: 'Welcome To Our Platform',
        ger: 'Willkommen auf unserer Plattform'
    },
]


const selectedLanguage = ref('en');

const languageList = ref([
    {
        key: 'en',
        value: 'English'
    },
    {
        key: 'ger',
        value: 'German'
    },
]);


export default function useLanguage() {
    const translate = (text, lan_from) => {
        let lan = languages.find(item => {
            return item[lan_from].toLowerCase() == text.toLowerCase();
        });
        return lan ? lan[selectedLanguage.value] : text;
    };

    const languageChanger = (lan) => {
        localStorage.setItem('language', lan);
    }
    onMounted(()=> {
        selectedLanguage.value = localStorage.language ? localStorage.language : selectedLanguage.value;
    });
    return {
        translate,
        selectedLanguage,
        languageList,
        languageChanger
    };
}