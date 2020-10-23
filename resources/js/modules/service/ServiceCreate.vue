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
                                    <h3 class="mb-0">Create Service</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form v-on:submit.prevent="formSubmit">
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-title">Title</label>
                                                <input type="text" id="input-titletitle" class="form-control" placeholder="Title" v-model="service_title" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-title">Description</label>
                                                <input type="text" id="input-titletitle" class="form-control" placeholder="Title" v-model="description" />
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
    export default {
        props: ["servicelist"],
        components: {},
        created() {},
        data() {
            return {
               service_title: "",
               description: "",
            };
        },
        computed: {},
        methods: {
            formSubmit(event) {
                // https://stackoverflow.com/questions/49940889/how-can-i-add-multiple-images-along-with-other-input-fields-in-vue-js-html

                let servicedata = {
                    house_id: this.servicelist[0].house_id,
                    landlord_id: this.servicelist[0].landlord_id,
                    service_title: this.service_title,
                    description: this.description,
                };
                axios
                    .post("/servicestore", servicedata)
                    // .post("/meeting", data)
                    .then((response) => {
                        console.log("response", response);
                        location.href = "/servicelist";
                    })
                    .catch(function (error) {
                        console.log("response", error);
                    });
            },
        },
    };
</script>

<style scoped></style>
