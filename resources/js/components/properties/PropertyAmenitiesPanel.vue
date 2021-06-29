<template>
    <div class="panel-box" style="margin-top: 0">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="">
                        <div class="panel-div">
                            <div class="panel-group mb-0" role="tablist">
                                <div class="panel panel-default">
                                    <div
                                        class="panel-heading active"
                                        role="tab"
                                        id="heading1"
                                    >
                                        <h4 class="panel-title">
                                            <a
                                                class="collapsed"
                                                role="button"
                                                data-toggle="collapse"
                                                data-parent="#accordion"
                                                :href="'#' + property.id"
                                                aria-expanded="false"
                                            >
                                                <i class="fa"></i>Amenities
                                            </a>
                                        </h4>
                                    </div>
                                    <div
                                        :id="property.id"
                                        class="panel-collapse collapse"
                                        role="tabpanel"
                                        aria-expanded="false"
                                        style="height: 0; margin-top: -30px"
                                    >
                                        <div
                                            class="panel-body panel-body-2"
                                            style="margin-bottom: -30px"
                                        >
                                            <div
                                                class="sidebar-widget category-posts"
                                            >
                                                <ul
                                                    class="list-unstyled list-cat"
                                                >
                                                    <li
                                                        v-for="(
                                                            amenity, index
                                                        ) in amenities"
                                                        :key="index"
                                                    >
                                                        <a>
                                                            {{
                                                                amenity.amenity
                                                                    .name
                                                            }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PropertyAmenitiesPanel",
    props: {
        property: {
            required: true,
            type: Object,
        },
        amenities: {
            type: Array,
            required: true,
        },
    },
};
</script>

<style scoped></style>
