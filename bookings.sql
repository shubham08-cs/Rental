CREATE DATABASE IF NOT EXISTS bookings;
USE bookings;

CREATE TABLE IF NOT EXISTS bookings (
    car_type VARCHAR(100) NOT NULL,
    car_name VARCHAR(100) NOT NULL,
    rental_place VARCHAR(100) NOT NULL,
    return_place VARCHAR(100) NOT NULL,
    rental_date DATE NOT NULL,
    return_date DATE NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
