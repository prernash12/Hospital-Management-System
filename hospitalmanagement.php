<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Patient Registration
if(isset($_POST['register_patient'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO patients (name, age, gender) VALUES ('$name', '$age', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Patient registered successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle Appointment Scheduling
if(isset($_POST['schedule_appointment'])) {
    $patient_id = $_POST['patient_id'];
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];

    $sql = "INSERT INTO appointments (patient_id, doctor, date) VALUES ('$patient_id', '$doctor', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment scheduled successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle Billing and Invoicing
if(isset($_POST['generate_invoice'])) {
    $appointment_id = $_POST['appointment_id'];
    $problem_name = $_POST['problem_name'];
    $billing_amount = $_POST['billing_amount'];

    $sql_invoice = "INSERT INTO invoices (appointment_id, problem_name, billing_amount) VALUES ('$appointment_id', '$problem_name', '$billing_amount')";
    if ($conn->query($sql_invoice) === TRUE) {
        echo "Invoice generated successfully<br>";
    } else {
        echo "Error generating invoice: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hospital Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQquHf-LJ9RxiOBXxOQGJ3xSyrTDGUBL17Ru7hNy8qHrg&s');
            background-size: cover;
            background-position: center;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Patient Registration Form -->
    <div class="container">
        <h2>Patient Registration</h2>
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <input type="submit" name="register_patient" value="Register Patient">
        </form>
    </div>

    <!-- Appointment Scheduling Form -->
    <div class="container">
        <h2>Schedule Appointment</h2>
        <form action="" method="post">
            <label for="patient_id">Patient ID:</label>
            <input type="number" id="patient_id" name="patient_id" required>
            <label for="doctor">Doctor:</label>
            <input type="text" id="doctor" name="doctor" required>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            <input type="submit" name="schedule_appointment" value="Schedule Appointment">
        </form>
    </div>

    <!-- Billing and Invoicing Section -->
    <div class="container">
        <h2>Billing and Invoicing</h2>
        <form action="" method="post">
            <label for="appointment_id">Appointment ID:</label>
            <input type="number" id="appointment_id" name="appointment_id" required>
            <label for="problem">Problem Name:</label>
            <input type="text" id="problem_name" name="problem_name" required>
            <label for="billing_amount">Billing Amount:</label>
            <input type="number" id="billing_amount" name="billing_amount" required>
            <input type="submit" name="generate_invoice" value="Generate Invoice">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
