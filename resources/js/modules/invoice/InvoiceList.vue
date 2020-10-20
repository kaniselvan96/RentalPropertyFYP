<template>
  <!-- Main content -->
  <div class="main-content mt-1" id="panel">
    <!-- Topnav -->

    <!-- Page content -->
    <div class="container-fluid">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-xl-8">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Invoice List</h3>
                </div>
                <div class="col-4 text-right">
                  <!-- <a v-bind:href="'/createhouse/'" class="btn btn-sm btn-primary">Add</a> -->
                  <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-notification">Add</button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table id="meetingTable2" class="table table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>Invoice ID</th>
                    <th>Tenant Name</th>
                    <th>Rental Unit</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Reminder</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(invoices, key) in invoiceslist" :key="key">
                    <td>{{invoices.invoice_id}}</td>
                    <td>{{invoices.name}}</td>
                    <td>{{invoices.title}}</td>
                    <td>{{invoices.total}}</td>
                    <td>{{invoices.pay_date | formatDate}}</td>
                    <td>{{invoices.invoice_status}}</td>
                    <td>{{invoices.reminder}}</td>
                    <!-- <td><a v-bind:href="'/viewhouse/'+ house.house_id" class="btn btn-sm btn-info mr-4">View</a> <a v-bind:href="'/edithouse/'+ house.house_id" class="btn btn-sm btn-warning mr-4">Edit</a></td> -->
                  </tr>
                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
       <!-- model -->
         
        <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
          <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            
            <div class="modal-content bg-gradient-warning">
              <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" ref="closeVuemodal">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="py-3">
                    <form role="form" v-on:submit.prevent="formSubmit">
                      <div class="form-group mb-3">
                          <!-- <div class="form-group">
                              <label class="form-control-label" for="input-property_type">Professional</label>
                              <input type="text" id="input-property_type" class="form-control" placeholder="" v-model="professional"/>
                          </div>
                          <div class="form-group">
                              <label class="form-control-label" for="input-property_type">Move Date</label>
                              <input class="form-control" type="date" id="example-date-input" v-model="move_date">
                          </div> -->
                          <div class="form-group">
                              <label class="form-control-label" for="input-property_type">Choose House</label>
                                <select class="form-control" id="state" v-model="selected_house_id">
                                <option v-for="(house,key) in houselist" :value="house.house_id" :key="key">{{ house.title }}</option>
                              </select>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-white">Draft Invoice</button>
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
    props: ["houselist","invoiceslist"],
  components: {},
  created() {},
  data() {
    return {
      selected_house_id: "",
    };
  },
  computed: {},
  methods: {

      formSubmit(){
            // this.selectedID = house.house_id;
            // this.landlord_id = house.landlord_id;
            
            location.href = "/invoicecreate/"+this.selected_house_id;
        },
  },
};
</script>

<style scoped></style>
