<template>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="property">
            <div class="property-img">
                <div class="property-tag button alt featured">Featured</div>
                <div class="property-tag button sale">Available</div>
                <div class="property-price">
                    KES {{ property.cost_per_night | numberFormat }}
                </div>

                <img :src="image" :alt="property.slug" class="img-responsive" />

                <div class="property-overlay">
                    <a :href="propertyLink" class="overlay-link">
                        <i class="fa fa-link"></i>
                    </a>
                </div>
            </div>

            <div class="property-content">
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

                <div class="property-footer" style="margin-bottom: 30px">
                    <span class="left"> </span>
                    <span class="right">
                        <a
                            :href="propertyLink"
                            class="btn button-theme btn-sm"
                            style="color: #ffffff"
                            >Book Now</a
                        >
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PropertyGridCard",
    props: {
        property: {
            required: true,
            type: Object,
        },
    },
    computed: {
        propertyLink() {
            return "";
        },
        amenities() {
            return this.property.amenities.slice(0, 3);
        },
        images() {
            return this.property.images;
        },
        image() {
            return this.images[0].public_url;
        },
    },
};
</script>

<style scoped></style>
