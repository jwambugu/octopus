<template>
    <div>
        <div class="properties-details-page content-area">
            <div class="container">
                <div class="row mb-20">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="heading-properties clearfix sidebar-widget">
                            <div class="pull-left">
                                <h3>{{ property.name }}</h3>
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
                                <h5>Per Night</h5>
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

                            <div class="properties-amenities">
                                <div class="main-title-2">
                                    <h1><span>Amenities</span></h1>
                                </div>
                                <div class="row">
                                    <div
                                        class="col-lg-4 col-md-4 col-sm-4 col-xs-12"
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
                                            >Book Now</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <popular-properties-list></popular-properties-list>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PropertiesListSearchComponent from "../PropertiesListSearchComponent";
import PropertyDetailsPageSlider from "./PropertyDetailsPageSlider";
import PopularPropertiesList from "../popular/PopularPropertiesList";

export default {
    name: "PropertiesDetailsPageMainComponent",
    components: {
        PopularPropertiesList,
        PropertyDetailsPageSlider,
        PropertiesListSearchComponent,
    },
    props: {
        property: {
            required: true,
            type: Object,
        },
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
    },
};
</script>

<style scoped></style>
