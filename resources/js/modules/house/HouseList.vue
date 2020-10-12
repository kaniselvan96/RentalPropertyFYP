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
              <h3 class="mb-0">List of House</h3>
            </div>
            <div class="table-responsive py-4">
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
                    <td><a v-bind:href="'/viewhouse/'+ house.house_id" class="btn btn-sm btn-info mr-4">View</a></td>
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
