<script setup>
import {RouterLink} from 'vue-router'
</script>

<template>
  <div class="container">
    <h1> {{ items.length }} Users </h1>
    <link rel="stylesheet" type="text/css" href="/style.css"/>
    <div>
      <RouterLink class="btn btn-primary" to="/add-user">Add</RouterLink>
    </div>
    <br/>
    <table class="table  table-dark">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Transitions</th>
        <th>Actions</th>


      </tr>
      </thead>
      <tbody>
      <tr v-for="({ id,name ,email,phone, transactions }, index) in items" :key="index">
        <td>{{ id }}</td>
        <td>{{ name }}</td>
        <td>{{ email }}</td>
        <td>{{ phone }}</td>
        <td>{{ transactions }}</td>
        <td>
          <div>
            <RouterLink class="btn btn-sm btn-info" to="/edit-user">Edit</RouterLink>
            <button class="btn btn-sm btn-danger">
              Delete
            </button>
          </div>
        </td>

      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  mounted() {
    fetch("http://localhost:8080/api/v1/users")
        .then((response) => response.json())
        .then((data) => (this.items = data));
  },
  data() {
    return {
      showModal: false,
      items: [],
    };
  },
};

</script>
