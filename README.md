# **Authentication Form Application**

This application uses Vue 2 and Bootstrap on the frontend for an interactive and responsive UI. The backend is built with Laravel which uses MySQL for data management.

## **Live Demo**

For a live demo of the application, please visit: [**https://your-authentication-form.web.app/**](https://your-authentication-form.web.app/)

## **Technologies Used**

- Frontend: [**Vue 2**](https://vuejs.org/) and [**Bootstrap**](https://getbootstrap.com/)
- Backend: [**Laravel**](https://laravel.com/), and [**MySQL**](https://www.mysql.com/)
- Hosting: [**Firebase**](https://www.firebase.com/)

## **Getting Started**

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## **Table of Contents**

1. **[Installation](#installation)**
2. **[Running the Application](#running-the-application)**
3. **[Screenshots](#screenshots)**

## **Installation**

Here are the steps to install and setup the application.

### **Prerequisites**

- NodeJS
- Vue CLI
- Laravel
- MySQL

### **Clone Repository**
Clone the repository by running command:

```
git clone git@github.com:DarrelMendoza/authentication-form.git
```

### **Setting up the Backend**

The Laravel file named **`app.php`** is located in the **`api`** folder.


1. Install [**XAMPP**](https://www.apachefriends.org/download.html) for our MySQL database.
2. Open XAMPP control panel and start the Apache and MySQL services.
3. Navigate to **`http://localhost/phpmyadmin/`** on your browser.
4. Click on 'Import' and choose the exported database file from the **`db`** folder. Click 'Go' to import the database.
5. Install [**Laravel**](https://laravel.com/docs/8.x/installation) for our application's backend.
6. Navigate to the **`api`** folder.
7. Run **`composer install`** to install the required dependencies.
8. Run **`php artisan migrate`** to create the tables.

### **Setting up the Frontend**

Make sure that you have the Vue CLI installed globally. If not, install it using the following command:
```
npm install -g @vue/cli
```

1. Navigate to the root directory of the project.
2. Run **`npm install`** to install all the required dependencies.

## **Running the Application**

To run the application, you need to start both the backend and the frontend servers.

### **Running the Backend**

Navigate to the **`api`** folder.
Run the following command to start the server:

```
php artisan serve
```

You should now have your backend running on http://localhost:8000/.

### **Running the Frontend**

Navigate to the root directory of the project.
Run the following command to start the Vue dev server:

```
npm run dev
```
You should now have your frontend running on http://localhost:8080/.
Visit http://localhost:8080/ in your browser. Your application should be up and running.

## **Screenshots**

Below are some more screenshots demonstrating the features of the application.

### **Main Page**
![main](https://github.com/YourUsername/authentication-form/assets/88825804/c5364d87-c2d6-4c41-8268-bc8db461a864)

### **Registration Form**
![registration](https://github.com/YourUsername/authentication-form/assets/88825804/e12b7008-b9b9-4d82-a3df-6a35ac7d5440)

### **Login Form**
![login](https://github.com/YourUsername/authentication-form/assets/88825804/09f42ed4-68d4-4355-9642-34d6eae891ad)

### **Forgot Password**
![forgot_password](https://github.com/YourUsername/authentication-form/assets/88825804/bae250ed-4554-4a78-9fb4-47a2c32c1d2d)

## **Acknowledgements**

- **[Vue 2](https://vuejs.org/)**
- **[Bootstrap](https://getbootstrap.com/)**
- **[Laravel](https://laravel.com/)**
- **[MySQL](https://www.mysql.com/)**
- **[Firebase](https://www.firebase.com/)**

Feel free to fork this repository and enhance the application. 
