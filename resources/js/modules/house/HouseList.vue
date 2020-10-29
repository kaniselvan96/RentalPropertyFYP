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
                  <h3 class="mb-0">Rental List</h3>
                </div>
                <div class="col-4 text-right">
                  <a v-bind:href="'/createhouse/'" class="btn btn-sm btn-primary">Add</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table id="meetingTable2" class="table table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>title</th>
                    <th>property type</th>
                    <th>property name</th>
                    <th>city</th>
                    <th>status</th>
                    <th>action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(house, key) in houselist" :key="key">
                    <td>{{house.title}}</td>
                    <td>{{house.property_type}}</td>
                    <td>{{house.property_name}}</td>
                    <td>{{house.city}}</td>
                    <td>{{house.status}}</td>
                    <td>
                      <a v-bind:href="'/viewhouse/'+ house.house_id" class="btn btn-sm btn-info mr-4">View</a> 
                      <a v-bind:href="'/edithouse/'+ house.house_id" class="btn btn-sm btn-warning mr-4">Edit</a>
                      <a v-bind:href="'/photohouse/'+ house.house_id" class="btn btn-sm btn-warning mr-4">Photo</a>
                      <a v-if="house.status == 'Tenant'" v-bind:href="'/viewtenant/'+ house.house_id" class="btn btn-sm btn-success mr-4">View Tenant</a>
                    </td>
                  </tr>
                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    props: ["houselist"],
  components: {},
  created() {},
  data() {
    return {
      houseAllList: this.houselist,
    };
  },
  computed: {},
  methods: {},
};
</script>

<style scoped></style>
