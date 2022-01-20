<template>
    <div
        class="col-lg-6 col-md-6 col-sm-6 col-xs-12 property-details-card-link"
        @click="viewProperty"
    >
        <div class="property">
            <div class="property-img">
                <!--                <div class="property-tag button alt featured">Featured</div>-->
                <div class="property-tag button sale">{{ property.type }}</div>
                <div class="property-price">
                    KES {{ property.cost_per_night | numberFormat }}
                </div>

                <img
                    :src="image"
                    :alt="property.slug"
                    class="img-rounded img-responsive constrained-property-img"
                />

                <div class="property-overlay img-rounded">
                    <a :href="propertyLink" class="overlay-link">
                        <i class="fa fa-link"></i>
                    </a>
                </div>
            </div>

            <div class="property-content property-content-info">
                <div class="info">
                    <h3 class="title title-height">
                        <a :href="propertyLink">
                            {{ property.name | ucWords }}
                        </a>
                    </h3>
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
            const type =
                this.property.type === "vacation" ? "vacations" : "properties";

            return `/${type}/${this.property.slug}`;
        },
        image() {
            return this.property.default_image.public_url;
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

.constrained-property-img {
    object-fit: fill !important;
    max-height: 230px !important;
}

.property-content-info {
    margin-bottom: 2rem;
}
</style>
