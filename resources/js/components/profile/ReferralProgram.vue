<template>
    <div class="my-address">
        <div class="about-text">
            <h3>Referral Program</h3>

            <p>
                Hello, {{ user.first_name }}. We are pleased to share with you
                about our referral program. Share with your friends and earn 10%
                commission on their first booking.
                <a href="#" class="terms-link">Terms and conditions apply</a>
            </p>

            <div class="text-center">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button
                        @click="copyLink(true)"
                        type="button"
                        class="btn button-theme"
                    >
                        {{ guestLinkText }}
                    </button>
                    <button
                        @click="copyLink(false)"
                        type="button"
                        class="btn btn-secondary"
                    >
                        {{ hostLinkText }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ReferralProgram",
    props: {
        user: {
            required: true,
            type: Object,
        },
    },
    data() {
        return {
            guestLink: location.host,
            hostLink: location.host,
            guestLinkText: "Copy Guest Link",
            hostLinkText: "Copy Host Link",
        };
    },
    methods: {
        copyLink(isGuest) {
            let link = isGuest ? this.guestLink : this.hostLink;

            let temp = $("<input>");

            $("body").append(temp);
            temp.val(link).select();
            document.execCommand("copy");
            temp.remove();

            const message = "Link copied";

            isGuest
                ? (this.guestLinkText = message)
                : (this.hostLinkText = message);

            setTimeout(() => {
                isGuest
                    ? (this.guestLinkText = "Copy Guest Link")
                    : (this.hostLinkText = "Copy Host Link");
            }, 3000);
        },
    },
};
</script>

<style scoped>
.terms-link {
    text-decoration: underline !important;
    color: #ffb400;
}
</style>
