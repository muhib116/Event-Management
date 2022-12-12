import imageOne from '@/assets/frontend/images/upcome-1.png'
import imageTwo from '@/assets/frontend/images/upcome-2.png'
import imageThree from '@/assets/frontend/images/upcome-3.png'
import imageFour from '@/assets/frontend/images/upcome-4.png'

export default function useUpcomingEvents() {
    const months = ["January","February","March","April","May","June","July", "August","September","October","November","December"];
    const demoData = [
        {
            path: imageOne,
            title: 'Panic! at the Disco',
            location: 'The Icon, BSD',
            price: 'Rp. 450.000 - 975.000',
            month: 'Nov',
            day: '01'
        },
        {
            path: imageTwo,
            title: 'Hamilton the Musical',
            location: 'Ciputra Artpreneur',
            price: 'Rp. 1.500.000 - 3.000.000',
            month: 'Nov',
            day: '02'
        },
        {
            path: imageThree,
            title: 'Anastasia the Musical',
            location: 'Ciputra Artpreneur',
            price: 'Rp. 850.000 - 3.000.000',
            month: 'Nov',
            day: '03'
        },
        {
            path: imageFour,
            title: 'Ali Abdaal Seminar',
            location: 'Online',
            price: 'Free',
            month: 'Nov',
            day: '03'
        },
        {
            path: imageOne,
            title: 'Panic! at the Disco',
            location: 'The Icon, BSD',
            price: 'Rp. 450.000 - 975.000',
            month: 'Nov',
            day: '01'
        },
        {
            path: imageTwo,
            title: 'Hamilton the Musical',
            location: 'Ciputra Artpreneur',
            price: 'Rp. 1.500.000 - 3.000.000',
            month: 'Nov',
            day: '02'
        },
        {
            path: imageThree,
            title: 'Anastasia the Musical',
            location: 'Ciputra Artpreneur',
            price: 'Rp. 850.000 - 3.000.000',
            month: 'Nov',
            day: '03'
        },
        {
            path: imageFour,
            title: 'Ali Abdaal Seminar',
            location: 'Online',
            price: 'Free',
            month: 'Nov',
            day: '03'
        },
    ]
    const getMonth = (date) => {
        return months[new Date(date).getMonth()]
    }
    const formateDate = (date) => {
        date = new Date(date).getDate()
        if(date<10) date = `0${date}`

        return date
    }
    const truncate = (str, length=60) => {
        if(str.length<length){
            return str
        }
        str = str.slice(0, length)
        return `${str}...`
    }
    return {
        demoData,
        months,
        getMonth,
        formateDate,
        truncate
    }
}