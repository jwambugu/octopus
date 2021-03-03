<template>
    <div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <property-details-component
                :property="property"
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
                        <label for="checkin_date">Checkin Date</label>
                        <input
                            id="checkin_date"
                            type="date"
                            class="input-text"
                            v-model="bookingData.checkin_date"
                            :min="minDate"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="checkout_date">Check Out Date</label>
                        <input
                            id="checkout_date"
                            type="date"
                            class="input-text"
                            v-model="bookingData.checkout_date"
                            :min="minDate"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <button
                            type="submit"
                            class="btn button-md btn-block button-theme"
                            v-if="!bookingProperty"
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
    },
    data() {
        return {
            bookingData: {
                checkin_date: new Date().toISOString().slice(0, 10),
                checkout_date: "",
                property_id: this.property.id,
            },
            errorMessage: "",
            successMessage: "",
            bookingProperty: false,
        };
    },
    computed: {
        minDate() {
            return new Date().toISOString().slice(0, 10);
        },
    },
    methods: {
        bookProperty() {
            this.bookingProperty = true;
            this.errorMessage = "";

            this.$store
                .dispatch("BOOK_PROPERTY", this.bookingData)
                .then(({ message, next }) => {
                    this.successMessage = message;

                    setTimeout(() => {
                        window.location.replace(next);
                    }, 2000);
                })
                .catch((error) => {
                    this.bookingProperty = false;
                    this.errorMessage = error;
                });
        },
    },
};
</script>

<style scoped></style>
