<template>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <property-details-component
            :property="booking.property"
        ></property-details-component>

        <div class="tables mb-50">
            <h3 class="heading-3">Payments</h3>
            <table class="table table-bordered mb-0">
                <thead class="bg-active">
                    <tr class="ass">
                        <th scope="col" style="width: 5%">#</th>
                        <!--                        <th scope="col">Account #</th>-->
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(payment, index) in booking.payments">
                        <th scope="row">{{ index + 1 }}</th>
                        <!--                        <td>{{ payment.account_number }}</td>-->
                        <td>KES {{ payment.amount | numberFormat }}</td>
                        <td>
                            <span
                                class="label label-success"
                                v-if="payment.is_paid"
                                >Paid</span
                            >
                            <span class="label label-info" v-else
                                >Not Paid</span
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import PropertyDetailsComponent from "../utils/PropertyDetailsComponent";

export default {
    name: "MyBookingsPropertyDetails",
    components: { PropertyDetailsComponent },
    props: {
        booking: {
            required: true,
            type: Object,
        },
    },
};
</script>

<style scoped></style>
