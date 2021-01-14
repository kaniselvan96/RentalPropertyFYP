<template>
    <div class="main-content mt-1" id="panel">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body badge-info">
                            <div class="row">
                                <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Pending</h5>
                                <span class="h2 font-weight-bold mb-0">{{counting.pending}}</span>
                                </div>                           
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body badge-success">
                            <div class="row">
                                <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Accepted</h5>
                                <span class="h2 font-weight-bold mb-0">{{accepted}}</span>
                                </div>                           
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body badge-warning">
                            <div class="row">
                                <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Rejected</h5>
                                <span class="h2 font-weight-bold mb-0">{{rejected}}</span>
                                </div>                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Report List</h3>
                                </div>
                            </div>
                        </div>
                        <!-- Card body -->
                        <div class="card-body p-0">
                            <!-- List group -->
                            <div class="list-group list-group-flush" v-for="(service, key) in servicelandlordlist" :key="key">
                                <div href="#" class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div>
                                            <div class="d-flex w-100 align-items-center">
                                                <h4 class="mt-0 mb-0"><span class="text-sm text-gray">Title : </span>{{service.service_title}}</h4>
                                            </div>
                                            <div class="d-flex w-100 align-items-center">
                                                <h4 class="mt-0 mb-0"><span class="text-sm text-gray">Description : </span>{{service.services_description}}</h4>
                                            </div>
                                        </div>
                                        <!-- <span v-if="service.services_status == 'Accepted'" class="badge badge-lg badge-success height-30">Accepted</span>
                                        <span v-if="service.services_status == 'Pending'" class="badge badge-lg badge-info height-30">Pending</span>
                                        <span v-if="service.services_status == 'Rejected'" class="badge badge-lg badge-warning height-30">Rejected</span> -->
                                        <select class="form-control width-130" id="exampleFormControlSelect1" v-model="service.services_status" @change="changesStatus(service)">
                                            <option>Pending</option>
                                            <option>Accepted</option>
                                            <option>Rejected</option>
                                        </select>
                                    </div>
                                    <!-- <a v-bind:href="'/addtenant/'+ service.house_id" class="btn btn-primary mt-2 float-right" type="button">Add Change</a> -->
                                    <!-- <button @click="addToChargeModel(service.services_description)" v-if="service.services_status == 'Accepted'" class="btn btn-primary mt-2 float-right mr-0" >Add Change</button>  -->
                                  <a v-bind:href="'/servicepage'" v-if="service.charge_amount < 1" class="btn btn-primary mt-2 float-right mr-0">Search Service</a>
                                    <button @click="addToChargeModel(service)" v-if="service.services_status == 'Accepted' && service.charge_amount < 1" class="btn btn-primary mt-2 float-right mr-5" data-toggle="modal" data-target="#modal-notification">Add Charge</button> 
                                    
                                    <h4 class="mt-3 mb-1">{{service.title}}</h4>
                                    
                                    <h4 class="">#{{service.service_id}}</h4>
                                      
                                    <p class="text-sm mb-0">Tenant : {{service.name}}</p>
                                   
                                    <div>
                                         <p class="text-sm mb-0">Location : {{service.state}}</p>
                                          <span v-if="service.services_status == 'Accepted' && service.charge_amount > 0" class="h2 float-right mb-0">Cost : RM{{service.charge_amount}}</span>
                                    </div>
                                </div>
                                <hr class="m-0 p-0" />
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
                            <h6 class="modal-title" id="modal-title-notification">Add Charge</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" ref="closeVuemodal">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="py-3">
                                <form role="form" v-on:submit.prevent="addcharge">
                                    <div class="form-group mb-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-property_type">Charge Description </label>
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
        props: ["servicelandlordlist","counting"],
        components: {},
        created() {},
        data() {
            return {
                status: "",
                // showAlert: false,
                pending: this.counting.pending,
                // viewing: "",
                accepted: this.counting.accepted,
                rejected: this.counting.rejected,
                current_service :"",
                 add_description_charge: "",
                add_amount: 0,
                add_charge_date: "",
            };
        },
        computed: {},
        methods: {
            addToChargeModel(data) {
                console.log('hi',data);
                this.current_service = data;
            },
            addcharge() {
                let chargedata = {
                    description_charge: this.add_description_charge,
                    amount: parseInt(this.add_amount),
                    charge_date:  moment(String(this.add_charge_date)).format('DD-MM-YYYY'),
                    charges_id: null,
                    house_id: this.current_service.house_id,
                    service_id: this.current_service.service_id,
                };
                this.$refs.closeVuemodal.click();
                 axios
                    .post("/servicecstorecharge", chargedata)
                    .then((response) => {
                    console.log("response", response);
                    location.href = "/servicelandlordlist";
                    })
                    .catch(function (error) {
                    console.log("response", error);
                    });

            },
            changesStatus(changeStatusData) {
                axios
                    .post("/servicechangestatus", changeStatusData)
                    .then((response) => {
                        location.href = "/servicelandlordlist";
                    })
                    .catch(function (error) {
                        console.log("response", error);
                    });
            },
        },
    };
</script>

<style scoped>
    .height-30 {
        height: 30px;
    }
    .width-130 {
        width: 130px;
    }
</style>
