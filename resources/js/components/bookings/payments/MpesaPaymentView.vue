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

        <div class="notice notice-info">
            We will send a payment notification to your phone with the booking
            amount of KES 1,000. <br />
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
</template>

<script>
export default {
    name: "MpesaPaymentView",
    props: {
        payment: {
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
                paymentID: this.payment.id,
            },
            makingPayment: true,
            errorMessage: "",
            successMessage: "",
        };
    },
    computed: {
        property() {
            return this.payment.property;
        },
    },
    methods: {
        makeMpesaPayment() {
            this.makingPayment = true;
            this.errorMessage = "";

            this.$store.dispatch("MAKE_MPESA_PAYMENT", this.paymentData);
        },
    },
};
</script>

<style scoped></style>
