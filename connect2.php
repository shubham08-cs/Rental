<?php
// Database connection
$servername = "localhost";
$username   = "root";     // DB username
$password   = "";         // DB password
$dbname     = "bookings2"; // DB name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
// Collect form data
$car_type     = $_POST['car_type']     ?? '';
$car_name     = $_POST['car_name']     ?? '';  // ✅ FIXED
$rental_place = $_POST['rental_place'] ?? '';
$return_place = $_POST['return_place'] ?? '';
$rental_date  = $_POST['rental_date']  ?? '';
$return_date  = $_POST['return_date']  ?? '';
$name         = $_POST['name']         ?? '';
$email        = $_POST['email']        ?? '';
$phone        = $_POST['phone']        ?? '';

// Insert query
$sql = "INSERT INTO bookings2 
(car_type, car_name, rental_place, return_place, rental_date, return_date, name, email, phone)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssssss", 
    $car_type, $car_name, $rental_place, $return_place, 
    $rental_date, $return_date, $name, $email, $phone
);


// Ensure bookings table exists
$createTable = "
CREATE TABLE IF NOT EXISTS bookings2 (
    id INT AUTO_INCREMENT PRIMARY KEY,
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
)";
if (!$conn->query($createTable)) {
    die('❌ Failed to create table: ' . $conn->error);
}

// ============= ✅ FIX 1: Correct SQL with error check ============
$sql = "
    INSERT INTO bookings2 
    (car_type, car_name, rental_place, return_place, rental_date, return_date, name, email, phone)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
";

$stmt = $conn->prepare($sql);

// check if prepare failed
if (!$stmt) {
    die("❌ SQL Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssssssss", 
    $car_type, $car_name, $rental_place, $return_place, 
    $rental_date, $return_date, $name, $email, $phone
);

if ($stmt->execute()) {
    echo "✅ Record inserted into DB<br>";
} else {
    echo "❌ DB Insert Error: " . $stmt->error . "<br>";
}

$stmt->close();

// ============= ✅ FIX 2: Web3Forms API ============
$postData = [
    "access_key"   => "YOUR_REAL_ACCESS_KEY", // ⚠️ Replace with valid key from https://web3forms.com/
    "subject"      => "New Car Booking",
    "from_name"    => $name,
    "car_type"     => $car_type,
    "car_name"     => $car_name,
    "rental_place" => $rental_place,
    "return_place" => $return_place,
    "rental_date"  => $rental_date,
    "return_date"  => $return_date,
    "name"         => $name,
    "email"        => $email,
    "phone"        => $phone
];

// Send data to Web3Forms
$ch = curl_init("https://api.web3forms.com/submit");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/x-www-form-urlencoded",
    "Accept: application/json"
]);
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

$conn->close();



?>