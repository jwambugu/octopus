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
                    <popular-properties-list></popular-properties-list>
                </div>
                <div class="row" v-if="loading">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="sidebar-widget">
                            <div
                                class="text-center"
                                style="color: #96c51e"
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

export default {
    name: "PropertiesListMainComponent",
    components: {
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
        }),
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
    },
};
</script>

<style scoped></style>
