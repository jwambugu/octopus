<!--suppress JSUnresolvedFunction -->
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
                    <h1>
                        <span v-if="isVacation">Book Property</span>
                        <span v-else>Schedule Visit</span>
                    </h1>
                </div>

                <form @submit.prevent="bookProperty">
                    <div class="form-group">
                        <label for="checkin_date">
                            <span v-if="isVacation">Dates to book</span>
                            <span v-else>Day &amp time to visit</span>
                        </label>
                        <input
                            id="checkin_date"
                            type="text"
                            class="input-text"
                            required
                            name="dates_to_book"
                            :disabled="loadingDatePicker"
                            autocomplete="off"
                        />
                    </div>

                    <div
                        class="form-group"
                        v-if="
                            isVacation &&
                            bookingData.checkout_date &&
                            !loadingDatePicker
                        "
                    >
                        <span id="nights" class="">
                            <i>
                                Booking for {{ nightsBooked }}
                                {{ nightsBooked === 1 ? "night" : "nights" }}.
                            </i>
                        </span>
                    </div>

                    <div class="form-group">
                        <button
                            type="submit"
                            class="btn button-md btn-block button-theme"
                            v-if="!bookingProperty"
                            :disabled="loadingDatePicker"
                        >
                            <span v-if="isVacation">Book Property</span>
                            <span v-else>Schedule Visit</span>
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
                checkin_date: new Date().toISOString().slice(0, 10),
                checkout_date: new Date(
                    new Date().setDate(new Date().getDate() + 1)
                )
                    .toISOString()
                    .slice(0, 10),
                property_id: this.property.id,
            },
            errorMessage: "",
            successMessage: "",
            bookingProperty: false,
            loadingDatePicker: true,
        };
    },
    computed: {
        isVacation() {
            return this.property.type === "vacation";
        },
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
            const isVacation = this.isVacation;

            $('input[name="dates_to_book"]').daterangepicker(
                {
                    opens: "left",
                    minDate: new Date(),
                    endDate: moment().add(1, "day"),
                    singleDatePicker: !isVacation,
                    timePicker: !isVacation,
                    timePicker24Hour: !isVacation,
                    timePickerIncrement: 10,
                    locale: {
                        format: isVacation ? "YYYY-MM-DD" : "YYYY-MM-DD HH:mm",
                    },
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
                        checkin_date: isVacation
                            ? start.format("YYYY-MM-DD")
                            : start.format("YYYY-MM-DD HH:mm"),
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
