<template>
    <div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="heading-properties clearfix sidebar-widget">
                <div class="pull-left">
                    <h3>{{ property.name }}</h3>
                    <p>
                        <i class="fa fa-map-marker"></i>
                        {{ property.address }}
                    </p>
                </div>
                <div class="pull-right">
                    <h3>
                        <span
                            >KES
                            {{ property.cost_per_night | numberFormat }}</span
                        >
                    </h3>
                    <h5>Per Night</h5>
                </div>
            </div>

            <div class="panel-box">
                <div class="panel with-nav-tabs panel-default">
                    <div class="panel-body">
                        <div class="tab-content">
                            <div
                                class="tab-pane fade active in"
                                id="generalInformation"
                            >
                                <div class="panel-div">
                                    <div
                                        class="panel-group mb-0"
                                        role="tablist"
                                    >
                                        <div class="panel panel-default">
                                            <div
                                                class="panel-heading active"
                                                role="tab"
                                                id="heading1"
                                            >
                                                <h4 class="panel-title">
                                                    <a
                                                        class="collapsed"
                                                        role="button"
                                                        data-toggle="collapse"
                                                        data-parent="#accordion"
                                                        href="#collapse1"
                                                        aria-expanded="false"
                                                    >
                                                        <i class="fa"></i>
                                                        Amenities
                                                    </a>
                                                </h4>
                                            </div>
                                            <div
                                                id="collapse1"
                                                class="panel-collapse collapse"
                                                role="tabpanel"
                                                aria-expanded="false"
                                            >
                                                <div
                                                    class="panel-body panel-body-2"
                                                >
                                                    <div
                                                        class="sidebar-widget mb-40"
                                                    >
                                                        <div
                                                            class="properties-amenities"
                                                        >
                                                            <div class="row">
                                                                <div
                                                                    class="col-lg-4 col-md-4 col-sm-4 col-xs-12"
                                                                    v-for="(
                                                                        amenity,
                                                                        index
                                                                    ) in amenities"
                                                                    :key="index"
                                                                >
                                                                    <ul
                                                                        class="amenities"
                                                                    >
                                                                        <li>
                                                                            <i
                                                                                :class="
                                                                                    amenity
                                                                                        .amenity
                                                                                        .icon
                                                                                "
                                                                            ></i
                                                                            >{{
                                                                                amenity
                                                                                    .amenity
                                                                                    .name
                                                                            }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
export default {
    name: "BookProperty",
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
        amenities() {
            return this.property.amenities;
        },
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
