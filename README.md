# Big Burger Online Ordering System

## Project Overview
This online burger ordering system provides a comprehensive solution for customers to browse, order, and pay for food items from Big Burger restaurant. The platform includes both a user-facing interface for customers and an administrative backend for restaurant staff to manage orders, products, customers, and business analytics.

## Key Features

### Customer Features
- **User Registration/Login**: Secure authentication system for customers
- **Menu Browsing**: Categorized menu items with images, descriptions, and prices
- **Shopping Cart**: Add, remove, and modify quantities of food items
- **Checkout Process**: Complete with address input and payment method selection
- **Order Tracking**: View order status and history
- **Ratings & Feedback**: Submit ratings and feedback on food quality, service, and overall experience

### Administrative Features
- **Admin Dashboard**: Overview of key business metrics (total sales, pending orders, etc.)
- **Product Management**: Add, edit, delete menu items with images and descriptions
- **Order Management**: View, update status, and process customer orders
- **Customer Management**: View and manage customer accounts
- **Staff Management**: Manage restaurant staff accounts and permissions
- **Rating Management**: View and analyze customer feedback

## Technologies Used

### Frontend
- HTML5
- CSS3
- JavaScript
- Responsive design principles

### Backend
- PHP 7.4+
- MySQL Database

### Key Libraries/Frameworks
- Custom CSS styling and layouts
- Native PHP for server-side processing

### Security Features
- Password encryption using SHA1 hashing
- Session-based authentication
- Input validation and sanitization

## Installation Guide

1. **Prerequisites**:
   - Web server (Apachex)
   - PHP 7.4 or higher
   - MySQL 5.7 or higher

2. **XAMPP Setup**:
   - Download and install XAMPP from https://www.apachefriends.org/
   - Start the Apache and MySQL modules from the XAMPP Control Panel

3. **Project Setup**:
   - Clone or download this repository
   - Place the project folder in the `htdocs` directory of your XAMPP installation
     (e.g., `C:\xampp\htdocs\big-burger` on Windows or `/Applications/XAMPP/htdocs/big-burger` on Mac)

4. **Database Setup**:
   - Open phpMyAdmin by navigating to http://localhost/phpmyadmin in your web browser (Chrome/Microsoft Edge/Firefox)
   - Create a new database named `big_burger_db`
   - Import the provided SQL database file (`database/big_burger_db.sql`)
   - Configure database connection in `includes/dataconnection.php`:
     ```php
     $servername = "localhost";
     $username = "root"; // default XAMPP username
     $password = ""; // default XAMPP password is empty
     $dbname = "big_burger_db";
     ```

## System Requirements
- Modern web browser (Chrome, Firefox, Safari, Edge)
- Internet connection
