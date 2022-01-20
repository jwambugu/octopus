<template>
    <div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="sidebar-widget">
                <form>
                    <div class="row">
                        <div :class="isVacation ? 'col-md-3' : 'col-md-4'">
                            <div class="form-group">
                                <label for="location"
                                    >Where do you want to stay?</label
                                >
                                <input
                                    type="search"
                                    id="location"
                                    class="form-control"
                                    placeholder="Enter location..."
                                    style="height: 4.5rem"
                                    v-model="filterData.address"
                                    @input="searchingByAddress"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                        <div v-if="isVacation" class="col-md-3">
                            <div class="form-group">
                                <label> Vacation Type </label>
                                <select
                                    class="selectpicker search-fields"
                                    data-live-search="true"
                                    data-live-search-placeholder="Search value"
                                    id="property_types"
                                    v-model="filterData.property_types"
                                >
                                    <option value="">Vacation Type</option>
                                    <option
                                        v-for="(
                                            type, index
                                        ) in filters.propertyTypes"
                                        :key="index"
                                        :value="type.slug"
                                    >
                                        {{ type.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div :class="isVacation ? 'col-md-3' : 'col-md-4'">
                            <div class="form-group">
                                <label>Bedrooms</label>
                                <select
                                    class="selectpicker search-fields"
                                    data-live-search="true"
                                    data-live-search-placeholder="Search value"
                                    id="bedrooms"
                                    v-model="filterData.bedrooms"
                                >
                                    <option value="">Bedrooms</option>
                                    <option
                                        v-for="(
                                            bedroom, index
                                        ) in filters.bedrooms"
                                        :key="index"
                                        :value="bedroom"
                                    >
                                        {{ bedroom }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button
                                type="button"
                                class="button-md button-theme btn-block override-text-transform"
                                style="margin-top: 1.7rem"
                                @click="filterProperties"
                                v-if="!filtering"
                            >
                                Find {{ filterButtonText }}
                            </button>
                            <button
                                type="submit"
                                class="btn button-md btn-block button-theme"
                                style="margin-top: 1.9rem"
                                disabled
                                v-else
                            >
                                <i class="fa fa-spinner fa-spin fa-1x"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PropertiesListSearchComponent",
    props: {
        page: {
            required: true,
            type: Number,
        },
        filters: {
            required: true,
            type: Object,
        },
        queryParams: {
            required: true,
            type: Object,
        },
        mapsKey: {
            required: true,
            type: String,
        },
        propertyTypeData: {
            required: true,
            type: Object,
        },
    },
    data() {
        return {
            filterData: {
                property_types: "",
                bedrooms: "",
                city: "",
                address: "",
            },
            filtering: false,
            showPanel: false,
        };
    },
    computed: {
        isVacation() {
            return this.propertyTypeData.type === "vacation";
        },
        filterButtonText() {
            return this.isVacation ? "Vacations" : "Properties";
        },
    },
    created() {
        const { propertyTypes, bedrooms, city, address } = this.queryParams;

        this.filterData = {
            ...this.filterData,
            property_types: propertyTypes,
            bedrooms,
            city,
            address,
        };

        this.filterProperties();

        let script = document.createElement("script");

        script.src = `https://maps.googleapis.com/maps/api/js?key=${this.mapsKey}&libraries=places`;

        script.async = true;

        document.head.appendChild(script);
    },
    methods: {
        searchingByAddress() {
            const input = document.getElementById("location");

            const options = {
                componentRestrictions: { country: "ke" },
                fields: ["place_id", "geometry", "name"],
                strictBounds: false,
            };

            const autocomplete = new google.maps.places.Autocomplete(
                input,
                options
            );

            autocomplete.addListener("place_changed", () => {
                const place = autocomplete.getPlace();

                this.filterData.address = place.name;
            });
        },
        filterProperties() {
            this.filtering = true;

            const { property_types, bedrooms, city, address } = this.filterData;
            const { type } = this.propertyTypeData;

            this.$store
                .dispatch("GET_PROPERTIES", {
                    page: this.page,
                    property_types,
                    bedrooms,
                    city,
                    address,
                    type,
                })
                .then(() => {
                    this.filtering = false;
                });
        },
    },
};
</script>

<style scoped>
/* Extended Styles */
.pac-icon {
    display: none !important;
}

.pac-item {
    padding: 10px;
    font-size: 16px;
    cursor: pointer;
}

.pac-item:hover {
    background-color: #ececec;
}

.pac-item-query {
    font-size: 16px;
}

.floating-panel-main {
    position: absolute;
    overflow: hidden;
    z-index: 2400;
}

.floating-panel {
    top: 29rem;
    left: 150px;
    width: 100% !important;
    -webkit-transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
    /*-ms-transition: all 0.5s ease-in-out;*/
    -o-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
}

@media (min-width: 320px) and (max-width: 480px) {
    .floating-panel {
        top: 18rem;
        left: 10px;
        width: 100% !important;
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        /*-ms-transition: all 0.5s ease-in-out;*/
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
    }
}

.address-list-item {
    cursor: pointer;
}
</style>
