<template>
    <div>
        <div class="property clearfix wow fadeInUp delay-03s">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-pad">
                <div class="property-img">
                    <div class="property-tag button alt featured">Featured</div>
                    <div class="property-tag button sale">Available</div>
                    <div class="property-price">
                        KES {{ property.cost_per_night | numberFormat }}
                    </div>
                    <img
                        :src="image"
                        alt="fp-list"
                        class="img-responsive hp-1"
                    />
                    <div class="property-overlay">
                        <a :href="propertyLink" class="overlay-link">
                            <i class="fa fa-link"></i>
                        </a>
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

                <!--                <div class="property-footer" style="margin-bottom: 30px">-->
                <!--                    <span class="left"> </span>-->
                <!--                    <span class="right">-->
                <!--                        <a-->
                <!--                            :href="propertyLink"-->
                <!--                            class="btn button-theme btn-sm"-->
                <!--                            style="color: #ffffff"-->
                <!--                            >Book Now</a-->
                <!--                        >-->
                <!--                    </span>-->
                <!--                </div>-->
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
            return `/properties/${this.property.slug}`;
        },
        amenities() {
            return this.property.amenities;
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
