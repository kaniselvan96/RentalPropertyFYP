<template>
    <div class="main-content mt-1" id="panel">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Service List <span class="text-sm text-gray" v-if="!servicelist.length"> - [No House to create service] </span></h3>
                                </div>
                                <div class="col-4 text-right" v-if="servicelist.length">
                                    <a v-bind:href="'/servicecreate/'+ servicelist[0].house_id" class="btn btn-primary">Create</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card body -->
                        <div class="card-body p-0" v-if="servicelist.length">
                            <!-- List group -->
                            <div class="list-group list-group-flush" v-for="(service, key) in servicelist" :key="key">
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
                                        <span v-if="service.services_status == 'Accepted'" class="badge badge-lg badge-success height-30">Accepted</span>
                                        <span v-if="service.services_status == 'Pending'" class="badge badge-lg badge-info height-30">Pending</span>
                                        <span v-if="service.services_status == 'Rejected'" class="badge badge-lg badge-warning height-30">Rejected</span>
                                    </div>
                                    <h4 class="mt-3 mb-1">{{service.title}}</h4>
                                    <h4 class="">#{{service.service_id}}</h4>
                                    <div>
                                        <p class="text-sm mb-0">{{service.state}} <span v-if="service.services_status == 'Accepted' && service.charge_amount > 0" class="h2 float-right mb-0">Cost : RM{{service.charge_amount}}</span></p>
                                    </div>
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
        props: ["servicelist"],
        components: {},
        created() {},
        data() {
            return {
                //   houseAllList: this.houselist,
            };
        },
        computed: {},
        methods: {},
    };
</script>

<style scoped>
    .height-30 {
        height: 30px;
    }
</style>
