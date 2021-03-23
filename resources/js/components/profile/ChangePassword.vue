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
                <h1>Change Account Password</h1>
            </div>

            <form @submit.prevent="changePassword">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input
                        id="current_password"
                        type="password"
                        class="input-text"
                        v-model="credentials.current_password"
                        required
                    />
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input
                        id="password"
                        type="password"
                        class="input-text"
                        v-model="credentials.password"
                        required
                    />
                </div>

                <div class="form-group">
                    <label for="password_confirmation"
                        >Confirm New Password</label
                    >
                    <input
                        id="password_confirmation"
                        type="password"
                        class="input-text"
                        v-model="credentials.password_confirmation"
                        required
                    />
                </div>

                <div class="form-group">
                    <button
                        class="btn button-md button-theme btn-block"
                        v-if="!changingPassword"
                    >
                        Change Password
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
    name: "ChangePassword",
    data() {
        return {
            credentials: {
                current_password: "",
                password: "",
                password_confirmation: "",
            },
            changingPassword: false,
            errorMessage: "",
            successMessage: "",
        };
    },
    methods: {
        clearInputs() {
            this.credentials.current_password = "";
            this.credentials.password = "";
            this.credentials.password_confirmation = "";
        },
        changePassword() {
            this.changingPassword = true;
            this.errorMessage = "";

            this.$store
                .dispatch("CHANGE_PASSWORD", this.credentials)
                .then(({ message }) => {
                    this.successMessage = message;
                    this.changingPassword = false;

                    this.clearInputs();

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                })
                .catch((error) => {
                    this.changingPassword = false;
                    this.errorMessage = error;

                    this.clearInputs();
                });
        },
    },
};
</script>

<style scoped></style>
