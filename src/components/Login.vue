

<template>
  <div class="container">
    <div class="form-container" id="login-form">
      <h1 style="font-size: 2.5rem; font-weight:500;">Login</h1>
      <form @submit.prevent="LoginData">
        <label>Email</label>
        <input type="email" v-model="user.email" placeholder="Email" required>
        <label>Password</label>
        <input type="password" v-model="user.password" placeholder="Password" required>
        <button type="submit">Login</button>
      </form>
      <router-link to="/forgot-password">
        <p style="margin-top: 20px;"><a href="#" id="signup-link" style="font-weight: bold;">Forgot Password?</a></p>
      </router-link>

      <router-link to="/register">
        <hr style="margin-top: 40px;">
        <p>Don't have an account? <a href="#" id="signup-link" style="font-weight: bold;">Sign up</a></p>
      </router-link>
    </div>
  </div>
</template>
 
<script>
import { useToast } from 'vue-toastification'

import Vue from 'vue';
import axios from 'axios';

Vue.use(axios)

export default {
  name: 'Registration',
  data() {
    return {
      result: {},
      user: {
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
    LoginData() {
      axios.post("http://127.0.0.1:8000/api/login", this.user)
        .then(({ data }) => {
          try {
            if (data.status === true) {
              // Show toast on successful login
              this.$toasted.show("Login Success", {
                theme: "outline",
                position: "top-right",
                duration: 2000,
                type: "success"
              });
              // Store name in local storage
              localStorage.setItem("loggedInUser", data.first_name + ' ' +data.last_name)
              localStorage.setItem("loggedInUserId", data.id)
              this.$router.push({ name: 'Post' })
            } else {
              this.$toasted.show("Login Failed", {
                theme: "outline",
                position: "top-right",
                duration: 2000,
                type: "error"
              });
            }
          } catch (err) {
            let toast = this.$toasted.show("Error, please try again", {
              theme: "outline",
              position: "top-right",
              duration: 2000,
              type: "error"
            });
          }
        })
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