<template>
    <!-- Main content -->
    <div class="main-content mt-1" id="panel">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">View Tenant</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading text-black bg-secondary text-center p-2">
                                Tenant Information
                            </h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 my-2">
                                            <small class="text-muted">Name</small>
                                            <h5 class="h2 card-title mb-0">{{ name }}</h5>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <small class="text-muted">Email</small>
                                            <h5 class="h2 card-title mb-0">{{ email }}</h5>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <small class="text-muted">Phone Number</small>
                                            <h5 class="h2 card-title mb-0">{{ phone_number }}</h5>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <small class="text-muted">Ic Number</small>
                                            <h5 class="h2 card-title mb-0">{{ ic_number }}</h5>
                                        </div>
                                        <div class="col-md-12 my-2">
                                            <small class="text-muted">Home Address</small>
                                            <h5 class="h2 card-title mb-0">{{ home_address }}</h5>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <small class="text-muted">Professional</small>
                                            <h5 class="h2 card-title mb-0">{{ professional }}</h5>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <h6 class="heading text-black bg-secondary text-center p-2">
                                        RENTAL INFORMATION
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-12 my-2">
                                            <small class="text-muted">Rental Unit</small>
                                            <h5 class="h2 card-title mb-0">{{ rental_unit }}</h5>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <small class="text-muted">Rental</small>
                                            <h5 class="h2 card-title mb-0">{{ rental }}</h5>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <small class="text-muted">Deposit</small>
                                            <h5 class="h2 card-title mb-0">{{ deposit }}</h5>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <small class="text-muted">Due On</small>
                                            <h5 class="h2 card-title mb-0">{{ due_on }}</h5>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <small class="text-muted">Lease Start Date</small>
                                            <h5 class="h2 card-title mb-0">{{ lease_start_date }}</h5>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <small class="text-muted">Lease Expiration Date</small>
                                            <h5 class="h2 card-title mb-0">{{ lease_expiration_date }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["viewtenant"],
        created() {},
        data() {
            return {
                name: this.viewtenant.name,
                email: this.viewtenant.email,
                phone_number: this.viewtenant.phone,
                ic_number: "",
                home_address: "",
                professional: this.viewtenant.professional,
                rental_unit: this.viewtenant.address_line1 + " " + this.viewtenant.address_line2,
                rental: this.viewtenant.rental,
                deposit: this.viewtenant.deposit,
                due_on: this.viewtenant.due_on,
                lease_start_date: this.viewtenant.lease_start_date,
                lease_expiration_date: this.viewtenant.lease_expiration_date,
            };
        },
        computed: {},
        methods: {},
    };
</script>

<style scoped></style>
