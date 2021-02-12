<template>
    <div>
        <div class="properties-section-body content-area">
            <div class="container">
                <div class="row">
                    <properties-list></properties-list>
                    <properties-list-search-component></properties-list-search-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PropertiesListSearchComponent from "./PropertiesListSearchComponent";
import PropertiesList from "./PropertiesList";

export default {
    name: "PropertiesListMainComponent",
    components: {
        PropertiesList,
        PropertiesListSearchComponent,
    },
    props: {
        page: {
            required: true,
            type: Number,
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
