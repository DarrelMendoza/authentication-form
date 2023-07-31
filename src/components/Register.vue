<template>
  <div class="container">
    <div class="form-container" id="login-form">
      <h1 style="font-size: 2.5rem; font-weight:500;">Signup</h1>
      <form @submit.prevent="saveData">

        <label for="name">First Name</label>
        <input type="text" v-model="user.first_name" id="first_name" name="first_name" required>

        <label for="name">Last Name</label>
        <input type="text" v-model="user.last_name" id="last_name" name="last_name" required>

        <label for="name">Address</label>
        <input type="text" v-model="user.address" id="address" name="address" required>

        <label for="email">Email</label>
        <input type="email" v-model="user.email" id="email" name="email" required>
        <label for="password">Password</label>
        <input type="password" v-model="user.password" id="password" name="password" required>
        <button type="submit" value="Save">Sign Up</button>
      </form>
      <router-link to="/login">
        <p>Already have an account? <a href="#" id="login-link" style="font-weight: bold;">Login</a></p>
      </router-link>
    </div>
  </div>
</template>
     
<script>
import Vue from 'vue';
import axios from 'axios';
Vue.use(axios)

export default {
  name: 'Register',
  data() {
    return {
      result: {},
      user: {
        first_name: '',
        last_name: '',
        address: '',
        email: '',
        password: ''
      }
    }
  },
  created() {
  },
  mounted() {
  },
  methods: {
    saveData() {
      axios.post("http://127.0.0.1:8000/api/register", this.user)
        .then(
          ({ data }) => {
            try {
              this.$toasted.show("Created Account", {
                theme: "outline",
                position: "top-right",
                duration: 2000,
                type: "success"
              });
              this.$router.push({ name: 'Login' })
            }
            catch (err) {
              this.$toasted.show("Failed", {
                theme: "outline",
                position: "top-right",
                duration: 2000,
                type: "error"
              });
            }
          }
        )
    }
  }
}
</script>


<style scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 80vh;
}

.form-container {
  width: 600px;
  margin: 0 auto;
  padding: 50px;
  background-color: #eff1f2;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  color: #212529;
  border: 1px solid #d2d2d2;
}

h1 {
  text-align: center;
  margin-bottom: 30px;
  font-size: 36px;
  color: #212529;
}

form {
  display: flex;
  flex-direction: column;
}

label {
  text-align: left;
  margin-bottom: 10px;
  margin-left: 15px;
  font-size: 18px;
}

input {
  padding: 12px;
  border: 1px solid #d2d2d2;
  border-radius: 5px;
  margin-bottom: 20px;
  font-size: 16px;
  color: #212529;
  background-color: #fff;
}

button {
  padding: 10px;
  background-color: #212529;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 18px;
  transition: background-color 0.2s ease-in-out;
}

button:hover {
  background-color: #424649;
}

a {
  text-decoration: none;
  color: #212529;
  font-size: 17px;
  transition: color 0.2s ease-in-out;
}

a:hover {
  color: #424649;
}

p {
  text-align: center;
  margin: 8px;
}
</style>