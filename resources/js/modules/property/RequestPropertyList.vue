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
                                <span class="h2 font-weight-bold mb-0">{{pending}}</span>
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
                                <h5 class="card-title text-uppercase text-muted mb-0">Viewing</h5>
                                <span class="h2 font-weight-bold mb-0">{{viewing}}</span>
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
						<div class="card-header">
							<h5 class="h3 mb-0">Request list</h5>
						</div>
						<div class="card-body p-0">
							<div class="alert alert-success alert-dismissible fade show" role="alert" v-if="showAlert">
								<span class="alert-text"><strong>Success!</strong> status change</span>
								<button type="button" class="close" aria-label="Close" v-on:click="closeNotify()">
								<span aria-hidden="true">×</span>
								</button>
							</div>
							<!-- List group -->
							<ul class="list-group list-group-flush" data-toggle="checklist">
								<li class="checklist-entry list-group-item flex-column align-items-start my-2 px-4  bg-secondary"  v-for="(house, key) in requestpropertylist" :key="key">
									<div class="checklist-item checklist-item-success">
										<div class="checklist-info">
											<h5 class="checklist-title mb-0">{{house.title}}</h5>
											<small>{{house.name}}</small><br>
											<small>{{house.email}}</small><br>
											<small>{{house.phone}}</small><br>
											<small>{{house.move_date | formatDate}}</small><br>
											<small>{{house.professional}}</small><br>
										</div>
										<div class="form-group my-0 left-width">
											<label class="form-control-label" for="exampleFormControlSelect1">Status</label>
											<select class="form-control" id="exampleFormControlSelect1" v-model="house.request_status" @change="changesStatus(house)">
												<option>Pending</option>
												<option>Viewing</option>
												<option>Accepted</option>
												<option>Rejected</option>
											</select>
                                            <button class="btn btn-primary mt-2" type="button">Add Tenant</button>
										</div>
									</div>
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
export default {
    props: ["requestpropertylist"],
    components: {},
    created() {},
    data() {
        return {
            status : '',
            showAlert : false,
            pending : "",
            viewing : "",
            accepted : "",
            rejected : "",
        };
    },
    computed: {},
    methods: {
        closeNotify(){
            this.showAlert = false;
        },
        changesStatus(changeStatusData){            
            axios
            .post("/requestpropertystatus", changeStatusData)
            .then((response) => {
                console.log("response", response);
                this.showAlert = true;
                this.pending =response.data.pending;
                this.viewing =response.data.viewing;
                this.accepted=response.data.accepted;
                this.rejected=response.data.rejected;
            })
            .catch(function (error) {
                console.log("response", error);
            });
        },
    },

    mounted() {
        axios
            .post("/requestpropertymainstatus")
            .then((response) => {
                console.log("response", response);
                this.pending =response.data.pending;
                this.viewing =response.data.viewing;
                this.accepted=response.data.accepted;
                this.rejected=response.data.rejected;
            })
            .catch(function (error) {
                console.log("response", error);
            });
    }
};
</script>

<style scoped>

.left-width{
    width: 150px;
}

</style>
