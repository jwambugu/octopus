<template>
    <div>
        <div class="sidebar-widget category-posts" v-if="vacationTypes.length">
            <div class="main-title-2">
                <h1>Available Vacation Types</h1>
            </div>
            <ul class="list-unstyled list-cat" v-if="!isLoadingVacationTypes">
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
export default {
    name: "PropertiesAvailableVacationTypes",
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
