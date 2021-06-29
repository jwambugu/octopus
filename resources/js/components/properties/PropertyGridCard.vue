<template>
    <div
        class="col-lg-6 col-md-6 col-sm-6 col-xs-12 property-details-card-link"
        @click="viewProperty"
    >
        <div class="property">
            <div class="property-img">
                <div class="property-tag button alt featured">Featured</div>
                <div class="property-tag button sale">Available</div>
                <div class="property-price">
                    KES {{ property.cost_per_night | numberFormat }}
                </div>

                <img
                    :src="image"
                    :alt="property.slug"
                    class="img-responsive"
                    style="max-height: 300px"
                />

                <div class="property-overlay">
                    <a :href="propertyLink" class="overlay-link">
                        <i class="fa fa-link"></i>
                    </a>
                </div>
            </div>

            <div class="property-content">
                <div class="info mb-3">
                    <h1 class="title title-height">
                        <a :href="propertyLink">
                            {{ property.name | ucWords }}
                        </a>
                    </h1>
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
            return `/vacations/${this.property.slug}`;
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
    methods: {
        viewProperty() {
            location.href = this.propertyLink;
        },
    },
};
</script>

<style scoped>
.title-height {
    height: 2rem;
}

.property-address-height {
    height: 2rem;
    padding-top: 2rem;
}

.facilities-list-padding {
    padding-top: 2rem;
}

.property-details-card-link:hover {
    cursor: pointer;
}
</style>
