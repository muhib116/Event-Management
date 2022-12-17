export default function useUpcomingEvents() {
    const months = ["January","February","March","April","May","June","July", "August","September","October","November","December"];
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
        months,
        getMonth,
        formateDate,
        truncate
    }
}