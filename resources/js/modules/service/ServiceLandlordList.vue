<template>
    <div class="main-content mt-1" id="panel">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
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
                        <div class="card-body">
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
                        <div class="card-body">
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
                                    <h3 class="mb-0">Service List</h3>
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
                                    <a v-bind:href="'/addtenant/'+ service.house_id" class="btn btn-primary mt-2 float-right" type="button">Add Tenant</a>
                                    <h4 class="mt-3 mb-1">{{service.title}}</h4>
                                    <h4 class="">#{{service.service_id}}</h4>
                                    <p class="text-sm mb-0">Tenant : {{service.name}}</p>
                                    <p class="text-sm mb-0">Location : {{service.state}}</p>
                                </div>
                                <hr class="m-0 p-0" />
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
            };
        },
        computed: {},
        methods: {
            closeNotify() {
                this.showAlert = false;
            },
            changesStatus(changeStatusData) {
                axios
                    .post("/servicechangestatus", changeStatusData)
                    .then((response) => {
                        console.log("response", response);
                        // this.showAlert = true;
                        // this.pending = response.data.pending;
                        // this.viewing = response.data.viewing;
                        // this.accepted = response.data.accepted;
                        // this.rejected = response.data.rejected;
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
