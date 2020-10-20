<template>
    <div class="main-content mt-1" id="panel">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Add Tenant</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="media-comment-text">
                                <h6 class="h5 mt-0">Tenant Name</h6>
                                <p class="text-sm lh-160">{{name}}</p>
                                <h6 class="h5 mt-0">Email</h6>
                                <p class="text-sm lh-160">{{email}}</p>
                                <h6 class="h5 mt-0">Phone</h6>
                                <p class="text-sm lh-160">{{phone_number}}</p>
                                <h6 class="h5 mt-0">IC Number</h6>
                                <p class="text-sm lh-160">{{ic_number}}</p>
                                <h6 class="h5 mt-0">Rental Unit</h6>
                                <p class="text-sm lh-160">{{rental_unit}}</p>
                                <!-- <h6 class="h5 mt-0">Due On</h6>
                                <p class="text-sm lh-160">{{due_on}}</p> -->
                                <h6 class="h5 mt-0">Lease Expiration Date</h6>
                                <p class="text-sm lh-160">{{lease_expiration_date}}</p>
                            </div>
                            <form v-on:submit.prevent="formSubmit">
                                <div class="row align-items-center mt-3">
                                    <div class="col-8">
                                        <h6 class="heading-small text-muted mb-4">
                                            Rental information
                                        </h6>
                                    </div>
                                    <div class="col-4 text-right">
                                        <button type="submit" class="btn btn-success">Create</button>
                                    </div>
                                </div>

                                <div class="pl-lg-2">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-deposit">Billing month</label>
                                                <input type="month" id="input-deposit" class="form-control" placeholder="Due On" v-model="billing_month" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-deposit">Due Date</label>
                                                <input type="date" id="input-deposit" class="form-control" placeholder="Due On" v-model="due_on" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- Card header -->
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">Charge List</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <!-- <a v-bind:href="'/createhouse/'" class="btn btn-sm btn-primary" @click="addcharge()">Add</a> -->
                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-notification">Add Charge</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="meetingTable2" class="table table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>charge description</th>
                                            <th>charge date</th>
                                            <th>amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(charge, key) in confirmchargelist" :key="key">
                                            <td>{{charge.description_charge}}</td>
                                            <td>{{charge.charge_date}}</td>
                                            <td>{{charge.amount}}</td>
                                        </tr>
                                        <tr class="bg-warning">
                                            <td></td>
                                            <td>TOTAL</td>
                                            <td><b>{{total}}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr class="my-4" />
                            <!-- Card header -->
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">Other Charge List (unbilled)</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="meetingTable2" class="table table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>charge description</th>
                                            <th>charge date</th>
                                            <th>amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(charge, key) in chargelistunbilled" :key="key">
                                            <td>{{charge.description_charge}}</td>
                                            <td>{{charge.charge_date}}</td>
                                            <td>{{charge.amount}}</td>
                                            <td><button class="btn btn-sm btn-info" @click="addexistcharge(charge)">Include</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- model -->

            <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content bg-success">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" ref="closeVuemodal">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="py-3">
                                <form role="form" v-on:submit.prevent="addcharge">
                                    <div class="form-group mb-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-property_type">Charge Description</label>
                                            <input type="text" id="input-property_type" class="form-control" placeholder="" v-model="add_description_charge" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-property_type">Charge Date</label>
                                            <input class="form-control" type="date" id="example-date-input" v-model="add_charge_date" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-property_type">Amount</label>
                                            <input class="form-control" type="number" id="example-date-input" v-model="add_amount" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-white">Add</button>
                                        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'

    export default {
        
        props: ["tenantinfo", "chargelist","billedchargelist"],
        components: {},
        created() {},
        data() {
            return {
                confirmchargelist: [
                ],
                rentcharge: [
                    {
                        description_charge: "Rent",
                        amount: parseInt(this.tenantinfo.tenant_rent),
                        charge_date: moment().format('DD-MM-YYYY'),
                        status: "NEW",
                        charges_id: null,
                    },
                ],
                add_description_charge: "",
                add_amount: 0,
                add_charge_date: "",

                billing_month: "",
                name: this.tenantinfo.name,
                email: this.tenantinfo.email,
                phone_number: this.tenantinfo.phone,
                ic_number: "",
                home_address: "",
                professional: this.tenantinfo.professional,
                rental_unit: this.tenantinfo.address_line1 + " " + this.tenantinfo.address_line2,
                rental: this.tenantinfo.tenant_rent,
                deposit: this.tenantinfo.deposit,
                due_on: "",
                lease_expiration_date: this.tenantinfo.lease_expiration_date,

                chargelistunbilled : this.chargelist
            };
        },
        mounted() {
            if(this.billedchargelist === undefined || this.billedchargelist.length == 0){
                 this.confirmchargelist = this.rentcharge;
            }else{
                console.log("hi",this.billedchargelist.length)
                this.confirmchargelist = this.billedchargelist;
               
            }
            
        },
        computed: {
            total: function () {
                var sum = 0;
                this.confirmchargelist.forEach((e) => {
                    sum += e.amount;
                });
                return sum;
            },
        },
        methods: {
            addcharge() {
                this.confirmchargelist.push({
                    description_charge: this.add_description_charge,
                    amount: parseInt(this.add_amount),
                    charge_date: this.add_charge_date,
                    status: "NEW",
                    charges_id: null,
                });
                this.$refs.closeVuemodal.click();

                this.add_description_charge = "";
                this.add_amount = 0;
                this.add_charge_date = "";
            },

            addexistcharge(existcharge) {
                this.confirmchargelist.push({
                    description_charge: existcharge.description_charge,
                    amount: parseInt(existcharge.amount),
                    charge_date: existcharge.charge_date,
                    status: "unbilled",
                    charges_id: existcharge.charges_id,
                });

                this.chargelistunbilled = this.chargelistunbilled.filter((charge) => charge.charges_id != existcharge.charges_id);
            },
            formSubmit(event) {

                let chargedata = {
                    confirmchargelist: this.confirmchargelist,
                    house_id: this.tenantinfo.house_id,
                    renter_id: this.tenantinfo.renter_id,
                    total: this.total,
                    month: this.billing_month,
                    pay_date: this.due_on,
                };
                axios
                    .post("/storeinvoice", chargedata)
                    // .post("/meeting", data)
                    .then((response) => {
                    console.log("response", response);
                    //location.href = "/listhouse";
                    })
                    .catch(function (error) {
                    console.log("response", error);
                    });
            },
        },
    };
</script>

<style scoped></style>
