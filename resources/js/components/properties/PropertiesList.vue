<template>
    <div>
        <div class="col-lg-8 col-md-8 col-xs-12">
            <properties-filter></properties-filter>

            <div class="clearfix"></div>

            <property-list-card
                v-for="(property, index) in properties"
                :property="property"
                :key="index"
            ></property-list-card>

            <div class="text-center">
                <span v-html="links"></span>
            </div>
        </div>
    </div>
</template>

<script>
import PropertiesFilter from "./PropertiesFilter";
import PropertyListCard from "./PropertyListCard";
import { mapGetters } from "vuex";

export default {
    name: "PropertiesList",
    components: {
        PropertyListCard,
        PropertiesFilter,
    },
    computed: {
        ...mapGetters({
            links: "getPaginationLinks",
            properties: "getProperties",
        }),
    },
};
</script>

<style scoped></style>
