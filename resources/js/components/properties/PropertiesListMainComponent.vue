<template>
    <div>
        <div class="properties-section content-area">
            <div class="container">
                <div class="row">
                    <properties-list-search-component
                        :filters="filters"
                        :query-params="queryParams"
                        :page="page"
                        :maps-key="mapsKey"
                        :property-type-data="propertyTypeData"
                    ></properties-list-search-component>
                </div>

                <div class="row">
                    <properties-list
                        v-if="!loading"
                        :property-type-data="propertyTypeData"
                    ></properties-list>

                    <div class="col-lg-8 col-md-8 col-xs-12" v-if="loading">
                        <div class="sidebar-widget">
                            <div
                                class="text-center"
                                style="color: #ffb400; padding: 3rem"
                                v-if="!hasError"
                            >
                                <i class="fa fa-spinner fa-spin fa-4x"></i>
                            </div>

                            <div
                                class="override-alert-text-transform alert alert-danger mb-0 text-center"
                                role="alert"
                                v-if="hasError"
                            >
                                <strong>Whoops!</strong> Something went wrong.
                                Please try again.
                            </div>
                        </div>
                    </div>

                    <properties-vacation-sidebar></properties-vacation-sidebar>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PropertiesListSearchComponent from "./PropertiesListSearchComponent";
import PropertiesList from "./PropertiesList";
import { mapGetters } from "vuex";
import PropertiesVacationSidebar from "./sidebar/PropertiesVacationSidebar";

export default {
    name: "PropertiesListMainComponent",
    components: {
        PropertiesVacationSidebar,
        PropertiesList,
        PropertiesListSearchComponent,
    },
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
            hasError: false,
        };
    },
    computed: {
        ...mapGetters({
            loading: "getLoadingProperties",
        }),
    },
};
</script>

<style scoped></style>
