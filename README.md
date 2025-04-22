# EeseRent - Car Rental System

A web-based car rental application that allows users to browse, search, and book cars for rental. The system features user authentication, car browsing by category, booking management, and an admin dashboard.

## Features

- **User Authentication**
  - Registration and login functionality
  - Password recovery with email verification
  - User profile management

- **Car Browsing**
  - Search cars by make, model, and category
  - Browse cars by categories (Sedans, SUVs, Luxury, Sports, etc.)
  - Detailed car information pages

- **Booking System**
  - Book cars for specific dates and times
  - Select pickup and drop-off locations
  - View booking history and current bookings

- **Admin Dashboard**
  - Manage car inventory (add, edit, remove cars)
  - User management (view, ban users)
  - View and manage bookings
  - Update website content

## Technologies Used

- **Frontend**
  - HTML, CSS, JavaScript
  - Custom CSS for styling
  - FontAwesome for icons

- **Backend**
  - PHP
  - MySQL Database

- **Other**
  - XAMPP (Apache, MySQL, PHP)

## Installation

1. **Prerequisites**
   - XAMPP (or equivalent with Apache, MySQL, PHP)
   - Web browser

2. **Setup Steps**
   - Clone or download the repository to your XAMPP htdocs folder
   ```
   git clone <repository-url> /path/to/xampp/htdocs/car-rental
   ```
   - Start Apache and MySQL services in XAMPP
   - Import the database schema
     - Open PHPMyAdmin (http://localhost/phpmyadmin)
     - Create a new database named `rent_car`
     - Import the `rent_car.sql` file into the database
   - Access the website
     ```
     http://localhost/car-rental/Home.php
     ```

3. **Default Admin Credentials**
   - Email: admin@gmail.com
   - Password: Zz187702@$

## Directory Structure

- **CSS**: Contains all stylesheets
- **JS**: JavaScript files
- **Images**: Car images and website assets
- **Fonts**: Custom fonts for the website
- **PHP Files**: Main application files

## Main Pages

- **Home.php**: Landing page with search functionality and car categories
- **CarList.php**: List of available cars with filtering options
- **CarDetails.php**: Detailed information about a specific car
- **signIn.php/signUp.php**: User authentication pages
- **profileSettings.php**: User profile management
- **metronic_v6.1.0**: Admin dashboard interface

## Database Structure

The application uses the following main tables:
- `users`: Stores user account information
- `cars`: Contains car details and availability
- `booking`: Tracks current bookings
- `ex_booking`: Archive of expired bookings
- `about_us`: Website content for the About Us section

## Contributing

Contributions to improve the EeseRent car rental system are welcome. Please follow these steps:
1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgements

- FontAwesome for icons
- Metronic for admin dashboard template 
