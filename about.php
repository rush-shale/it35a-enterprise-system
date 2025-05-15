<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Medicare</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .main {
            margin-left: 240px;
            padding: 30px;
            background-color: #f9f9f9;
            min-height: 100vh;
        }

        .about-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 900px;
            margin: auto;
        }

        .about-container h2 {
            font-size: 32px;
            color: #2E8B57;
            margin-bottom: 20px;
        }

        .about-container p {
            font-size: 18px;
            line-height: 1.8;
            color: #444;
        }

        .about-container .team {
            margin-top: 30px;
        }

        .about-container .team h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .about-container .team-members {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .about-container .team-member {
            background-color: #e6f2ff;
            padding: 15px;
            border-radius: 10px;
            flex: 1 1 250px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main">
    <div class="about-container">
        <h2>About us</h2>
        <p>
        
       Empowering Healthcare with Smart ERP Solutions
       At Medicare ERP, we are dedicated to transforming healthcare management through innovative, secure, and efficient enterprise resource planning (ERP) solutions. 
       Our system integrates patient records, billing, inventory, scheduling, and compliance tracking into one seamless platform—ensuring that medical professionals can focus on what truly matters: patient care.
        </p>
        <p>
        <h2>Mission</h2>   
        We strive to enhance healthcare efficiency by providing a user-friendly ERP system that streamlines operations, reduces administrative burden, and improves decision-making with real-time analytics.
        <h2>Trusted By Healthcare Prefessionals</h2>
        "Medicare ERP has significantly improved our workflow. Managing appointments, tracking inventory, and handling patient data has never been easier!" – Dr. Anna Mendoza, Medical Director
        </p>

        <div class="team">
            <h3>Our Team</h3>
            <div class="team-members">
                <div class="team-member">
                    <strong>John Rushel L. Hinoyog</strong><br>
                     Developer
                </div>
                <div class="team-member">
                    <strong>James Ivan Felicitas</strong><br>
                    UI/UX Designer X Developer
                </div>
                
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
