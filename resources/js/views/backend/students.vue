<template>
  <div class="bg-white bg-gradient pt-3 pb-3 px-4 them-bg d-flex justify-content-between align-items-center shadow-lg">
    <h5 class="text-uppercase  mb-0">Student</h5>
    <button class="btn btn-outline-dark custom-btn rounded-0">+ Add New</button>
  </div>

  <div class="pt-2">
    <div class="table-responsive shadow-sm rounded">
      <div class="d-flex  align-items-center">
        <div class="p-3">
          <select v-model="formFilter.class_id" class="custom-select">
            <option value="">select</option>
            <option value="1">Class 1</option>
            <option>Class 2</option>
            <option>Class 3</option>
            <option>Class 4</option>
            <option>Class 5</option>
            <option>Class 6</option>
            <option>Class 7</option>
            <option>Class 8</option>
            <option>Class 9</option>
            <option>Class 10</option>
          </select>
        </div>
        <button class="btn btn-outline-dark rounded-0">Filtar</button>
      </div>
      <table class="table table-hover align-middle">
        <thead class="bg-dark text-white">
        <tr>
          <th>#</th>
          <th>Video Title</th>
          <th>Views</th>
          <th>Likes</th>
          <th>Comments</th>
          <th>Upload Date</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>1</td>
          <td>My First Video</td>
          <td>1.2K</td>
          <td>320</td>
          <td>45</td>
          <td>Jan 20, 2025</td>
          <td>
            <button class="btn btn-sm btn-primary">Edit</button>
            <button class="btn btn-sm btn-danger">Delete</button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Vue.js Tutorial</td>
          <td>3.5K</td>
          <td>1.1K</td>
          <td>230</td>
          <td>Feb 1, 2025</td>
          <td>
            <button class="btn btn-sm btn-primary">Edit</button>
            <button class="btn btn-sm btn-danger">Delete</button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import $ from "jquery";
import "select2/dist/css/select2.min.css";
import "select2/dist/js/select2.min.js";
export default {
    name: "students",
    methods: {

    },
    mounted() {
        this.formFilter.class_id = '1';
    }
}
</script>

<style >

</style>
