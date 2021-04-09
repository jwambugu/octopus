<template>
    <div>
        <div
            :class="
                isListView ? 'properties-section-body' : 'properties-section'
            "
            class="content-area"
        >
            <div class="container">
                <div class="row">
                    <properties-list-search-component
                        :filters="filters"
                        :query-params="queryParams"
                        :page="page"
                    ></properties-list-search-component>
                </div>

                <div class="row" v-if="!loading">
                    <properties-list></properties-list>

                    <properties-vacation-sidebar
                        :vacation-types="vacationTypes"
                        :is-loading-vacation-types="isLoadingVacationTypes"
                    ></properties-vacation-sidebar>
                </div>
                <div class="row" v-if="loading">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="sidebar-widget">
                            <div
                                class="text-center"
                                style="color: #ffb400"
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PropertiesListSearchComponent from "./PropertiesListSearchComponent";
import PropertiesList from "./PropertiesList";
import PopularPropertiesList from "./popular/PopularPropertiesList";
import { mapGetters } from "vuex";
import PropertiesVacationSidebar from "./sidebar/PropertiesVacationSidebar";

export default {
    name: "PropertiesListMainComponent",
    components: {
        PropertiesVacationSidebar,
        PopularPropertiesList,
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
    },
    data() {
        return {
            hasError: false,
        };
    },
    computed: {
        ...mapGetters({
            loading: "getLoadingProperties",
            isListView: "getIsListView",
            vacationTypes: "getVacationTypes",
            isLoadingVacationTypes: "getLoadingVacationTypes",
        }),
    },
    created() {
        this.getAvailableVacationTypes();
    },
    methods: {
        getProperties() {
            this.$store
                .dispatch("GET_PROPERTIES", {
                    page: this.page,
                })
                .catch(() => {
                    this.hasError = true;
                });
        },
        getAvailableVacationTypes() {
            this.$store.dispatch("GET_AVAILABLE_VACATION_TYPES");
            console.log(123);
        },
    },
};
</script>

<style scoped></style>
