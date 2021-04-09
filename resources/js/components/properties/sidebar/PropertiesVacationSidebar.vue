<template>
    <div>
        <div class="col-lg-4 col-md-4 col-xs-12">
            <properties-available-vacation-types
                :vacation-types="vacationTypes"
                :is-loading-vacation-types="isLoadingVacationTypes"
            ></properties-available-vacation-types>
        </div>
    </div>
</template>

<script>
import PropertiesAvailableVacationTypes from "./PropertiesAvailableVacationTypes";

export default {
    name: "PropertiesVacationSidebar",
    components: { PropertiesAvailableVacationTypes },
    props: {
        vacationTypes: {
            required: true,
            type: Array,
        },
        isLoadingVacationTypes: {
            type: Boolean,
            required: true,
        },
    },
};
</script>

<style scoped></style>
