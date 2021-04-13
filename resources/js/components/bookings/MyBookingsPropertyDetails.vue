<template>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div
            class="alert alert-success text-center override-alert-text-transform"
            role="alert"
            v-if="successMessage"
        >
            {{ successMessage }}
        </div>

        <div
            class="alert alert-danger text-center override-alert-text-transform"
            role="alert"
            v-if="errorMessage"
        >
            {{ errorMessage }}
        </div>

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
                                data-toggle="modal"
                                data-target="#cancelBookingModal"
                            >
                                Cancel Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="canCancel">
            <div
                class="modal fade"
                id="cancelBookingModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="cancelBookingModal"
                style="margin-top: 15rem"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                                <strong>Cancel Booking</strong>
                            </h4>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to cancel this booking for
                            property <strong>{{ booking.property.name }}</strong
                            >? You will be charged
                            <strong>{{
                                cancellationPolicy.percentage_to_refund
                            }}</strong
                            >% of the total booking amount plus the transaction
                            charges.
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="button-theme button-md"
                                v-if="!isCancelling"
                                @click="cancelBooking"
                            >
                                Proceed To Cancel
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
            errorMessage: "",
            successMessage: "",
        };
    },
    computed: {
        cancellationPolicy() {
            return this.booking.property.cancellation_policy;
        },
    },
    methods: {
        hideModal() {
            $("#cancelBookingModal").modal("hide");
        },
        cancelBooking() {
            this.isCancelling = true;
            this.errorMessage = "";
            this.successMessage = "";

            this.$store
                .dispatch("CANCEL_BOOKING", {
                    uuid: this.booking.uuid,
                })
                .then(({ message }) => {
                    this.hideModal();

                    this.successMessage = message;

                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                })
                .catch((error) => {
                    this.errorMessage = error;
                    this.isCancelling = false;

                    this.hideModal();
                });
        },
    },
};
</script>

<style scoped></style>
