<template>
    <div>
        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="sidebar-widget">
                <div class="main-title-2">
                    <h1>Advanced Search</h1>
                </div>
                <form method="GET">
                    <div class="form-group">
                        <select
                            class="selectpicker search-fields"
                            name="property-status"
                            data-live-search="true"
                            data-live-search-placeholder="Search value"
                        >
                            <option>Property Status</option>
                            <option>For Sale</option>
                            <option>For Rent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select
                            class="selectpicker search-fields"
                            name="location"
                            data-live-search="true"
                            data-live-search-placeholder="Search value"
                        >
                            <option>Location</option>
                            <option>United States</option>
                            <option>United Kingdom</option>
                            <option>American Samoa</option>
                            <option>Belgium</option>
                            <option>Cameroon</option>
                            <option>Canada</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select
                            class="selectpicker search-fields"
                            name="property-types"
                            data-live-search="true"
                            data-live-search-placeholder="Search value"
                        >
                            <option>Property Types</option>
                            <option>Residential</option>
                            <option>Commercial</option>
                            <option>Land</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select
                            class="selectpicker search-fields"
                            name="area-from"
                            data-live-search="true"
                            data-live-search-placeholder="Search value"
                        >
                            <option>Area From</option>
                            <option>1000</option>
                            <option>800</option>
                            <option>600</option>
                            <option>400</option>
                            <option>200</option>
                            <option>100</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <select
                                    class="selectpicker search-fields"
                                    name="bedrooms"
                                >
                                    <option>Bedrooms</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <select
                                    class="selectpicker search-fields"
                                    name="bathroom"
                                >
                                    <option>Bathroom</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <select
                                    class="selectpicker search-fields"
                                    name="balcony"
                                >
                                    <option>Balcony</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <select
                                    class="selectpicker search-fields"
                                    data-live-search="true"
                                    name="garage"
                                >
                                    <option>Garage</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="range-slider">
                        <label>Area</label>
                        <div
                            data-min="0"
                            data-max="10000"
                            data-unit="Sq ft"
                            data-min-name="min_area"
                            data-max-name="max_area"
                            class="range-slider-ui ui-slider"
                            aria-disabled="false"
                        ></div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="range-slider">
                        <label>Price</label>
                        <div
                            data-min="0"
                            data-max="150000"
                            data-unit="USD"
                            data-min-name="min_price"
                            data-max-name="max_price"
                            class="range-slider-ui ui-slider"
                            aria-disabled="false"
                        ></div>
                        <div class="clearfix"></div>
                    </div>

                    <a
                        class="show-more-options"
                        data-toggle="collapse"
                        data-target="#options-content"
                    >
                        <i class="fa fa-plus-circle"></i> Show More Options
                    </a>
                    <div id="options-content" class="collapse">
                        <label class="margin-t-10">Features</label>
                        <div class="checkbox checkbox-theme checkbox-circle">
                            <input id="checkbox1" type="checkbox" />
                            <label for="checkbox1"> Free Parking </label>
                        </div>
                        <div class="checkbox checkbox-theme checkbox-circle">
                            <input id="checkbox2" type="checkbox" />
                            <label for="checkbox2"> Air Condition </label>
                        </div>
                        <div class="checkbox checkbox-theme checkbox-circle">
                            <input id="checkbox3" type="checkbox" />
                            <label for="checkbox3"> Places to seat </label>
                        </div>
                        <div class="checkbox checkbox-theme checkbox-circle">
                            <input id="checkbox4" type="checkbox" />
                            <label for="checkbox4"> Swimming Pool </label>
                        </div>
                        <div class="checkbox checkbox-theme checkbox-circle">
                            <input id="checkbox5" type="checkbox" />
                            <label for="checkbox5"> Laundry Room </label>
                        </div>
                        <div class="checkbox checkbox-theme checkbox-circle">
                            <input id="checkbox6" type="checkbox" />
                            <label for="checkbox6"> Window Covering </label>
                        </div>
                        <div class="checkbox checkbox-theme checkbox-circle">
                            <input id="checkbox7" type="checkbox" />
                            <label for="checkbox7"> Central Heating </label>
                        </div>
                        <div class="checkbox checkbox-theme checkbox-circle">
                            <input id="checkbox8" type="checkbox" />
                            <label for="checkbox8"> Alarm </label>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <button class="search-button">Search</button>
                    </div>
                </form>
            </div>

            <div class="sidebar-widget category-posts">
                <div class="main-title-2">
                    <h1>Popular Category</h1>
                </div>
                <ul class="list-unstyled list-cat">
                    <li>
                        <a href="#">Single Family </a>
                        <span>(45) </span>
                    </li>
                    <li>
                        <a href="#">Apartment </a>
                        <span>(21) </span>
                    </li>
                    <li><a href="#">Condo </a> <span>(23) </span></li>
                    <li>
                        <a href="#">Multi Family </a>
                        <span>(19) </span>
                    </li>
                    <li><a href="#">Villa </a> <span>(19) </span></li>
                    <li><a href="#">Other </a> <span>(22) </span></li>
                </ul>
            </div>

            <div class="sidebar-widget popular-posts">
                <div class="main-title-2">
                    <h1>Recent Properties</h1>
                </div>
            </div>

            <div class="sidebar-widget helping-box clearfix">
                <div class="main-title-2">
                    <h1>Help Center</h1>
                </div>
                <div class="helping-center">
                    <div class="icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <h4>Address</h4>
                    <p>123 Kathal St. Tampa City,</p>
                </div>
                <div class="helping-center">
                    <div class="icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <h4>Phone</h4>
                    <p>
                        <a href="tel:+55-417-634-7071">+55 417 634 7071</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PropertiesListSearchComponent",
};
</script>

<style scoped></style>
