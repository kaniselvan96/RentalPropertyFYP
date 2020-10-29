<template>
  <!-- Main content -->
  <div class="main-content mt-1" id="panel">
    <!-- Topnav -->

    <!-- Page content -->
    <div class="container">


        <div class="row card-wrapper">

            <div class="col-lg-3" v-for="(house, key) in houselist" :key="key">
                <div class="card">
                    <img class="card-img-top" v-bind:src="'/images/'+ myhousephoto[key].photolink" alt="Image placeholder">
                    <div class="card-body">
                    <h3>{{ house.title | str_limit(21) }}</h3>
                    <p class="card-text">{{house.city}}</p>
                     
                        <button v-if="islogin > 0" v-bind:href="'/viewhouse/'+ house.house_id" @click="addToModel(house)" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-notification">Interested</button> 
                     
                        <a v-if="islogin == 0" v-bind:href="'/viewhouse/'+ house.house_id" class="btn btn-sm btn-info">Interested</a>
                      
                        <a v-bind:href="'/publicviewhouse/'+ house.house_id" class="btn btn-sm btn-warning">More</a>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- model -->
         
        <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
          <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            
            <div class="modal-content bg-success">
              <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">I am Interested</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" ref="closeVuemodal">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="py-3">
                    <form role="form" v-on:submit.prevent="formSubmit">
                      <div class="form-group mb-3">
                          <div class="form-group">
                              <label class="form-control-label" for="input-property_type">Professional</label>
                              <input type="text" id="input-property_type" class="form-control" placeholder="" v-model="professional"/>
                          </div>
                          <div class="form-group">
                              <label class="form-control-label" for="input-property_type">Move Date</label>
                              <input class="form-control" type="date" id="example-date-input" v-model="move_date">
                          </div>
                          <div class="form-group">
                              <label class="form-control-label" for="input-property_type">Duration (Years)</label>
                                <select class="form-control" id="state" v-model="duration">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-white">Send</button>
                          <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                      </div>
                    </form>
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
  props:["islogin"],
  components: {},
  created() {},
  data() {
    return {
      professional: "",
      move_date:"",
      selectedID:"",
      duration: "",
      landlord_id: "",
      houselist: "",
      myhousephoto: ""
    };
  },
  computed: {},
   mounted() {
            axios
                .post("/allhouse")
                // .post("/meeting", data)
                .then((response) => {
                    console.log("response", response);
                    this.houselist = response["data"]["myhouse"];
                    this.myhousephoto = response["data"]["myhousephoto"];
                })
                .catch(function (error) {
                    console.log("response", error);
                });


        },
  methods: {
        addToModel(house){
            this.selectedID = house.house_id;
            this.landlord_id = house.landlord_id;
        },
      
        formSubmit(event) {
        
        let houseData = {
          professional: this.professional,
          move_date: this.move_date,
          duration: this.duration,
          house_id: this.selectedID,
          landlord_id: this.landlord_id,
        };
        axios
          .post("/requestproperty", houseData)
          // .post("/meeting", data)
          .then((response) => {
            console.log("response", response);
            this.$refs.closeVuemodal.click();
          })
          .catch(function (error) {
            console.log("response", error);
          });
      },
    },
};


</script>

<style scoped>
.card-img-top {
    width: 100%;
    height: 250px;
    border-top-left-radius: calc(.375rem - 1px);
    border-top-right-radius: calc(.375rem - 1px);
}
</style>

