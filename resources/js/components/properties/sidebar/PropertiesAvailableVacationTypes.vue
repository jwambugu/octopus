<template>
    <div>
        <div class="sidebar-widget category-posts" v-if="vacationTypes.length">
            <div class="main-title-2">
                <h1>Available Vacation Types</h1>
            </div>
            <ul class="list-unstyled list-cat" v-if="!loading">
                <li
                    v-for="vacationType in vacationTypes"
                    :key="vacationType.id"
                >
                    <a :href="vacationType._route">
                        {{ vacationType.name }}
                    </a>
                    <span>({{ vacationType.count }})</span>
                </li>
            </ul>
            <div
                class="text-center"
                style="color: #ffb400; padding: 3rem"
                v-else
            >
                <i class="fa fa-spinner fa-spin fa-2x"></i>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "PropertiesAvailableVacationTypes",
    computed: {
        ...mapGetters({
            vacationTypes: "getVacationTypes",
            loading: "getLoadingVacationTypes",
        }),
    },
    created() {
        this.getAvailableVacationTypes();
    },
    methods: {
        getAvailableVacationTypes() {
            this.$store.dispatch("GET_AVAILABLE_VACATION_TYPES");
        },
    },
};
</script>

<style scoped></style>
