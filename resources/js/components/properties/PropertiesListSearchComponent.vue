<template>
    <div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="sidebar-widget">
                <form>
                    <div class="row">
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
                                <label for="city">City</label>
                                <select
                                    class="selectpicker search-fields"
                                    data-live-search="true"
                                    data-live-search-placeholder="Search value"
                                    id="city"
                                    v-model="filterData.city"
                                >
                                    <option value="">Locations</option>
                                    <option
                                        v-for="(city, index) in filters.cities"
                                        :key="index"
                                        :value="city.slug"
                                    >
                                        {{ city.name }}
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
                                Filter Vacations
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
    },
    data() {
        return {
            filterData: {
                property_types: "",
                bedrooms: "",
                city: "",
            },
            filtering: false,
        };
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
        filterProperties() {
            this.filtering = true;

            const { property_types, bedrooms, city } = this.filterData;

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

<style scoped></style>
