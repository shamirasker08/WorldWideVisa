<?php
// Tell the browser this is JSON (optional but good practice)
header('Content-Type: application/json');

try {
    require_once __DIR__ . '/components/Utility.php'; // Update this path

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $country = $_POST['country'] ?? '';
        $service = $_POST['service'] ?? '';
        $email = $_POST['email'] ?? '';

        if (!$name || !$phone || !$country || !$service || !$email) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit;
        }

        //$to = "shamirasker00@gmail.com"; // <-- change this
        $to = "worldwidevisa.wwv@gmail.com";
        $subject = "New Appointment Booking from $name";
        $body = "
                <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 0;
                            background-color: #f4f4f4;
                        }
                        .email-container {
                            width: 100%;
                            background-color: #ffffff;
                            padding: 20px;
                            margin: 0 auto;
                            max-width: 600px;
                        }
                        .header {
                            text-align: center;
                            margin-bottom: 20px;
                        }
                        .header img {
                            width: 150px;
                            height: auto;
                        }
                        .content-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-top: 20px;
                        }
                        .content-table td, .content-table th {
                            padding: 10px;
                            border: 1px solid #ddd;
                            text-align: left;
                        }
                        .content-table th {
                            background-color: #f2f2f2;
                            font-weight: bold;
                        }
                        .footer {
                            text-align: center;
                            margin-top: 20px;
                            font-size: 12px;
                            color: #777;
                        }
                    </style>
                </head>
                <body>
                    <div class='email-container'>
                        <div class='header'>
                            <img src='https://shamirasker.netlify.app/logo.png' alt='World Wide Visa'>
                        </div>
                        <h3>Appointment Request</h3>
                        <table class='content-table'>
                            <tr>
                                <th>Name</th>
                                <td>$name</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>$phone</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>$email</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>$country</td>
                            </tr>
                            <tr>
                                <th>Service</th>
                                <td>$service</td>
                            </tr>
                        </table>
                        <div class='footer'>
                            <p>&copy; " . date('Y') . " Your Company. All rights reserved.</p>
                        </div>
                    </div>
                </body>
                </html>
            ";

        $reply = Utility::sendEmail($to, $subject, $body);

        if ($reply === 'success') {
            echo json_encode(['success' => true, 'message' => 'Your appointment has been submitted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => $reply]);
        }
    }
} catch (Throwable $e) {
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
?>
