<template>
    <!-- Main content -->
    <div class="main-content mt-1" id="panel">
        <!-- Topnav -->

        <!-- Page content -->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Rental Property</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mx-auto">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <vue-image-slider :images="imageArray" :intervalVal="5000" :height="500" :width="800" />
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <small class="text-muted">Title</small>
                                            <h5 class="h2 card-title mb-0">{{ title }}</h5>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <div class="row">
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">Property Type</small>
                                            <h5 class="h2 card-title mb-0">{{ property_type }}</h5>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">Property Name</small>
                                            <h5 class="h2 card-title mb-0">{{ property_name }}</h5>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">Floor</small>
                                            <h5 class="h2 card-title mb-0">{{ floor }}</h5>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">Bedroom</small>
                                            <h5 class="h2 card-title mb-0">{{ bedroom }}</h5>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">Bathroom</small>
                                            <h5 class="h2 card-title mb-0">{{ bathroom }}</h5>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">Parking</small>
                                            <h5 class="h2 card-title mb-0">{{ parking }}</h5>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">Furnishing</small>
                                            <h5 class="h2 card-title mb-0">{{ furnishing }}</h5>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <div class="row">
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">Rental</small>
                                            <h5 class="h2 card-title mb-0">{{ rental }}</h5>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">Deposit</small>
                                            <h5 class="h2 card-title mb-0">{{ deposit }}</h5>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <div class="row">
                                        <div class="col-md-12 my-2">
                                            <small class="text-muted">Address Line1</small>
                                            <h5 class="h2 card-title mb-0">{{ address_line1 }}</h5>
                                        </div>
                                        <div class="col-md-12 my-2">
                                            <small class="text-muted">Address Line2</small>
                                            <h5 class="h2 card-title mb-0">{{ address_line2 }}</h5>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">Postcode</small>
                                            <h5 class="h2 card-title mb-0">{{ postcode }}</h5>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">City</small>
                                            <h5 class="h2 card-title mb-0">{{ city }}</h5>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">State</small>
                                            <h5 class="h2 card-title mb-0">{{ state }}</h5>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <div class="row">
                                        <div class="col-md-4 my-2">
                                            <small class="text-muted">Description</small>
                                            <h5 class="h2 card-title mb-0">{{ description }}</h5>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <div class="row">
                                        <div class="col-md-4 my-2" v-for="(product, index) in checkedfacilities" :key="index">
                                            <div class="col ml--2">
                                                <span class="text-primary">●</span>
                                                <small class="h2 card-title mb-0">{{product}}</small>
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
    </div>
</template>

<script>
    import VueImageSlider from "vue-image-slider";
    export default {
        props: ["houseview", "savedfacilities","housephotolink"],
        components: {
            VueImageSlider,
        },
        data() {
            return {
                title: this.houseview.title,
                property_type: this.houseview.property_type,
                property_name: this.houseview.property_name,
                floor: this.houseview.floor,
                bedroom: this.houseview.bedroom,
                bathroom: this.houseview.bathroom,
                parking: this.houseview.parking,
                furnishing: this.houseview.furnishing,
                rental: this.houseview.rental,
                deposit: this.houseview.deposit,
                address_line1: this.houseview.address_line1,
                address_line2: this.houseview.address_line2,
                postcode: this.houseview.postcode,
                city: this.houseview.city,
                state: this.houseview.state,
                description: this.houseview.description,
                state: this.houseview.state,
                facilities: ["Refrigerator", "Cooker", "Water filter", "Washing machine", "Wardrobe", "Ceiling fan"],
                checkedfacilities: this.savedfacilities,
                imageArray: this.housephotolink
            };
        },
        computed: {},
        methods: {},
    };
</script>

<style scoped></style>
