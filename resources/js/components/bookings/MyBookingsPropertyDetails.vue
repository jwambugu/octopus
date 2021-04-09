<template>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <property-details-component
            :property="booking.property"
            :is-paid="booking.is_paid"
        ></property-details-component>

        <div class="sidebar-widget latest-reviews">
            <div class="main-title-2">
                <h1>Our Cancellation Policy</h1>
            </div>
            <div class="media">
                <div class="media-body">
                    <h3 class="media-heading">
                        <a>{{ cancellationPolicy.title }}</a>
                    </h3>

                    <p>{{ cancellationPolicy.description }}</p>

                    <div v-if="booking.is_paid">
                        <div
                            class="pull-right"
                            style="padding-top: 15px"
                            v-if="canCancel"
                        >
                            <button
                                class="button-theme button-md"
                                v-if="!isCancelling"
                            >
                                Cancel Booking
                            </button>

                            <button
                                type="button"
                                class="button-theme button-md"
                                disabled
                                v-else
                            >
                                <i class="fa fa-spinner fa-spin fa-1x"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="heading-properties clearfix sidebar-widget">
            <div class="tables mb-50">
                <h3 class="heading-3">Payments</h3>
                <table class="table table-bordered mb-0">
                    <thead class="bg-active">
                        <tr class="ass">
                            <th scope="col" style="width: 5%">#</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(payment, index) in booking.payments">
                            <td>{{ index + 1 }}</td>
                            <td>KES {{ payment.amount | numberFormat }}</td>
                            <td>
                                <span
                                    class="label label-success"
                                    v-if="payment.is_paid"
                                    >Paid</span
                                >
                                <span class="label label-info" v-else
                                    >Not Paid</span
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import PropertyDetailsComponent from "../utils/PropertyDetailsComponent";

export default {
    name: "MyBookingsPropertyDetails",
    components: { PropertyDetailsComponent },
    props: {
        booking: {
            required: true,
            type: Object,
        },
        canCancel: {
            required: true,
            type: Boolean,
        },
    },
    data() {
        return {
            isCancelling: false,
        };
    },
    computed: {
        cancellationPolicy() {
            return this.booking.property.cancellation_policy;
        },
    },
};
</script>

<style scoped></style>
