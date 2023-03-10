<script setup></script>

<template>
  <div class="container">
    <h1> Add User</h1>
    <form>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name"
               placeholder="Enter Name" v-model="name">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1"
               placeholder="Enter email" v-model="email">
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone"
               placeholder="Enter Phone" v-model="phone">
      </div>
      <br/>
      <button type="submit" class="btn btn-primary" @click="add">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  setup() {


  },
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      items: [],
    };
  },
  methods: {
    async add(e) {
      e.preventDefault();

      async function postData(url = "", data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
          method: "POST", // *GET, POST, PUT, DELETE, etc.
          mode: "cors", // no-cors, *cors, same-origin
          cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
          credentials: "same-origin", // include, *same-origin, omit
          headers: {
            "Content-Type": "application/json",
            // 'Content-Type': 'application/x-www-form-urlencoded',
          },
          redirect: "follow", // manual, *follow, error
          referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
          body: JSON.stringify(data), // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
      }

      postData("http://localhost:8080/api/v1/users/add", {
        name: this.name,
        phone: this.phone,
        email: this.email
      })
          .then((response) =>
              response.json()
          )
          .then((messages) => {
            this.name = '';
            this.phone = '';
            this.email = '';
            window.location.href = '/users';
            console.log(messages);
            alert(messages)
          });


    }
  }
};

</script>