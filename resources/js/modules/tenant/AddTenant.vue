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
                            <form v-on:submit.prevent="formSubmit">
                                <h6 class="heading-small text-muted mb-4">
                                    Tenant Information
                                </h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-title">Name</label>
                                                <input type="text" id="input-titletitle" class="form-control" placeholder="Name" v-model="name" disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-property_type">Email</label>
                                                <input type="text" id="input-property_type" class="form-control" placeholder="Property Type" v-model="email" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-property_name">Phone Number</label>
                                                <input type="text" id="input-property_name" class="form-control" placeholder="Phone Number" v-model="phone_number" disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-property_name">Ic Number</label>
                                                <input type="text" id="input-property_name" class="form-control" placeholder="Ic Number" v-model="ic_number" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-property_name">Home Address</label>
                                                <input type="text" id="input-property_name" class="form-control" placeholder="Home Address" v-model="home_address" disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-property_name">Professional</label>
                                                <input type="text" id="input-property_name" class="form-control" placeholder="Professional" v-model="professional" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <h6 class="heading-small text-muted mb-4">
                                    Rental information
                                </h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-rental">Rental Unit</label>
                                                <input type="text" id="input-rental" class="form-control" placeholder="Rental Unit" v-model="rental_unit" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-rental">Rental</label>
                                                <input type="text" id="input-rental" class="form-control" placeholder="rental" v-model="rental" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-deposit">Deposit</label>
                                                <input type="text" id="input-deposit" class="form-control" placeholder="deposit" v-model="deposit" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-deposit">Due On</label>
                                                <input type="date" id="input-deposit" class="form-control" placeholder="Due On" v-model="due_on" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-deposit">Lease Start Date</label>
                                                <input type="date" id="input-deposit" class="form-control" placeholder="Lease Start Date" v-model="lease_start_date" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-deposit">Lease Expiration Date</label>
                                                <input type="date" id="input-deposit" class="form-control" placeholder="Lease Expiration Date" v-model="lease_expiration_date" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Create</button>
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
        props: ["addtenant"],
        created() {},
        data() {
            return {
                name: this.addtenant.name,
                email: this.addtenant.email,
                phone_number: this.addtenant.phone,
                ic_number: "",
                home_address: "",
                professional: this.addtenant.professional,
                rental_unit: this.addtenant.address_line1 + " " + this.addtenant.address_line2,
                rental: this.addtenant.rental,
                deposit: this.addtenant.deposit,
                due_on: "",
                lease_start_date: "",
                lease_expiration_date: "",
                rentcharge: [
                    {
                        description_charge: "Rent",
                        amount: parseInt(this.addtenant.rental),
                        charge_date: moment().format("DD-MM-YYYY"),
                        status: "NEW",
                        charges_id: null,
                    },
                ],
            };
        },
        computed: {},
        methods: {
            formSubmit(event) {
                let houseData = {
                    name: this.name,
                    email: this.email,
                    phone_number: this.phone_number,
                    ic_number: this.ic_number,
                    home_address: this.home_address,
                    professional: this.professional,
                    rental_unit: this.rental_unit,
                    rental: this.rental,
                    deposit: this.deposit,
                    due_on: this.due_on,
                    lease_start_date: this.lease_start_date,
                    lease_expiration_date: this.lease_expiration_date,
                    request_id: this.addtenant.request_id,
                    house_id: this.addtenant.house_id,
                    renter_id: this.addtenant.renter_id,
                };
                axios
                    .post("/storeaddtenant", houseData)
                    // .post("/meeting", data)
                    .then((response) => {
                        console.log("response", response);
                        //  location.href = "/requestpropertylist";

                        let chargedata = {
                            confirmchargelist: this.rentcharge,
                            house_id: this.addtenant.house_id,
                            renter_id: this.addtenant.renter_id,
                            deposit: parseInt(this.deposit),
                            total: parseInt(this.addtenant.rental),
                            month: "",
                            pay_date: moment(this.due_on).format(),
                        };
                        axios
                            .post("/storeinvoiceauto", chargedata)
                            // .post("/meeting", data)
                            .then((response) => {
                                console.log("response", response);
                                location.href = "/requestpropertylist";
                            })
                            .catch(function (error) {
                                console.log("response", error);
                            });

                    })
                    .catch(function (error) {
                        console.log("response", error);
                    });
            },
        },
    };
</script>

<style></style>
