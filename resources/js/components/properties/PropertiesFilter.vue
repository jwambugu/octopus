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
                        <a href="" class="change-view-btn active-view-btn"
                            ><i class="fa fa-th-list"></i
                        ></a>
                        <!--                        <a-->
                        <!--                            href="properties-grid-rightside.html"-->
                        <!--                            class="change-view-btn"-->
                        <!--                        ><i class="fa fa-th-large"></i-->
                        <!--                        ></a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PropertiesFilter",
};
</script>

<style scoped></style>
