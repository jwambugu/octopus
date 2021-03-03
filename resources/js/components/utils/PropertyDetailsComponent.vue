<template>
    <div>
        <div class="heading-properties clearfix sidebar-widget">
            <div class="pull-left">
                <h3>{{ property.name }}</h3>
                <p>
                    <i class="fa fa-map-marker"></i>
                    {{ property.address }}
                </p>
            </div>
            <div class="pull-right">
                <h3>
                    <span
                        >KES {{ property.cost_per_night | numberFormat }}</span
                    >
                </h3>
                <h5>Per Night</h5>
            </div>
        </div>

        <div class="panel-box">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-body">
                    <div class="tab-content">
                        <div
                            class="tab-pane fade active in"
                            id="generalInformation"
                        >
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
                                                    href="#collapse1"
                                                    aria-expanded="false"
                                                >
                                                    <i class="fa"></i>
                                                    Amenities
                                                </a>
                                            </h4>
                                        </div>
                                        <div
                                            id="collapse1"
                                            class="panel-collapse collapse"
                                            role="tabpanel"
                                            aria-expanded="false"
                                        >
                                            <div
                                                class="panel-body panel-body-2"
                                            >
                                                <div
                                                    class="sidebar-widget mb-40"
                                                >
                                                    <div
                                                        class="properties-amenities"
                                                    >
                                                        <div class="row">
                                                            <div
                                                                class="col-lg-4 col-md-4 col-sm-4 col-xs-12"
                                                                v-for="(
                                                                    amenity,
                                                                    index
                                                                ) in amenities"
                                                                :key="index"
                                                            >
                                                                <ul
                                                                    class="amenities"
                                                                >
                                                                    <li>
                                                                        <i
                                                                            :class="
                                                                                amenity
                                                                                    .amenity
                                                                                    .icon
                                                                            "
                                                                        ></i
                                                                        >{{
                                                                            amenity
                                                                                .amenity
                                                                                .name
                                                                        }}
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PropertyDetailsComponent",
    props: {
        property: {
            required: true,
            type: Object,
        },
    },
    computed: {
        amenities() {
            return this.property.amenities;
        },
    },
};
</script>

<style scoped></style>
