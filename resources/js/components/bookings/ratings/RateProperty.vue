<template>
    <div style="padding-top: 1.6rem">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <property-details-component
                        :property="property"
                    ></property-details-component>

                    <div
                        class="alert alert-success text-center override-alert-text-transform"
                        role="alert"
                        v-if="successMessage"
                    >
                        {{ successMessage }}
                    </div>

                    <div
                        class="alert alert-danger text-center override-alert-text-transform"
                        role="alert"
                        v-if="errorMessage"
                    >
                        {{ errorMessage }}
                    </div>

                    <div
                        class="heading-properties clearfix sidebar-widget submit-address"
                        style="margin-top: 1.9rem"
                    >
                        <form @submit.prevent="submitRatings">
                            <div class="main-title-2">
                                <h1><span>Rating</span> Criteria</h1>
                            </div>

                            <div class="row mb-30">
                                <div class="col-md-12">
                                    <div
                                        class="form-group"
                                        v-for="(
                                            rating, index
                                        ) in propertyRatings"
                                    >
                                        <h4 :for="'rating_' + index">
                                            <strong>{{ rating.title }}</strong>
                                        </h4>

                                        <p>{{ rating.description }}</p>

                                        <star-rating
                                            :star-size="25"
                                            :increment="0.5"
                                            active-color="#96C51E"
                                            v-model="rating.rating"
                                            v-if="!rating.isBoolean"
                                            :show-rating="false"
                                            style="padding-top: 1rem"
                                        />

                                        <div v-else style="padding-top: 1rem">
                                            <input
                                                :id="'rating_yes_' + index"
                                                type="radio"
                                                v-model="rating.rating"
                                                :value="1"
                                                required
                                            />

                                            <label :for="'rating_yes_' + index">
                                                Yes
                                            </label>

                                            <input
                                                :id="'rating_no_' + index"
                                                type="radio"
                                                v-model="rating.rating"
                                                :value="0"
                                                style="
                                                    color: #96c51e;
                                                    margin-left: 1rem;
                                                "
                                                required
                                            />

                                            <label :for="'rating_no_' + index">
                                                No
                                            </label>
                                        </div>
                                        <hr />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button
                                        type="submit"
                                        class="btn button-md button-theme"
                                    >
                                        Submit Ratings
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PropertyDetailsComponent from "../../utils/PropertyDetailsComponent";
import StarRating from "vue-star-rating";

export default {
    name: "RateProperty",
    components: { PropertyDetailsComponent, StarRating },
    props: {
        property: {
            required: true,
            type: Object,
        },
        ratings: {
            required: true,
            type: Array,
        },
        uuid: {
            required: true,
            type: String,
        },
    },
    data() {
        return {
            propertyRatings: [],
            successMessage: "",
            errorMessage: "",
        };
    },
    mounted() {
        this.createRatings();
    },
    methods: {
        createRatings() {
            this.propertyRatings = this.ratings.map((rating) => {
                return {
                    id: rating.id,
                    rating: 1,
                    title: rating.title,
                    description: rating.description,
                    isBoolean: rating.is_boolean,
                };
            });
        },
        submitRatings() {
            this.$store
                .dispatch("RATE_PROPERTY", {
                    ratings: this.propertyRatings,
                    uuid: this.uuid,
                })
                .then(({ message }) => {
                    this.successMessage = message;

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                })
                .catch(() => {
                    this.errorMessage =
                        "Sorry. Something went wrong. Please try again.";
                });
        },
    },
};
</script>

<style scoped></style>
