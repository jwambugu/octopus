<template>
    <div>
        <div class="sidebar-widget popular-posts" v-if="vacations.length">
            <div class="main-title-2">
                <h1>Popular Vacations</h1>
            </div>

            <a
                v-if="!loading"
                :href="`/vacations/${vacation.slug}`"
                v-for="vacation in vacations"
                :key="vacation.id"
            >
                <div class="media">
                    <div class="media-left">
                        <img
                            class="media-object media-img-constraint img-rounded"
                            :src="vacation.default_image.public_url"
                            :alt="vacation.name"
                        />
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">
                            <a :href="`/vacations/${vacation.slug}`">
                                {{ vacation.name | truncate(30) | ucWords }}
                            </a>
                        </h3>
                        <div class="listing-post-meta">
                            <a :href="`/vacations/${vacation.slug}`"
                                >KES
                                {{ vacation.cost_per_night | numberFormat }}
                            </a>
                        </div>
                    </div>
                </div>
            </a>

            <div
                class="text-center"
                style="color: #ffb400; padding: 3rem"
                v-if="loading"
            >
                <i class="fa fa-spinner fa-spin fa-2x"></i>
            </div>
        </div>
    </div>
</template>

<script>
import PropertiesAvailableVacationTypes from "../sidebar/PropertiesAvailableVacationTypes";
import { mapGetters } from "vuex";

export default {
    name: "PropertiesPopularVacations",
    components: { PropertiesAvailableVacationTypes },
    computed: {
        ...mapGetters({
            vacations: "getPopularVacations",
            loading: "getLoadingPopularVacations",
        }),
    },
    created() {
        this.getPopularVacations();
    },
    methods: {
        getPopularVacations() {
            this.$store.dispatch("GET_POPULAR_VACATIONS");
        },
    },
};
</script>

<style scoped>
.media-img-constraint {
    height: 60px;
    object-fit: cover;
}
</style>
