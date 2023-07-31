<template>
    <div class="container">
        <div class="form-container" id="forgot-password-form">
            <h1 style="font-size: 2.5rem; font-weight:500;">Reset Password</h1>
            <form @submit.prevent="resetPassword">
                <input type="email" v-model="user.email" placeholder="Email" required>
                <input type="password" v-model="user.newPassword" placeholder="New Password" required>
                <input type="password" v-model="user.confirmPassword" placeholder="Confirm Password" required>
                <button type="submit">Reset Password</button>
            </form>
            <router-link to="/login">
                <p style="margin-top: 20px;"><a href="#" id="login-link" style="font-weight: bold;">Go back to login</a></p>
            </router-link>
        </div>
    </div>
</template>
  
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: {
                email: '',
                newPassword: '',
                confirmPassword: ''
            }
        }
    },
    methods: {
        resetPassword() {
            // add validation to check if newPassword === confirmPassword
            if (this.user.newPassword === this.user.confirmPassword) {
                axios.put("http://127.0.0.1:8000/api/reset-password", this.user)
                    .then(
                        ({ data }) => {
                            try {
                                if (data.status === true) {
                                    this.$toasted.show("Password reset successfully", {
                                        theme: "outline",
                                        position: "top-right",
                                        duration: 2000,
                                        type: "success"
                                    });
                                    this.$router.push({ name: 'Login' })
                                } else {
                                    this.$toasted.show("Password reset failed", {
                                        theme: "outline",
                                        position: "top-right",
                                        duration: 2000,
                                        type: "error"
                                    });
                                }
                            } catch (err) {
                                this.$toasted.show("Error, please try again", {
                                    theme: "outline",
                                    position: "top-right",
                                    duration: 2000,
                                    type: "error"
                                });
                            }
                        }
                    )
            }
            else {
                alert("Passwords do not match");
            }
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
  