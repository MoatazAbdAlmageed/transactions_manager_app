<script setup></script>

<template>
  <div class="container">
    <h1> {{ items.length }} users </h1>
    <table class="table">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>


      </tr>
      </thead>
      <tbody>
      <tr v-for="({ id,name }, index) in items" :key="index">
        <td>{{ id }}</td>
        <td>{{ name }}</td>

      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  mounted() {
    fetch("http://localhost:8080/api/v1/products")
        .then((response) => response.json())
        .then((data) => (this.items = data));
  },
  data() {
    return {
      items: [],
    };
  },
};

</script>