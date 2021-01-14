<template>
    <div class="container">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12" v-for="(house, key) in myhouse" :key="key">
                            <div class="card">
                                <div class="card-header">
                                    <!-- Title -->
                                    <!-- <h5 class="h3 mb-0">My House - [<span class="text-sm">{{house.request_status}}</span>]</h5> -->
                                    <h5 class="h3 mb-0">My House</h5>
                                </div>
                                <div class="card card-stats">
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Title</h5>
                                                <span class="h2 font-weight-bold mb-0">{{house.title}}</span>
                                            </div>
                                            <div class="col-md-4">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Property Type</h5>
                                                <span class="h2 font-weight-bold mb-0">{{house.property_type}}</span>
                                            </div>
                                            <div class="col-md-4">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Property Name</h5>
                                                <span class="h2 font-weight-bold mb-0">{{house.property_name}}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Rental</h5>
                                                <span class="h2 font-weight-bold mb-0">RM{{house.rental}}</span>
                                            </div>
                                            <div class="col-md-4">
                                                <span>
                                                    <h5 class="card-title text-uppercase text-muted mb-0">Deposit</h5>
                                                    <span class="h2 font-weight-bold mb-0">RM{{house.deposit}}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <!-- Title -->
                            <h5 class="h3 mb-0">Reminder</h5>
                        </div>
                        <!-- Card body -->
                        <div class="card-body scroll-add">
                            <!-- List group -->
                            <ul class="list-group list-group-flush list my--3">
                                <div v-if="reminderlist.length == 0">No Reminder</div>
                                <li class="list-group-item px-0" v-for="(reminder, key) in reminderlist" :key="key">
                                    <div class="row" >
                                        
                                        <div class="col ml--2">
                                            <h4 class="mb-0">Pay Rent: RM{{reminder.total}}</h4>
                                            <small class="mb-0">House: {{reminder.title}}</small><br />
                                            <small class="mb-0">Month: {{reminder.month | formatmonth}}</small><br />
                                            <small class="mb-0">Due Date: {{reminder.pay_date | formatdate}}</small>
                                        </div>
                                        <div class="col-auto">
                                            <a v-bind:href="'/invoiceview/'+ reminder.invoice_id" class="btn btn-sm btn-success mr-4">View Invoice</a>
                                        </div>
                                        <button type="button" class="close close-top" data-dismiss="alert" aria-label="Close" @click="deletereminder(reminder.reminder_id)">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <hr class="m-0" />
                                </li>
                            </ul>
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
        components: {},
        created() {},
        data() {
            return {
                myhouse: "",
                reminderlist: "",
            };
        },
        computed: {},
        methods: {
            deletereminder(id){
                console.log("hi",id);
                let reminderdata = {
                        reminder_id: id,
                    };
                axios
                    .post("/deletereminder",reminderdata)
                    // .post("/meeting", data)
                    .then((response) => {
                        console.log("response", response);
                       location.href = "/";
                    })
                    .catch(function (error) {
                        console.log("response", error);
                    });

            }
        },
        mounted() {
            axios
                .post("/myhouse")
                // .post("/meeting", data)
                .then((response) => {
                    console.log("response", response);
                    this.myhouse = response["data"];
                })
                .catch(function (error) {
                    console.log("response", error);
                });

            axios
                .post("/getreminder")
                // .post("/meeting", data)
                .then((response) => {
                    console.log("response", response);
                    // console.log('reminder',response["data"])
                    this.reminderlist = response["data"];
                })
                .catch(function (error) {
                    console.log("response", error);
                });
        },
    };
</script>

<style scoped>
    .btn-width {
        width: 130px;
    }
    .scroll-add {
        max-height: 800px;
        overflow: auto;
    }
    .close-top{
        height: 10px;
    }
</style>
