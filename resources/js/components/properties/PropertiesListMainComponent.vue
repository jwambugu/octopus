<template>
    <div>
        <div class="properties-section-body content-area">
            <div class="container">
                <div class="row">
                    <properties-list-search-component
                        :filters="filters"
                        :page="page"
                    ></properties-list-search-component>
                </div>
                <div class="row">
                    <properties-list></properties-list>
                    <popular-properties-list></popular-properties-list>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PropertiesListSearchComponent from "./PropertiesListSearchComponent";
import PropertiesList from "./PropertiesList";
import PopularPropertiesList from "./popular/PopularPropertiesList";

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
    },
    created() {
        this.getProperties();
    },
    methods: {
        getProperties() {
            this.$store.dispatch("GET_PROPERTIES", {
                page: this.page,
            });
        },
    },
};
</script>

<style scoped></style>
