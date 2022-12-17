import { ref } from "vue"

const dashboard = ref({
    total_sales_quantity: 0,
    total_sales_amount: 0,
    total_commission: 0,
    total_event: 0,
    total_ticket: 0,
});

export default function useDashboard() {
    return {
        dashboard
    }
}