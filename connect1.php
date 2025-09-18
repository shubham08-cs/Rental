<?php
// Database connection
$servername = "localhost";
$username   = "root";     // your DB username
$password   = "";         // your DB password
$dbname     = "bookings"; // your DB name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// Collect form data safely
$car_type     = $_POST['car_type']     ?? '';
$car_name     = $_POST['car_name']     ?? '';
$rental_place = $_POST['rental_place'] ?? '';
$return_place = $_POST['return_place'] ?? '';
$rental_date  = $_POST['rental_date']  ?? '';
$return_date  = $_POST['return_date']  ?? '';
$name         = $_POST['name']         ?? '';
$email        = $_POST['email']        ?? '';
$phone        = $_POST['phone']        ?? '';

// ✅ INSERT query with car_name included
$sql = "INSERT INTO bookings (car_type, car_name, rental_place, return_place, rental_date, return_date, name, email, phone)
        VALUES ('$car_type', '$car_name', '$rental_place', '$return_place', '$rental_date', '$return_date', '$name', '$email', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "✅ Record inserted into DB<br>";
} else {
    echo "❌ DB Error: " . $conn->error . "<br>";
}

// Prepare data for Web3Forms
$postData = array(
    "access_key"   => "YOUR_VALID_ACCESS_KEY", // replace with your active Web3Forms key
    "subject"      => "New Car Booking",       // required by Web3Forms
    "from_name"    => $name,                   // required (sender's name)
    "from_email"   => $email,                  // required (sender's email)
    "message"      => "Car Type: $car_type\nCar Name: $car_name\nRental Place: $rental_place\nReturn Place: $return_place\nRental Date: $rental_date\nReturn Date: $return_date\nPhone: $phone"
);

// Send to Web3Forms API
$ch = curl_init("https://api.web3forms.com/submit");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/x-www-form-urlencoded",
    "Accept: application/json"
));
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo "HTTP Status: $http_code<br>";
}
curl_close($ch);

// Show Web3Forms response
echo $response;
