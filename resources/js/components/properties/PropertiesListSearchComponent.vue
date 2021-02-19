<template>
    <div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="sidebar-widget">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="property_types">
                                    Property Type
                                </label>
                                <select
                                    class="selectpicker search-fields"
                                    data-live-search="true"
                                    data-live-search-placeholder="Search value"
                                    id="property_types"
                                    v-model="filterData.propertyTypes"
                                >
                                    <option value="">Property Types</option>
                                    <option
                                        v-for="(
                                            type, index
                                        ) in filters.propertyTypes"
                                        :key="index"
                                        :value="type.id"
                                    >
                                        {{ type.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
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
                                        :value="city.id"
                                    >
                                        {{ city.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
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
                    </div>

                    <div class="form-group mb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <button
                                    type="button"
                                    class="button-md button-theme pull-right"
                                    @click="filterProperties"
                                >
                                    Filter Properties
                                </button>
                            </div>
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
    },
    data() {
        return {
            filterData: {
                propertyTypes: "",
                bedrooms: "",
                city: "",
            },
        };
    },
    methods: {
        filterProperties() {
            const { propertyTypes, bedrooms, city } = this.filterData;

            this.$store.dispatch("GET_PROPERTIES", {
                page: this.page,
                propertyTypes,
                bedrooms,
                city,
            });
        },
    },
};
</script>

<style scoped></style>
