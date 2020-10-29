<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h3 mb-0">Add House Photo</h5>
                    </div>
                    <div class="card-body">
                            <ul class="list-group list-group-flush list my--3" :if="saveimages.length">
                                <li class="list-group-item px-0" v-for="(saved, index) in saveimages" :key="index">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img alt="Image placeholder" :src="'/images/'+saved.photolink" class="btn-width">
                                        </div>
                                        <div class="col ml--2">
                                            <h4 class="mb-0">
                                                
                                            </h4>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-sm btn-primary" @click.prevent="removeSaveImage(saved)">Remove</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="h3 mb-0">Add House Photo</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="handleSubmit($event);">
                            <ul class="list-group list-group-flush list my--3" :if="images.length">
                                <li class="list-group-item px-0" v-for="(f, index) in images" :key="index">
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
                                </li>
                            </ul>
                            <br />
                            <br />
                            <button class="btn btn-primary add-image" @click.prevent="addNewImage">Add Image</button>
                            <button class="btn btn-success" v-if="images.length">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["houseview", "saveimages"],
        mounted() {
            console.log("Component mounted.");
        },
        data() {
            return {
                images: [],
                maxImages: 5,
                addImage: "button.add-image",
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
            };
        },
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

            handleSubmit: function (e) {
                var vm = this;

                var data = new FormData(e.target);

                $('[class~="images[]"]', this.el).each(function (i) {
                    if (i > vm.maxImages - 1) {
                        return; // Max images reached.
                    }
                    data.append("images[" + i + "]", this.files[0]);
                });
                data.append("house_id", this.houseview.house_id);
                axios
                    .post("/photostore", data)
                    // .post("/meeting", data)
                    .then((response) => {
                        console.log("response", response);
                        location.href = "/photohouse/"+this.houseview.house_id;
                    })
                    .catch(function (error) {
                        console.log("response", error);
                    });

                return false;
            },
            removeSaveImage(removedata){            
            axios
            .post("/photoremove", removedata)
            .then((response) => {
               location.href = "/photohouse/"+this.houseview.house_id;
            })
            .catch(function (error) {
                console.log("response", error);
            });
        },
        },
    };
</script>

<style>
    .btn-width {
        width: 130px;
    }
</style>
