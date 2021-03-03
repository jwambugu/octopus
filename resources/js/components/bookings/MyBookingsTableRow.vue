<template>
    <tr :class="{ 'b-none': isLastProperty }">
        <td class="title-container">
            <img
                :src="image"
                :alt="property.name"
                class="img-responsive hidden-xs"
            />
            <div class="title">
                <h4>
                    <a :href="propertyLink">{{ property.name }} </a>
                </h4>

                <span class="table-property-price">
                    KES {{ property.cost_per_night | numberFormat }} / per night
                </span>
            </div>
        </td>
        <!--        <td class="expire-date hidden-xs">-->
        <!--            {{ checkoutDate }}-->
        <!--        </td>-->

        <td class="action">
            <a :href="viewBookingLink"><i class="fa fa-eye"></i> View</a>
        </td>
    </tr>
</template>

<script>
export default {
    name: "MyBookingsTableRow",
    props: {
        booking: {
            required: true,
            type: Object,
        },
        count: {
            required: true,
            type: Number,
        },
        index: {
            required: true,
            type: Number,
        },
    },
    computed: {
        isLastProperty() {
            return this.count === this.index;
        },
        property() {
            return this.booking.property;
        },
        propertyLink() {
            return `/properties/${this.property.slug}`;
        },
        viewBookingLink() {
            return `/bookings/${this.booking.uuid}`;
        },
        checkoutDate() {
            return new Date(this.booking.checkout_date).toDateString();
        },
        image() {
            return this.property.default_image.public_url;
        },
    },
};
</script>

<style scoped></style>
