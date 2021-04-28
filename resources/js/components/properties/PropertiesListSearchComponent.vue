<template>
    <div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="sidebar-widget">
                <form>
                    <div class="row">
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="property_types">
                                    Vacation Type
                                </label>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bedrooms">Bedrooms</label>
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
                                Find Vacations
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
        <div class="row floating-panel-main floating-panel" v-if="showPanel">
            <div class="col-md-3">
                <div class="sidebar-widget category-posts">
                    <ul class="list-unstyled list-cat">
                        <li
                            v-for="(address, index) in addresses"
                            :key="index"
                            class="address-list-item"
                            @click="setAddressToFilterWith(address)"
                        >
                            <a
                                class="address-list-link"
                                @click="setAddressToFilterWith(address)"
                                >{{ address.address }}</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

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
        ...mapGetters({
            addresses: "getVacationAddresses",
        }),
    },
    created() {
        const { propertyTypes, bedrooms, city } = this.queryParams;

        this.filterData = {
            ...this.filterData,
            property_types: propertyTypes,
            bedrooms,
            city,
        };

        this.filterProperties();
    },
    methods: {
        searchingByAddress() {
            const query = this.filterData.address;

            if (query.length < 3) {
                this.showPanel = false;

                return;
            }

            this.showPanel = true;

            this.$store.dispatch("FIND_VACATIONS_BY_ADDRESS", {
                query,
            });
        },
        setAddressToFilterWith(address) {
            this.filterData.address = address.address;

            this.showPanel = false;
        },
        filterProperties() {
            this.filtering = true;

            const { property_types, bedrooms, city, address } = this.filterData;

            this.$store
                .dispatch("GET_PROPERTIES", {
                    page: this.page,
                    property_types,
                    bedrooms,
                    city,
                })
                .then(() => {
                    this.filtering = false;
                });
        },
    },
};
</script>

<style scoped>
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
