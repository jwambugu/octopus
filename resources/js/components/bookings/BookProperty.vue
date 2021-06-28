<template>
    <div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <property-details-component
                :property="property"
                :is-paid="false"
            ></property-details-component>

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
                    <h1>Book Property</h1>
                </div>

                <form @submit.prevent="bookProperty">
                    <div class="form-group">
                        <label for="checkin_date">Dates to Book</label>
                        <input
                            id="checkin_date"
                            type="text"
                            class="input-text"
                            required
                            name="dates_to_book"
                            :disabled="loadingDatePicker"
                        />
                    </div>

                    <!--                    <div class="form-group">-->
                    <!--                        <label for="checkout_date">Check Out Date</label>-->
                    <!--                        <input-->
                    <!--                            id="checkout_date"-->
                    <!--                            type="date"-->
                    <!--                            class="input-text"-->
                    <!--                            v-model="bookingData.checkout_date"-->
                    <!--                            :min="minDate"-->
                    <!--                            required-->
                    <!--                            @input="monitorCheckoutDate"-->
                    <!--                        />-->
                    <!--                    </div>-->

                    <div class="form-group" v-if="bookingData.checkout_date">
                        <span id="nights" class="">
                            <i
                                >Booking for {{ nightsBooked }}
                                {{ nightsBooked === 1 ? "night" : "nights" }}.
                            </i>
                        </span>
                    </div>

                    <div class="form-group">
                        <button
                            type="submit"
                            class="btn button-md btn-block button-theme"
                            v-if="!bookingProperty"
                            :disabled="!bookingData.checkout_date"
                        >
                            Book Property
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
import PropertyDetailsComponent from "../utils/PropertyDetailsComponent";

export default {
    name: "BookProperty",
    components: { PropertyDetailsComponent },
    props: {
        property: {
            required: true,
            type: Object,
        },
        bookedDates: {
            required: true,
            type: Array,
        },
    },
    data() {
        return {
            bookingData: {
                checkin_date: "", // new Date().toISOString().slice(0, 10)
                checkout_date: "",
                property_id: this.property.id,
            },
            errorMessage: "",
            successMessage: "",
            bookingProperty: false,
            loadingDatePicker: true,
        };
    },
    computed: {
        minDate() {
            return new Date().toISOString().slice(0, 10);
        },
        formattedDates() {
            const { checkin_date, checkout_date } = this.bookingData;
            const checkinDate = new Date(checkin_date);
            const checkoutDate = new Date(checkout_date);

            return { checkoutDate, checkinDate };
        },
        nightsBooked() {
            const { checkoutDate, checkinDate } = this.formattedDates;

            const timeDifference = Math.abs(checkoutDate - checkinDate);
            const daysBetween = Math.ceil(
                timeDifference / (1000 * 60 * 60 * 24)
            );

            return daysBetween === 0 ? 1 : daysBetween;
        },
        isCheckingOutInThePast() {
            const { checkoutDate, checkinDate } = this.formattedDates;

            return checkoutDate - checkinDate < 0;
        },
        dateRanges() {
            return this.bookedDates.map((date) => {
                return {
                    start: moment(date.checkin_date),
                    end: moment(date.checkout_date),
                };
            });
        },
    },
    created() {
        setTimeout(() => {
            this.initDatePicker();
            this.loadingDatePicker = false;
        }, 3000);
    },
    methods: {
        initDatePicker() {
            const vm = this;

            $('input[name="dates_to_book"]').daterangepicker(
                {
                    opens: "left",
                    minDate: new Date(),
                    format: "YYYY-MM-DD",
                    isInvalidDate: function (date) {
                        return vm.dateRanges.reduce(function (bool, range) {
                            return (
                                bool ||
                                (date >= range.start && date <= range.end)
                            );
                        }, false);
                    },
                },
                function (start, end) {
                    vm.bookingData = {
                        checkin_date: start.format("YYYY-MM-DD"),
                        checkout_date: end.format("YYYY-MM-DD"),
                    };
                }
            );
        },
        monitorCheckoutDate() {
            this.errorMessage = "";

            if (this.isCheckingOutInThePast) {
                this.bookingData.checkout_date = "";
                this.errorMessage =
                    "Checkout date must be greater than or equal to checkin date.";
            }
        },
        bookProperty() {
            this.bookingProperty = true;
            this.errorMessage = "";
            this.bookingData.property_id = this.property.id;

            this.$store
                .dispatch("BOOK_PROPERTY", this.bookingData)
                .then(({ message, next }) => {
                    this.successMessage = message;
                    this.bookingProperty = false;

                    setTimeout(() => {
                        location.replace(next);
                    }, 2000);
                })
                .catch((error) => {
                    this.bookingProperty = false;
                    this.errorMessage = error;
                    this.bookingData.checkout_date = "";
                });
        },
    },
};
</script>

<style scoped></style>
