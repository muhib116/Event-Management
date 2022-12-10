import imageOne from '@/assets/frontend/images/upcome-1.png'
import imageTwo from '@/assets/frontend/images/upcome-2.png'
import imageThree from '@/assets/frontend/images/upcome-3.png'
import imageFour from '@/assets/frontend/images/upcome-4.png'

export default function useUpcomingEvents() {
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
    return {
        demoData
    }
}