<template>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="heading-properties clearfix sidebar-widget">
            <div class="pull-left">
                <h3>{{ property.name }}</h3>
            </div>
            <div class="pull-right">
                <h3>
                    KES
                    <span>{{ property.cost_per_night | numberFormat }}</span>
                </h3>
                <h5>Per Night</h5>
            </div>
        </div>

        <div v-if="hasUnsuccessfulPayments">
            <div class="notice notice-info">
                We will send a payment notification to your phone with the
                booking amount of KES {{ payment.amount | numberFormat }}.
                <br />
                Please enter your Mpesa PIN to complete the transaction.
            </div>

            <div class="my-address">
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

                <div class="main-title-2">
                    <h1>Make Payment</h1>
                </div>

                <form @submit.prevent="makeMpesaPayment">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input
                            id="phone_number"
                            type="number"
                            class="input-text"
                            v-model="paymentData.phoneNumber"
                        />
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount to Pay</label>
                        <input
                            id="amount"
                            type="text"
                            class="input-text"
                            :value="payment.amount"
                            readonly
                        />
                    </div>

                    <div class="form-group">
                        <button
                            type="submit"
                            class="btn button-md btn-block button-theme"
                            v-if="!makingPayment"
                        >
                            Make Payment
                        </button>

                        <button
                            type="submit"
                            class="btn button-md btn-block button-theme"
                            disabled
                            v-else
                        >
                            <i class="fa fa-spinner fa-spin fa-1x"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div v-if="!hasUnsuccessfulPayments">
            <div class="notice notice-info">
                Payment pushed successfully. Please click the button to confirm
                it.
            </div>

            <div class="my-address">
                <div
                    class="alert text-center override-alert-text-transform"
                    :class="alertClass"
                    role="alert"
                    v-if="alertMessage"
                >
                    {{ alertMessage }}
                </div>

                <form @submit.prevent="confirmPayment">
                    <div class="form-group">
                        <button
                            type="submit"
                            class="btn button-md btn-block button-theme"
                            v-if="!confirmingPayment"
                        >
                            Confirm Payment
                        </button>

                        <button
                            type="submit"
                            class="btn button-md btn-block button-theme"
                            disabled
                            v-else
                        >
                            <i class="fa fa-spinner fa-spin fa-1x"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MpesaPaymentView",
    props: {
        booking: {
            required: true,
            type: Object,
        },
        user: {
            required: true,
            type: Object,
        },
    },
    data() {
        return {
            paymentData: {
                phoneNumber: this.user.phone_number,
            },
            makingPayment: false,
            confirmingPayment: false,
            errorMessage: "",
            successMessage: "",
            alertMessage: "",
            alertClass: "",
            hasUnsuccessfulPayments: true,
        };
    },
    computed: {
        property() {
            return this.booking.property;
        },
        payment() {
            return this.booking.unsuccessful_payments[0];
        },
    },
    created() {
        this.checkIfTheUserHasPaidSuccessfully();
    },
    methods: {
        checkIfTheUserHasPaidSuccessfully() {
            this.hasUnsuccessfulPayments =
                this.booking.unsuccessful_payments.length !== 0;
        },
        makeMpesaPayment() {
            this.makingPayment = true;
            this.errorMessage = "";

            this.paymentData.paymentID = this.payment.id;

            this.$store
                .dispatch("MAKE_MPESA_PAYMENT", this.paymentData)
                .then(({ isSuccessful, message }) => {
                    !isSuccessful
                        ? (this.errorMessage = message)
                        : (this.hasUnsuccessfulPayments = false);

                    this.makingPayment = false;
                })
                .catch((error) => {
                    this.makingPayment = false;
                    this.errorMessage = error;
                });
        },
        confirmPayment() {
            this.confirmingPayment = true;
            this.errorMessage = "";
            this.alertMessage = "";

            this.$store
                .dispatch("CONFIRM_MPESA_PAYMENT", {
                    uuid: this.booking.uuid,
                })
                .then(({ message, alertClass, next, status }) => {
                    this.alertClass = alertClass;
                    this.alertMessage = message;

                    this.confirmingPayment = false;

                    if (status === "success") {
                        window.location.reload(next);
                    }
                })
                .catch((error) => {
                    this.confirmingPayment = false;
                    this.errorMessage = error;
                });
        },
    },
};
</script>

<style scoped></style>
