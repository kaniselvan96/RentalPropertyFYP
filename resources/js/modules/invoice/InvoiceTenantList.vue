<template>
    <div class="container">
        <div class="header-body">
            <div class="card-header">
                <!-- Title -->
                <h5 class="h3 mb-0">Invoice</h5>
            </div>
            <!-- Card stats -->
            <div class="row" v-for="(invoices, key) in invoiceslist" :key="key">
                <div class="col-md-12">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Invoice ID</h5>
                                    <span class="h2 font-weight-bold mb-0">#RF0{{invoices.invoice_id}}</span>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Month</h5>
                                    <span class="h2 font-weight-bold mb-0">{{invoices.month | formatmonth}}</span>
                                </div>
                                <div class="col-md-4 text-right">
                                    <h5 class="card-title text-uppercase text-muted text-right mb-0">Amount</h5>
                                    <h1 class="font-weight-bold mb-0">RM {{invoices.total}}</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Due Date</h5>
                                    <span class="h2 font-weight-bold mb-0">{{invoices.pay_date | formatDate}}</span>
                                </div>
                                <div class="col-md-4">
                                    <span v-if="invoices.paid_date">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Paid On</h5>
                                        <span class="h2 font-weight-bold mb-0">{{invoices.paid_date | formatDate}}</span>
                                    </span>
                                </div>
                                <div class="col-md-4 text-right">
                                    <div class="btn-block">
                                        <a v-bind:href="'/invoiceview/'+ invoices.invoice_id" class="btn btn-width btn-neutral">View</a>
                                        <span v-if="invoices.payment_status == 'paid'">
                                            <button class="btn btn-width btn-success" disabled>Paid</button>
                                        </span>
                                        <span v-if="invoices.payment_status == 'waiting'">
                                            <button class="btn btn-width btn-info" @click="paymodel(invoices)" data-toggle="modal" data-target="#modal-notification">Pay</button>
                                        </span>
                                        <span v-if="invoices.payment_status == 'overdue'">
                                            <button class="btn btn-width btn-warning" @click="paymodel(invoices)" data-toggle="modal" data-target="#modal-notification">Overdue</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                <div class="modal-content bg-success">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-notification">Payment Page</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ref="closeVuemodal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="py-3">
                            <form role="form" v-on:submit.prevent="formSubmit">
                                <div class="form-group mb-3">
                                                                    <h1 class="card-title text-uppercase  mb-0">Total Amount</h1>
                                    <h1 class="font-weight-bold mb-0">RM {{currentamount}}</h1>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-white" @click="paynow()">Pay</button>
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["invoiceslist"],
        components: {},
        created() {},
        data() {
            return {
                selected_house_id: "",
                currentamount:"",
                currentid:""
            };
        },
        computed: {},
        methods: {
            paymodel(data) {
                this.currentamount = data.total;
                this.currentid = data.invoice_id;
            },
            paynow() {
                let chargedata = {
                    invoice_id: this.currentid
                };
                axios
                    .post("/payinvoice", chargedata)
                    // .post("/meeting", data)
                    .then((response) => {
                    console.log("response", response);
                    location.href = "/invoicetenantlist";
                    })
                    .catch(function (error) {
                    console.log("response", error);
                    });
            },
        },
    };
</script>

<style scoped>
    .btn-width {
        width: 130px;
    }
</style>
