<template>
    <div>
        <div class="option-bar">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-sm-5 col-xs-2">
                    <h4>
                        <span class="heading-icon">
                            <i class="fa fa-th-list"></i>
                        </span>
                        <span class="hidden-xs">Available Properties</span>
                    </h4>
                </div>
                <div class="col-lg-6 col-md-7 col-sm-7 col-xs-10 cod-pad">
                    <div class="sorting-options">
                        <label>
                            <select class="sorting">
                                <option>New To Old</option>
                                <option>Old To New</option>
                                <option>Properties (High To Low)</option>
                                <option>Properties (Low To High)</option>
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
    },
};
</script>

<style scoped></style>
