<template>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="my-address">
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

            <div class="main-title-2">
                <h1>Update Profile</h1>
            </div>

            <form @submit.prevent="updateProfile">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        id="name"
                        type="text"
                        class="input-text"
                        v-model="profile.name"
                    />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        class="input-text"
                        v-model="profile.email"
                    />
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input
                        id="phone_number"
                        type="text"
                        class="input-text"
                        v-model="profile.phone_number"
                    />
                </div>
                <div class="form-group">
                    <button
                        class="btn button-md button-theme btn-block"
                        v-if="!updatingProfile"
                    >
                        Update Profile
                    </button>
                    <button
                        type="submit"
                        class="btn button-md btn-block button-theme"
                        disabled
                        v-else
                    >
                        <i class="fa fa-spinner fa-spin fa-1x"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditProfile",
    props: {
        user: {
            required: true,
            type: Object,
        },
    },
    data() {
        return {
            profile: {
                name: this.user.name,
                email: this.user.email,
                phone_number: this.user.phone_number,
            },
            updatingProfile: false,
            errorMessage: "",
            successMessage: "",
        };
    },
    methods: {
        updateProfile() {
            this.updatingProfile = true;
            this.errorMessage = "";

            this.$store
                .dispatch("UPDATE_PROFILE", this.profile)
                .then(({ message }) => {
                    this.successMessage = message;
                    this.updatingProfile = false;

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                })
                .catch((error) => {
                    this.updatingProfile = false;
                    this.errorMessage = error;
                });
        },
    },
};
</script>

<style scoped></style>
