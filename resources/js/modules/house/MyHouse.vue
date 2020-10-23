<template>
 <div class="header-body">
            <div class="card-header">
                <!-- Title -->
                <h5 class="h3 mb-0">My House</h5>
            </div>
            <!-- Card stats -->
            <div class="row" >
                <div class="col-md-12">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Title</h5>
                                    <span class="h2 font-weight-bold mb-0">#RF{{invoices.title}}</span>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Property Type</h5>
                                    <span class="h2 font-weight-bold mb-0">{{invoices.property_type}}</span>
                                </div>
                                <div class="col-md-4 ">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Property Name</h5>
                                    <span class="h2 font-weight-bold mb-0">RM {{invoices.property_name}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Rental</h5>
                                    <span class="h2 font-weight-bold mb-0">{{invoices.rental}}</span>
                                </div>
                                <div class="col-md-4">
                                    <span >
                                        <h5 class="card-title text-uppercase text-muted mb-0">Deposit</h5>
                                        <span class="h2 font-weight-bold mb-0">{{invoices.deposit}}</span>
                                    </span>
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
        
        components: {},
        created() {},
        data() {
            return {
                invoices:"",
            };
        },
        computed: {},
        methods: {
        },
         mounted() {
             axios
                    .post("/myhouse")
                    // .post("/meeting", data)
                    .then((response) => {
                    console.log("response", response);
                        this.invoices = response['data'][0];
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
</style>
