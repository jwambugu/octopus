<template>
    <div>
        <div class="option-bar">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-sm-5 col-xs-2">
                    <h4>
                        <span class="heading-icon">
                            <i class="fa fa-th-list"></i>
                        </span>
                        <span class="hidden-xs">Vacations</span>
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
                        <button
                            class="change-view-btn active-view-btn"
                            v-if="isListView"
                            @click="changeView(false)"
                        >
                            <i class="fa fa-th-list"></i>
                        </button>
                        <button
                            class="change-view-btn"
                            v-else
                            @click="changeView(true)"
                        >
                            <i class="fa fa-th-large"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "PropertiesFilter",
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
    computed: {
        ...mapGetters({
            isListView: "getIsListView",
        }),
    },
    methods: {
        changeView(isListView) {
            if (isListView === this.isListView) {
                return;
            }

            this.$store.dispatch("SET_IS_LIST_VIEW", {
                isListView: isListView,
            });
        },
        changeSortByOption() {
            this.$store.dispatch("GET_PROPERTIES", {
                sortBy: this.sortBy,
            });
        },
    },
};
</script>

<style scoped></style>
