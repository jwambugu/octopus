<template>
    <div>
        <div class="col-lg-4 col-md-4 col-xs-12">
            <properties-available-vacation-types></properties-available-vacation-types>

            <properties-popular-vacations></properties-popular-vacations>
        </div>
    </div>
</template>

<script>
import PropertiesAvailableVacationTypes from "./PropertiesAvailableVacationTypes";
import PropertiesPopularVacations from "./PropertiesPopularVacations";

export default {
    name: "PropertiesVacationSidebar",
    components: {
        PropertiesPopularVacations,
        PropertiesAvailableVacationTypes,
    },
};
</script>

<style scoped></style>
