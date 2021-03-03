<template>
    <table class="manage-table responsive-table">
        <tbody>
            <my-bookings-table-row
                v-for="(booking, index) in bookings.data"
                :key="index"
                :booking="booking"
                :count="bookingsCount"
                :index="index + 1"
            ></my-bookings-table-row>
        </tbody>
    </table>
</template>

<script>
import MyBookingsTableRow from "./MyBookingsTableRow";

export default {
    name: "MyBookingsTable",
    components: { MyBookingsTableRow },
    props: {
        bookings: {
            required: true,
            type: Object,
        },
    },
    computed: {
        bookingsCount() {
            return this.bookings.total;
        },
    },
};
</script>

<style scoped></style>
