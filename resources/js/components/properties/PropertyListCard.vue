<template>
    <div>
        <div class="property clearfix wow fadeInUp delay-03s">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-pad">
                <div class="property-img">
                    <div class="property-tag button alt featured">Featured</div>
                    <div class="property-tag button sale">For Sale</div>
                    <div class="property-price">
                        KES {{ property.cost_per_night | numberFormat }}
                    </div>
                    <img
                        src="img/properties/properties-list-1.jpg"
                        alt="fp-list"
                        class="img-responsive hp-1"
                    />
                    <div class="property-overlay">
                        <a href="properties-details.html" class="overlay-link">
                            <i class="fa fa-link"></i>
                        </a>
                        <a
                            class="overlay-link property-video"
                            title="Lexus GS F"
                        >
                            <i class="fa fa-video-camera"></i>
                        </a>
                        <div class="property-magnify-gallery">
                            <a
                                href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-1.jpg"
                                class="overlay-link"
                            >
                                <i class="fa fa-expand"></i>
                            </a>
                            <a
                                href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-2.jpg"
                                class="hidden"
                            ></a>
                            <a
                                href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-3.jpg"
                                class="hidden"
                            ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 property-content">
                <div class="info">
                    <h1 class="title">
                        <a :href="propertyLink">
                            {{ property.name }}
                        </a>
                    </h1>

                    <h3 class="property-address">
                        <a :href="propertyLink">
                            <i class="fa fa-map-marker"></i>
                            {{ property.address }}
                        </a>
                    </h3>

                    <ul class="facilities-list clearfix">
                        <li v-for="(amenity, index) in amenities" :key="index">
                            <i :class="amenity.amenity.icon"></i>
                            <span>{{ amenity.amenity.name }}</span>
                        </li>
                    </ul>
                </div>
                <div class="property-footer">
                    <span class="left"> </span>
                    <span class="right">
                        <a href="" class="btn button-theme btn-sm">Book Now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PropertyListCard",
    props: {
        property: {
            type: Object,
            required: true,
        },
    },
    computed: {
        propertyLink() {
            return "";
        },
        amenities() {
            return this.property.amenities;
        },
    },
};
</script>

<style scoped></style>
