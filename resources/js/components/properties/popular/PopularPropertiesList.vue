<template>
    <div>
        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="sidebar-widget popular-posts">
                <div class="main-title-2">
                    <h1>Popular Vacations</h1>
                </div>
                <div class="media" v-for="n in 3">
                    <div class="media-left">
                        <img
                            class="media-object"
                            src="img/properties/small-properties-1.jpg"
                            alt="small-properties-1"
                        />
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">
                            <a href="properties-details.html"
                                >Sweet Family Home</a
                            >
                        </h3>
                        <div class="listing-post-meta">
                            Aug 18, 2020 | <a href="#">$485,00</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PropertiesAvailableVacationTypes from "../sidebar/PropertiesAvailableVacationTypes";

export default {
    name: "PopularPropertiesList",
    components: { PropertiesAvailableVacationTypes },
    props: {
        vacationTypes: {
            required: true,
            type: Array,
        },
    },
};
</script>

<style scoped></style>
