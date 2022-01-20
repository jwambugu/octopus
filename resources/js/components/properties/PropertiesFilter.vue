<template>
    <div>
        <div class="option-bar">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-sm-5 col-xs-2">
                    <h4>
                        <span class="heading-icon">
                            <i class="fa fa-th-list"></i>
                        </span>
                        <span class="hidden-xs text-capitalize">
                            {{ propertyTypeData.name }}
                        </span>
                    </h4>
                </div>
                <div class="col-lg-6 col-md-7 col-sm-7 col-xs-10 cod-pad">
                    <div class="sorting-options">
                        <label>
                            <select
                                class="sorting"
                                v-model="sortBy"
                                @change="changeSortByOption"
                            >
                                <option value="">--Sort By--</option>
                                <option
                                    v-for="(sortOption, index) in sortOptions"
                                    :key="index"
                                    :value="sortOption.key"
                                >
                                    {{ sortOption.value }}
                                </option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PropertiesFilter",
    props: {
        propertyTypeData: {
            required: true,
            type: Object,
        },
    },
    data() {
        return {
            sortOptions: [
                {
                    key: "_price_asc",
                    value: "Cost Per Night (Low To High)",
                },
                {
                    key: "_price_desc",
                    value: "Cost Per Night (High To Low)",
                },
                {
                    key: "_time_added_asc",
                    value: "Old to New",
                },
                {
                    key: "_time_added_desc",
                    value: "New to Old",
                },
            ],
            sortBy: "",
        };
    },
    methods: {
        changeSortByOption() {
            const { type } = this.propertyTypeData;

            this.$store.dispatch("GET_PROPERTIES", {
                sortBy: this.sortBy,
                type,
            });
        },
    },
};
</script>

<style scoped></style>
