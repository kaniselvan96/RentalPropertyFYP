<template>
    <div class="main-content mt-1" id="panel">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Tenant Invoice [#RF0{{invoice_id}}]</h3>
                                </div>
                                <div class="col-md-4 text-right">
                                    <div class="btn-block">
                                        <span v-if="payment_status == 'paid'">
                                            <button class="btn btn-width btn-success" disabled>Paid</button>
                                        </span>
                                        <span v-if="payment_status == 'waiting'">
                                            <button class="btn btn-width btn-info" @click="paymodel(invoice_id)" data-toggle="modal" data-target="#modal-notification">Pay</button>
                                        </span>
                                        <span v-if="payment_status == 'overdue'">
                                            <button class="btn btn-width btn-warning" @click="paymodel(invoice_id)" data-toggle="modal" data-target="#modal-notification">Overdue</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="media-comment-text">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="h5 mt-0">Tenant Name</h6>
                                        <p class="text-sm lh-160">{{name}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="h5 mt-0">Email</h6>
                                        <p class="text-sm lh-160">{{email}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="h5 mt-0">Phone</h6>
                                        <p class="text-sm lh-160">{{phone_number}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="h5 mt-0">IC Number</h6>
                                        <p class="text-sm lh-160">{{ic_number}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="h5 mt-0">Rental Unit</h6>
                                        <p class="text-sm lh-160">{{rental_unit}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <h6 class="h5 mt-0">Due On</h6>
                                        <p class="text-sm lh-160">{{due_on}}</p> -->
                                        <h6 class="h5 mt-0">Lease Expiration Date</h6>
                                        <p class="text-sm lh-160">{{lease_expiration_date | formatDate}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="h5 mt-0">Billing Month</h6>
                                        <p class="text-sm lh-160">{{billing_month | formatmonth}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="h5 mt-0">Due Date</h6>
                                        <p class="text-sm lh-160">{{due_on | formatDate}}</p>
                                    </div>
                                </div>
                                <!-- Card header -->
                                <div class="table-responsive mt-3">
                                    <table id="meetingTable2" class="table table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>charge description</th>
                                                <th>charge date</th>
                                                <th>amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(charge, key) in chargelist" :key="key">
                                                <td>{{charge.description_charge}}</td>
                                                <td>{{charge.charge_date}}</td>
                                                <td>{{charge.amount}}</td>
                                            </tr>
                                            <tr class="bg-secondary">
                                                <td></td>
                                                <td>TOTAL</td>
                                                <td><b>{{total}}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                                    <h1 class="card-title text-uppercase mb-0">Total Amount</h1>
                                    <h1 class="font-weight-bold mb-0">RM {{currentamount}}</h1>
                                </div>
                                <label class="form-control-label" for="input-furnishing">Choose Bank</label>
                                <select class="form-control" id="exampleFormControlSelect1" required>
                                    <option>Affin Bank</option>
                                    <option>Agrobank</option>
                                    <option>AmBank</option>
                                    <option>Bank Simpanan Nasional</option>
                                    <option>CIMB</option>
                                    <option>HSBC Bank</option>
                                    <option>Maybank</option>
                                    <option>Public Bank</option>
                                </select>
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
    import moment from "moment";

    export default {
        props: ["invoiceview", "chargelist"],
        components: {},
        created() {},
        data() {
            return {
                invoice_id: this.invoiceview.invoice_id,
                billing_month: this.invoiceview.month,
                name: this.invoiceview.name,
                email: this.invoiceview.email,
                phone_number: this.invoiceview.phone,
                ic_number: "",
                home_address: "",
                professional: this.invoiceview.professional,
                rental_unit: this.invoiceview.address_line1 + " " + this.invoiceview.address_line2,
                rental: this.invoiceview.tenant_rent,
                deposit: this.invoiceview.deposit,
                due_on: this.invoiceview.pay_date,
                lease_expiration_date: this.invoiceview.lease_expiration_date,
                total: this.invoiceview.total,
                payment_status: this.invoiceview.payment_status,

                chargelistunbilled: this.chargelist,
                currentamount: "",
                currentid: "",
            };
        },
        mounted() {},
        computed: {},
        methods: {
            paymodel(data_invoice_id) {
                this.currentamount = this.invoiceview.total;
                this.currentid = this.invoiceview.invoice_id;
            },
            paynow() {
                let chargedata = {
                    invoice_id: this.invoiceview.invoice_id,
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

<style scoped></style>
