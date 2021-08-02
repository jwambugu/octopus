<template>
    <div class="properties-detail-slider simple-slider mb-40">
        <div id="carousel-custom" class="carousel slide" data-ride="carousel">
            <div class="carousel-outer">
                <div class="carousel-inner">
                    <div
                        class="item"
                        v-for="(image, index) in images"
                        :key="index"
                        :class="{ active: index === 0 }"
                        loading="lazy"
                    >
                        <img
                            :src="image.public_url"
                            class="img-rounded thumb-preview thumb-preview-img-constraint"
                            :alt="slug"
                        />
                    </div>
                </div>

                <a
                    class="left carousel-control"
                    href="#carousel-custom"
                    role="button"
                    data-slide="prev"
                >
                    <span
                        class="slider-mover-left no-bg t-slider-r pojison"
                        aria-hidden="true"
                    >
                        <i class="fa fa-angle-left"></i>
                    </span>
                    <span class="sr-only">Previous</span>
                </a>
                <a
                    class="right carousel-control"
                    href="#carousel-custom"
                    role="button"
                    data-slide="next"
                >
                    <span
                        class="slider-mover-right no-bg t-slider-l pojison"
                        aria-hidden="true"
                    >
                        <i class="fa fa-angle-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <hr />

            <ol class="carousel-indicators thumbs visible-lg visible-md">
                <li
                    data-target="#carousel-custom"
                    :data-slide-to="index"
                    class=""
                    v-for="(image, index) in images"
                    :key="index"
                >
                    <img
                        :src="image.public_url"
                        class="thumb-preview slider-preview-img-constraint"
                        :alt="slug"
                    />
                </li>
            </ol>
        </div>
    </div>
</template>

<script>
export default {
    name: "PropertyDetailsPageSlider",
    props: {
        images: {
            required: true,
            type: Array,
        },
        slug: {
            required: true,
            type: String,
        },
    },
};
</script>

<style scoped>
.thumb-preview-img-constraint {
    max-height: 400px;
    object-fit: cover;
}

.slider-preview-img-constraint {
    height: 80px;
    object-fit: cover;
}
</style>
