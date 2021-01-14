<template>
    <!-- Main content -->
    <div class="main-content mt-1" id="panel">
        <!-- Topnav -->

        <!-- Page content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label" for="state">State</label>
                        <select class="form-control" id="state" v-model="searchState" @change="onChange()">
                            <option value="">All</option>
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
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="state">Search</label>
                        <input class="form-control" type="text" v-model="searchQuery" placeholder="Search" />
                    </div>
                </div>
            </div>

            <div class="row card-wrapper">
                <div class="col-lg-3" v-for="(service, key) in resultQuery" :key="key">
                    <div class="card">
                        <img class="card-img-top" v-bind:src="service.photo" alt="Image placeholder" />
                        <div class="card-body">
                            <h3>{{service.name}}</h3>
                            <p class="card-text">Rating: {{service.rating}}</p>
                            <p class="card-text">Contact: {{service.contact}}</p>
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
                searchQuery: "",
                searchState: "",
                tempservicelist: "",
                servicelist: [
                    {
                        photo: "/images/1.jpg",
                        name: "Vihana Electric Service",
                        rating: "5/5",
                        contact: "0123236765",
                        state: "Perak",
                    },
                    {
                        photo: "/images/pumber.jpg",
                        name: "Rock Plumbing Service",
                        rating: "5/5",
                        contact: "0103711122",
                        state: "Selangor",
                    },
                    {
                        photo: "/images/2.jpg",
                        name: "Ong Aircond Service",
                        rating: "5/5",
                        contact: "0197864301",
                        state: "Selangor",
                    },
                    {
                        photo: "/images/default.png",
                        name: "Beautiful Painting",
                        rating: "5/5",
                        contact: "0119007654",
                        state: "Selangor",
                    },
                ],
            };
        },
        computed: {
            resultQuery() {
                if (this.searchQuery && !this.searchState) {
                    return this.servicelist.filter((item) => {
                        return this.searchQuery
                            .toLowerCase()
                            .split(" ")
                            .every((v) => item.name.toLowerCase().includes(v));
                    });
                } 
                else if (!this.searchQuery && this.searchState) {
                    return this.servicelist.filter((item) => {
                        return this.searchState
                            .toLowerCase()
                            .split(" ")
                            .every((v) => item.state.toLowerCase().includes(v));
                    });
                } 
                else if (this.searchQuery && this.searchState) {
                    this.tempservicelist = this.servicelist.filter((item) => {
                        return this.searchQuery
                            .toLowerCase()
                            .split(" ")
                            .every((v) => item.name.toLowerCase().includes(v));
                    });
                    return this.tempservicelist.filter((item) => {
                        return this.searchState
                            .toLowerCase()
                            .split(" ")
                            .every((v) => item.state.toLowerCase().includes(v));
                    });
                } 
                
                else 
                
                {
                    return this.servicelist;
                }
            },
        },
        methods: {
            onChange() {},
        },
    };
</script>

<style scoped>
    .card-img-top {
        width: 100%;
        height: 250px;
        border-top-left-radius: calc(0.375rem - 1px);
        border-top-right-radius: calc(0.375rem - 1px);
    }
</style>
