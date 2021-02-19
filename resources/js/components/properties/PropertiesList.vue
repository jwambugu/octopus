<template>
    <div>
        <div class="col-lg-8 col-md-8 col-xs-12">
            <properties-filter></properties-filter>

            <div class="clearfix"></div>

            <div v-if="hasProperties">
                <!--     List view       -->
                <property-list-card
                    v-for="(property, index) in properties"
                    :property="property"
                    :key="index"
                    v-if="isListView"
                ></property-list-card>

                <!--     Grid view       -->
                <div class="row" v-if="!isListView">
                    <property-grid-card
                        v-for="(property, index) in properties"
                        :key="index"
                        :property="property"
                    ></property-grid-card>
                </div>

                <div class="text-center">
                    <span v-html="links"></span>
                </div>
            </div>

            <div v-else>
                <div
                    class="alert alert-info text-center override-alert-text-transform"
                    role="alert"
                >
                    Sorry. No properties were found. If you were filtering,
                    please adjust your search filters.
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PropertiesFilter from "./PropertiesFilter";
import PropertyListCard from "./PropertyListCard";
import { mapGetters } from "vuex";
import PropertyGridCard from "./PropertyGridCard";

export default {
    name: "PropertiesList",
    components: {
        PropertyGridCard,
        PropertyListCard,
        PropertiesFilter,
    },
    computed: {
        ...mapGetters({
            links: "getPaginationLinks",
            properties: "getProperties",
            isListView: "getIsListView",
        }),
        hasProperties() {
            return this.properties.length !== 0;
        },
    },
};
</script>

<style scoped></style>
