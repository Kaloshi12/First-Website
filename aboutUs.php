<?php 
session_start();
if (isset($_SESSION["username"]) && isset($_SESSION["access_level"])) {
    if ($_SESSION["access_level"] == "developer") {
        require_once "headerDev.php";
    } elseif ($_SESSION["access_level"] == "owner") {
        require_once "headerOwner.php";
    }
} else {
    require_once "header.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .center-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        hr.separator {
            width: 100%;
            border: 1px solid #dee2e6;
        }

        .center-container1 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 1000px;
        }
        hr.separator {
            width: 100%;
            border: 1px solid #dee2e6;
        }
        .large-button {
            font-size: 1.2rem;
            padding: 10px 20px;
            background: linear-gradient(45deg, #007bff, #00d4ff);
            border: none;
            color: white;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .large-button:hover {
            background: linear-gradient(45deg, #0056b3, #00a6cc);
            color: white;
        }
        .about-title {
            color: #007bff;
        }
        .about-text {
            font-size: 1.1rem;
        }
    </style>
</head>
<body style="background-color: azure;">
    <div>
        <div class="container center-container mt-5">
            <h2 class="text-center about-title">About us</h2>
            <h6 class="text-center mb-4 about-text">Your source for the latest stories and programs from around the world!</h6>
            <div>
                <img src="images/logo.png" height="95%" width="95%">
            </div>
        </div>
        <div class="container center-container1 mt-5">
            <h6 class="text-center mb-4">
                Welcome to Thashetheme, your comprehensive destination for the latest updates and insights from around the world. At Thashetheme, we pride ourselves on delivering a diverse array of news categories to keep you informed and engaged. Whether you're passionate about sports, intrigued by global politics, curious about economic trends, or looking for lifestyle inspiration, our platform is designed to cater to your interests. Our dedicated team of journalists and editors works tirelessly to provide accurate, timely, and insightful reporting on the stories that matter most to you.
                <br><br>
                Our mission at Thashetheme is to be your trusted news companion, offering in-depth coverage and analysis across a broad spectrum of topics. From breaking news to detailed feature articles, our content is crafted to engage readers with various interests and perspectives. Our world news section keeps you updated on international events and issues, while our economy segment provides expert insights into financial markets and economic policies. In our lifestyle section, you'll find everything from health and wellness advice to the latest in entertainment and culture, ensuring a well-rounded reading experience.
                <br><br>
                In addition to our extensive news coverage, Thashetheme offers a live stream service that brings breaking news directly to you as it happens. Our live stream features real-time updates and special programming, ensuring you never miss a crucial moment. Whether it’s a significant political development, a major sports event, or an unfolding natural disaster, our live stream is your go-to source for up-to-the-minute information. This service is designed to keep you connected with the world, providing instant access to critical news as it unfolds.
                <br><br>
                At Thashetheme, we believe in the power of information to shape our world. Our commitment to journalistic integrity, balanced reporting, and diverse perspectives ensures that our readers receive a well-rounded view of current events. Thank you for choosing Thashetheme as your primary news source. Stay informed, stay connected, and stay ahead with Thashetheme.
            </h6>
            <hr>
            <h5>Stay informed today!</h5>
            <br>
            <br>
            <div style="padding-top: 25px;">
                <a href="home.php" class="btn large-button">Home</a>
            </div>
        </div>
        <br>
    </div>
</body>
</html>
