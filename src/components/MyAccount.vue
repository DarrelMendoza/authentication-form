<template>
    <div class="container mt-5 mb-5">
      <div class="d-flex justify-content-center row">
        <div class="d-flex flex-column col-md-8">
  
          <div class="logout-button"> <!-- New Logout Button -->
            <button class="my_account" type="button" >My Account</button>
            <button class="btn button" type="button" @click="logout">Logout</button>
          </div>
          <div class="back" style="cursor: pointer;" @click="back">
            <font-awesome-icon :icon="['fas', 'arrow-left']" style="float: left;" />
            <p style="float: left; margin-left: 20px;">Back</p>
            </div>
          <div class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
            <div class="d-flex flex-column ml-3">

              <div class="d-flex flex-row post-title" style="cursor: pointer; margin-top: 30px;">
                <h2 style="font-weight: 400;">My Account</h2>
              </div>
            </div>
          </div>
  
  
          <div class="coment-bottom bg-white p-2 px-4">
            <div class="post-input mt-4" style="border: 1px solid #d2d2d2; padding: 20px; border-radius: 5px;">
              <h4 class="mt-1" style="text-align: left;">Edit Account Details</h4>
                <form @submit.prevent="save" ref="form">
                    <label for="name" class="mt-2" style="float: left;">First Name</label>
                    <input v-model="firstName" type="text" class="comment-box mt-2" placeholder="First Name" rows="5">
                    <label for="name" class="mt-2" style="float: left;">Last Name</label>
                    <input v-model="lastName" type="text" class="comment-box mt-2" placeholder="Last Name" rows="5">
                    <label for="name" class="mt-2" style="float: left;">Address</label>
                    <input v-model="address" type="text" class="comment-box mt-2" placeholder="Address" rows="5">
                    <label for="email" class="mt-2" style="float: left;">Email</label>
                    <input v-model="email" type="email" class="comment-box mt-2" placeholder="Email" rows="5">

                    <button class="button mt-5" type="submit" style="width: 100%">Save</button>
                </form>
            </div>
          </div>
          <div class="coment-bottom bg-white p-2 px-4">
            <div class="post-input mt-4" style="border: 1px solid #d2d2d2; padding: 20px; border-radius: 5px;">
              <h4 class="mt-1" style="text-align: left;">Change Password</h4>
              <form @submit.prevent="updatePassword">
                <input v-model="newPassword" type="password" class="comment-box mt-2" placeholder="New Password" required>
                <input v-model="confirmPassword" type="password" class="comment-box mt-2" placeholder="Confirm Password" required>
                <button class="button mt-5" type="submit" style="width: 100%">Save</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
import axios from 'axios';
import { mapActions } from 'vuex';


export default {
  data() {
    return {
        loggedInUserId: localStorage.getItem("loggedInUserId"),
        userId: '', 
        firstName: '',
        lastName: '',
        address: '',
        email: '',    
        newPassword: '',
        confirmPassword: '',
    };
  },
  methods: {
    ...mapActions([
      'logout'
    ]),
    logout() {
      // Clear user from local storage
      localStorage.removeItem("loggedInUserId");

      // Redirect to login page
      this.$router.push({name: 'Login'});
    },
    back() {
      // Use Vue Router to navigate to the previous page
      this.$router.go(-1);
    },
    updatePassword() {
    if (this.newPassword === this.confirmPassword) {
      axios.put(`http://localhost:8000/api/update-password/${this.loggedInUserId}`, {
        password: this.newPassword
      })
      .then(response => {
        if (response.data.status) {
          this.$toasted.show("Password updated successfully", {
                theme: "outline",
                position: "top-right",
                duration: 2000,
                type: "success"
              });
        }
      })
      .catch(error => {
        this.$toasted.show("Failed please try again", {
                theme: "outline",
                position: "top-right",
                duration: 2000,
                type: "error"
              });
      });
    }
    else {
        this.$toasted.show("Passwords do not match", {
                theme: "outline",
                position: "top-right",
                duration: 2000,
                type: "error"
              });
    }
  },
    getUserDetails() {
      let loggedInUserId = localStorage.getItem("loggedInUserId");

      // Fetch user details from backend API
      axios.get(`http://localhost:8000/api/get-account/${loggedInUserId}`)
        .then(response => {
          if (response.data.status) {
            this.userId = response.data.user.id;
            this.firstName = response.data.user.first_name;
            this.lastName = response.data.user.last_name;
            this.address = response.data.user.address;
            this.email = response.data.user.email;
          }
        })
        .catch(error => {
            this.$toasted.show("Failed please try again", {
                theme: "outline",
                position: "top-right",
                duration: 2000,
                type: "error"
              });
        });
    },
    save() {
    axios.put(`http://localhost:8000/api/update-account/${this.loggedInUserId}`, {
        first_name: this.firstName,
        last_name: this.lastName,
        address: this.address,
        email: this.email
    })
    .then(response => {
        if (response.data.status) {
            this.$toasted.show("Account details updated successfully", {
                theme: "outline",
                position: "top-right",
                duration: 2000,
                type: "success"
              });
        }
    })
    .catch(error => {
        this.$toasted.show("Failed please try again", {
                theme: "outline",
                position: "top-right",
                duration: 2000,
                type: "error"
              });
    });
    localStorage.setItem("loggedInUser", this.firstName + ' ' +this.lastName)

    }
  },
  mounted() {
    this.getUserDetails();  // call this method when component is mounted
  }
};
</script>

  
  <style scoped>
  
  .my_account {
    background-color: white;
    border: none;
  }
  
  .my_account:hover {
    background-color: #fff;  /* light grey background on hover */
  }
  
  svg:focus {
    outline: none;
  }
  
  .back{
    justify-content: left;
  }
  
  .options-dropdown {
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }
  
  .options-dropdown ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  
  .options-dropdown ul li {
    padding: 12px 16px;
    cursor: pointer;
  }
  
  .options-dropdown ul li:hover {
    background-color: #ddd;
  }
  
  .comment-box {
    padding: 12px;
    border: 1px solid #d2d2d2;
    border-radius: 5px;
    font-size: 16px;
    color: #212529;
    background-color: #fff;
    width: 100%;
  }
  
  .logout-button {
    align-self: flex-end;
    /* Align the button to the right */
  }
  
  .post {
    padding: 20px;
    border: 1px solid #d2d2d2;
    border-radius: 5px;
  }
  
  .button {
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
  
  .bdge {
    height: 21px;
    background-color: #424649;
    color: #fff;
    font-size: 11px;
    padding: 8px;
    border-radius: 4px;
    line-height: 3px;
  }
  
  .comments {
    text-decoration: underline;
    text-underline-position: under;
    cursor: pointer;
  }
  .comment-text-sm h4, .comment-text-sm span {
      word-wrap: break-word;
  }
  
  </style>
  