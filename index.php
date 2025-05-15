<a?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medicare Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #2E8B57;
            color: white;
            padding: 15px 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .sidebar {
            width: 220px;
            background: #2E8B57;
            color: white;
            position: fixed;
            top: 60px;
            left: 0;
            height: 100%;
            padding-top: 60px;
            font-family: Arial, sans-serif;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            letter-spacing: 1px;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: white;
            font-size: 16px;
            transition: background-color 0.3s, padding-left 0.3s, font-weight 0.3s;
        }
        .sidebar a:hover {
            background-color: #00509e;
            padding-left: 25px;
            font-weight: bold;
        }
        .sidebar a:active {
            background-color: #2E8B57;
        }
        .main {
            margin-left: 240px;
            padding: 20px;
        }
        .button-group {
            margin-top: 20px;
        }
        .button-group button {
            padding: 10px 20px;
            margin-right: 10px;
            background: #2E8B57;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .button-group button:hover {
            background: #246b45;
        }
        .chart {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .last-chat, .patient-history {
            margin-top: 30px;
        }
        .last-chat input[type="text"] {
            padding: 8px;
            width: 100%;
            margin-bottom: 10px;
        }
        .patient-history .chart {
            display: inline-block;
            width: 22%;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo">MEDICARE</div>
        <nav>
            
            
        </nav>
    </div>

    <!-- Sidebar Section -->
    <div class="sidebar">
    <h2>MEDICARE</h2>
    <a href="index.php">🏠 Dashboard</a>
    <a href="schedule-form.php">📅 Schedule</a>
    <a href="appointment-list.php">📋 Appointments</a>
    <a href="about.php">ℹ️ About Us</a>
    <a href="services.php">🛠️ Services</a>
    <a href="contact.php">📞 Contact</a>
    <a href="logout.php" style="color: #ff4d4d;">🚪 Log Out</a>
</div>

    <!-- Main Content Section -->
    <div class="main">
        <h3>Good Morning, 
            <?php 
                echo isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : 'Guest'; 
            ?>!
        </h3>

        <!-- Button Group -->
<div class="button-group">
    
    <!-- Patient Registration Toggle Button -->
    <button onclick="toggleForm()">📝 Register Patient</button>
</div>

<!-- Hidden Form Container -->
<div id="patient-form-container" style="display: none; margin-top: 20px;">
    <?php include 'patient_form.php'; ?>
</div>

<script>
function toggleForm() {
    var formDiv = document.getElementById('patient-form-container');
    formDiv.style.display = formDiv.style.display === 'none' ? 'block' : 'none';
}
</script>

        <!-- Last Chat Section -->
        <div class="last-chat">
            <h4>Last Chat</h4>
            <input type="text" placeholder="Search Doctor...">
            <ul>
                <li>Dr. John Cruz</li>
                <li>Dr. Maria Lopez</li>
                <li>Dr. Daniel Reyes</li>
            </ul>
        </div>

        <!-- Patient History Section -->
        <div class="patient-history">
            <div class="chart">In-Patient Records</div>
            <div class="chart">Scheduled Appointments</div>
            <div class="chart">Out-Patient Consults</div>
            <div class="chart">Consultancy Requests</div>
        </div>
    </div>
</body>
</html>