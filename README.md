# **Authentication Form Application**

This application uses Vue 2 and Bootstrap on the frontend for an interactive and responsive UI. The backend is built with Laravel which uses MySQL for data management.

## **Live Demo**

For a live demo of the application, please visit: [**https://your-authentication-form.web.app/**](https://your-authentication-form.web.app/)

![main page](https://github.com/DarrelMendoza/authentication-form/assets/88825804/12506d53-77d1-4a16-bc6b-f6b8ca60c6ad)


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
![main page](https://github.com/DarrelMendoza/authentication-form/assets/88825804/b949ac22-f181-428f-a291-a00fef203dab)

### **Registration Form**
![registration](https://github.com/DarrelMendoza/authentication-form/assets/88825804/d6534bc0-220c-406f-bae1-307f3a007b3f)

### **Login Form**
![login](https://github.com/DarrelMendoza/authentication-form/assets/88825804/a60f191f-72aa-4bfc-a171-b7c955330683)

### **Reset Password**
![reset password](https://github.com/DarrelMendoza/authentication-form/assets/88825804/5b317f3b-79b6-4a6b-a0ff-0490fea18278)

### **Create a Post**
![create post](https://github.com/DarrelMendoza/authentication-form/assets/88825804/be240eac-fbc9-4a81-9bdc-39bcc1dafd45)

### **Edit a Post**
![edit post](https://github.com/DarrelMendoza/authentication-form/assets/88825804/efb5d286-3c94-47b5-9c9d-78ec4afeced5)

### **Delete a Post**
![delete post](https://github.com/DarrelMendoza/authentication-form/assets/88825804/a998b0cc-c03e-42b7-94ed-b71299d863f4)

### **Edit Account Details**
![edit details](https://github.com/DarrelMendoza/authentication-form/assets/88825804/9297abaa-1631-40f1-b2f5-a1d2fffb8ad0)

### **Edit Account Password**
![change password](https://github.com/DarrelMendoza/authentication-form/assets/88825804/070507a0-d535-4b93-9dfb-e33a99ab325d)


## **Acknowledgements**

- **[Vue 2](https://vuejs.org/)**
- **[Bootstrap](https://getbootstrap.com/)**
- **[Laravel](https://laravel.com/)**
- **[MySQL](https://www.mysql.com/)**
- **[Firebase](https://www.firebase.com/)**

Feel free to fork this repository and enhance the application. 
