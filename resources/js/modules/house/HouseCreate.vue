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
                                    <h3 class="mb-0">Create Rental Property</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form v-on:submit.prevent="formSubmit">
                                <h6 class="heading-small text-muted mb-4">
                                    Add Photo
                                </h6>
                                <div class="pl-lg-4">
                                    <div class="row" :if="images.length">
                                        <div class="col-lg-6 d-flex align-items-center" v-for="(f, index) in images" :key="index">
                                            <div class="form-group">
                                                <!-- <ul class="list-group list-group-flush list my--3" :if="images.length">
                                                    <li class="list-group-item px-0" v-for="(f, index) in images" :key="index"> -->

                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div :class="'images[' + index + ']-preview image-preview'"></div>
                                                    </div>
                                                    <div class="col ml--2">
                                                        <h4 class="mb-0">
                                                            <input type="file" class="images[]" accept="image/*" @change="previewImage(index, $event)" />
                                                        </h4>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="btn btn-sm btn-primary" @click.prevent="removeImage(index, $event)">Remove</button>
                                                    </div>
                                                </div>

                                                <!-- </li>
                                                </ul> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <button class="btn btn-primary add-image" @click.prevent="addNewImage">Add Image</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="heading-small text-muted mb-4">
                                    Rental information
                                </h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-title">Title</label>
                                                <input type="text" id="input-titletitle" class="form-control" placeholder="Title" v-model="title" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-property_type">Property Type</label>
                                                <input type="text" id="input-property_type" class="form-control" placeholder="" v-model="property_type" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-property_name">Property Name</label>
                                                <input type="text" id="input-property_name" class="form-control" placeholder="property_name" v-model="property_name" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-floor">Floor</label>
                                                <input type="text" id="input-floor" class="form-control" placeholder="floor" v-model="floor" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-bedroom">Bedroom</label>
                                                <input type="text" id="input-bedroom" class="form-control" placeholder="bedroom" v-model="bedroom" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-bathroom">Bathroom</label>
                                                <input type="text" id="input-bathroom" class="form-control" placeholder="bathroom" v-model="bathroom" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-parking">Number of Parking</label>
                                                <input type="number" id="input-parking" class="form-control" placeholder="parking" v-model="parking" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-furnishing">Furnishing</label>
                                                <select class="form-control" id="exampleFormControlSelect1" v-model="furnishing" required>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <!-- Address -->
                                <h6 class="heading-small text-muted mb-4">
                                    Payment information
                                </h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-rental">Rental</label>
                                                <input type="text" id="input-rental" class="form-control" placeholder="rental" v-model="rental" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-deposit">Deposit</label>
                                                <input type="text" id="input-deposit" class="form-control" placeholder="deposit" v-model="deposit" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <!-- Address -->
                                <h6 class="heading-small text-muted mb-4">
                                    Contact information
                                </h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address_line1">Address Line 1</label>
                                                <input id="input-address" class="form-control" placeholder="Home address" v-model="address_line1" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address_line2">Address Line 2</label>
                                                <input id="input-address" class="form-control" placeholder="Home address" v-model="address_line2" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-postcode">Postcode</label>
                                                <input type="text" id="input-postcode" class="form-control" placeholder="postcode" v-model="postcode" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-city">City</label>
                                                <input type="text" id="input-city" class="form-control" placeholder="city" v-model="city" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="state">State</label>
                                                <select class="form-control" id="state" v-model="state">
                                                    <option value="Johor">Johor</option>
                                                    <option value="Kedah">Kedah</option>
                                                    <option value="Kelantan">Kelantan</option>
                                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                                    <option value="Labuan">Labuan</option>
                                                    <option value="Malacca">Malacca</option>
                                                    <option value="Negeri Sembilan">
                                                        Negeri Sembilan
                                                    </option>
                                                    <option value="Pahang">Pahang</option>
                                                    <option value="Perak">Perak</option>
                                                    <option value="Perlis">Perlis</option>
                                                    <option value="Penang">Penang</option>
                                                    <option value="Sabah">Sabah</option>
                                                    <option value="Sarawak">Sarawak</option>
                                                    <option value="Selangor">Selangor</option>
                                                    <option value="Terengganu">Terengganu</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <!-- Facilities -->
                                <h6 class="heading-small text-muted mb-4">Rental Facilities</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" v-for="(product, index) in facilities" :key="index">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input class="custom-control-input" :id="product" :value="product" name="product" type="checkbox" v-model="checkedfacilities" />
                                                    <label class="custom-control-label" :for="product"><span>{{ product }}</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <!-- Description -->
                                <h6 class="heading-small text-muted mb-4">Description</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea rows="4" class="form-control" placeholder="A few words about house ..." v-model="description"> </textarea>
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
        created() {},
        data() {
            return {
                title: "",
                property_type: "",
                property_name: "",
                floor: "",
                bedroom: "",
                bathroom: "",
                parking: "",
                furnishing: "",
                rental: "",
                deposit: "",
                address_line1: "",
                address_line2: "",
                postcode: "",
                city: "",
                state: "",
                description: "",
                facilities: ["Refrigerator", "Cooker", "Water filter", "Washing machine", "Wardrobe", "Ceiling fan"],

                checkedfacilities: [],
                images: [],
                maxImages: 15,
                addImage: "button.add-image",
            };
        },
        computed: {},
        methods: {
            addNewImage: function (e) {
                var n = this.maxImages || -1;
                if (n && this.images.length < n) {
                    this.images.push("");
                }
                this.checkImages();
            },

            removeImage: function (index) {
                this.images.splice(index, 1);
                this.checkImages();
            },
            checkImages: function () {
                var n = this.maxImages || -1;
                if (n && this.images.length >= n) {
                    $(this.addImage, this.el).prop("disabled", true); // Disables the button.
                } else {
                    $(this.addImage, this.el).prop("disabled", false); // Enables the button.
                }
            },
            previewImage: function (index, e) {
                var r = new FileReader(),
                    f = e.target.files[0];

                r.addEventListener(
                    "load",
                    function () {
                        $('[class~="images[' + index + ']-preview"]', this.el).html('<img src="' + r.result + '" class="thumbnail img-responsive btn-width">');
                    },
                    false
                );

                if (f) {
                    r.readAsDataURL(f);
                }
            },
            formSubmit(event) {
                // https://stackoverflow.com/questions/49940889/how-can-i-add-multiple-images-along-with-other-input-fields-in-vue-js-html

                let houseData = {
                    title: this.title,
                    property_type: this.property_type,
                    property_name: this.property_name,
                    floor: this.floor,
                    bedroom: this.bedroom,
                    bathroom: this.bathroom,
                    parking: this.parking,
                    furnishing: this.furnishing,
                    rental: this.rental,
                    deposit: this.deposit,
                    address_line1: this.address_line1,
                    address_line2: this.address_line2,
                    postcode: this.postcode,
                    city: this.city,
                    state: this.state,
                    checkedfacilities: this.checkedfacilities,
                    description: this.description,
                };
                axios
                    .post("/storehouse", houseData)
                    // .post("/meeting", data)
                    .then((response) => {
                        console.log("response", response);
                        // location.href = "/listhouse";
                        console.log(response.data.house_id);

                        var vm = this;

                        var data = new FormData(event.target);

                        $('[class~="images[]"]', this.el).each(function (i) {
                            if (i > vm.maxImages - 1) {
                                return; // Max images reached.
                            }
                            data.append("images[" + i + "]", this.files[0]);
                        });
                        data.append("house_id", response.data.house_id);
                        axios
                            .post("/photostore", data)
                            // .post("/meeting", data)
                            .then((response) => {
                                console.log("response", response);
                                // location.href = "/photohouse/"+this.houseview.house_id;
                            })
                            .catch(function (error) {
                                console.log("response", error);
                            });

                        location.href = "/listhouse";
                    })
                    .catch(function (error) {
                        console.log("response", error);
                    });
            },
        },
    };
</script>

<style></style>
