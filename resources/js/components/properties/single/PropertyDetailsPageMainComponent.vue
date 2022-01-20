<template>
    <div>
        <div class="properties-details-page content-area">
            <div class="container">
                <div class="row mb-20">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="heading-properties clearfix sidebar-widget">
                            <div class="pull-left">
                                <h3>{{ property.name | ucWords }}</h3>
                            </div>
                            <div class="pull-right">
                                <h3>
                                    <span>
                                        KES
                                        {{
                                            property.cost_per_night
                                                | numberFormat
                                        }}
                                    </span>
                                </h3>
                                <h5>Per {{ costTypeText }}</h5>
                            </div>
                        </div>

                        <div class="sidebar-widget mb-40">
                            <property-details-page-slider
                                :images="images"
                                :slug="property.slug"
                            ></property-details-page-slider>

                            <div class="properties-description mb-40">
                                <div class="main-title-2">
                                    <h1><span>Description</span></h1>
                                </div>
                                <p class="text-left">
                                    {{ property.description }}
                                </p>
                            </div>

                            <hr />

                            <div class="properties-amenities">
                                <div class="main-title-2">
                                    <h1><span>Amenities</span></h1>
                                </div>
                                <div class="row">
                                    <div
                                        class="col-lg-6 col-md-6 col-sm-6 col-xs-12"
                                        v-for="(amenity, index) in amenities"
                                        :key="index"
                                    >
                                        <ul class="amenities">
                                            <li>
                                                <i
                                                    :class="
                                                        amenity.amenity.icon
                                                    "
                                                ></i
                                                >{{ amenity.amenity.name }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <div v-if="isVacation" class="floor-plans">
                                <div class="main-title-2">
                                    <h1><span>House Rules</span></h1>
                                </div>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <strong>Checkin Time</strong>
                                            </td>
                                            <td>
                                                {{ property.checkin_time }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Checkout Time</strong>
                                            </td>
                                            <td>
                                                {{ property.checkout_time }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr />

                            <div class="map" v-if="!creatingMap">
                                <div class="main-title-2">
                                    <h1><span>Location</span></h1>
                                </div>
                                <div
                                    id="map"
                                    class="contact-map"
                                    style="
                                        height: 654px;
                                        position: relative;
                                        overflow: hidden;
                                    "
                                ></div>
                            </div>

                            <hr v-if="!creatingMap" />

                            <div
                                class="properties-description mb-40"
                                style="margin-top: 1.3rem"
                            >
                                <div class="main-title-2">
                                    <h1>
                                        <span>Cancellation Policy </span>
                                    </h1>
                                </div>
                                <div class="media">
                                    <div class="media-body">
                                        <p>
                                            <strong>{{
                                                cancellationPolicy.title
                                            }}</strong
                                            >:
                                            {{ cancellationPolicy.description }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-md-offset-6">
                                    <div
                                        class="property-footer"
                                        style="margin-bottom: 30px"
                                    >
                                        <a
                                            :href="bookingRoute"
                                            class="btn button-theme btn-lg pull-right"
                                            style="color: #ffffff"
                                        >
                                            {{ bookingButtonText }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <properties-vacation-sidebar></properties-vacation-sidebar>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PropertiesListSearchComponent from "../PropertiesListSearchComponent";
import PropertyDetailsPageSlider from "./PropertyDetailsPageSlider";
import PropertiesVacationSidebar from "../sidebar/PropertiesVacationSidebar";

export default {
    name: "PropertyDetailsPageMainComponent",
    components: {
        PropertiesVacationSidebar,
        PropertyDetailsPageSlider,
        PropertiesListSearchComponent,
    },
    props: {
        property: {
            required: true,
            type: Object,
        },
    },
    data() {
        return {
            creatingMap: true,
        };
    },
    computed: {
        images() {
            return this.property.images;
        },
        amenities() {
            return this.property.amenities;
        },
        bookingRoute() {
            return this.property.booking_route;
        },
        cancellationPolicy() {
            return this.property.cancellation_policy;
        },
        isVacation() {
            return this.property.type === "vacation";
        },
        costTypeText() {
            return this.isVacation ? "Night" : "Visit";
        },
        bookingButtonText() {
            return this.isVacation ? "Reserve" : "Schedule Visit";
        },
    },
    mounted() {
        this.initMap();
    },
    methods: {
        initMap() {
            const {
                maps_api_key,
                coordinates,
                google_place_id,
            } = this.property;

            if (google_place_id === null) {
                return;
            }

            let script = document.createElement("script");
            script.src = `https://maps.googleapis.com/maps/api/js?key=${maps_api_key}&callback=initMap`;
            script.async = true;

            window.initMap = function () {
                let map = new google.maps.Map(document.getElementById("map"), {
                    center: coordinates,
                    zoom: 15,
                });

                const marker = new google.maps.Marker({
                    position: coordinates,
                    map: map,
                    visible: false,
                });

                const circle = new google.maps.Circle({
                    map: map,
                    radius: 500,
                    fillColor: "#ffb400",
                    strokeColor: "#ffb400",
                });

                circle.bindTo("center", marker, "position");
            };

            document.head.appendChild(script);
            this.creatingMap = false;
        },
    },
};
</script>

<style scoped></style>
