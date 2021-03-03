<template>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="main-title-2">
            <h1><span>My</span> Bookings</h1>

            <my-bookings-table :bookings="bookings"></my-bookings-table>

            <div class="text-center" style="margin-top: 10px">
                <span v-html="links"></span>
            </div>
        </div>
    </div>
</template>

<script>
import MyBookingsTable from "./MyBookingsTable";

export default {
    name: "MyBookings",
    components: { MyBookingsTable },
    props: {
        bookings: {
            required: true,
            type: Object,
        },
        links: {
            required: true,
            type: String,
        },
    },
};
</script>

<style scoped></style>
