
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
 <div class="div">
        <div class="wrapper singin">
            <form id="loginForm" action="login_process.php" method="post">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name="singInUserName" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="SinginPass" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" name="Singin" class="btn">Login</button>
                <div class="singup">
                    <p>Don't have an account <a href="#" id="signupLink" class="singupbtn">Signup</a></p>
                </div>
                <div class="social-platform">
                    <p>Or sign in with</p>
                    <div class="social-icon">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="wrapper singup">
            <form id="signupForm" action="signup.php" method="post">
                <h1>Signup</h1>
                <div class="input-box">
                    <input type="text" name="fname" placeholder="First Name" pattern="[A-Za-z][A-Za-z0-9_]*">
                </div>
                <div class="input-box">
                    <input type="text" name="lname" placeholder="Last Name" required pattern="[A-Za-z][A-Za-z0-9_]*">
                </div>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required pattern="[A-Za-z][A-Za-z0-9_]*" title="Username must start with a letter and can contain letters, numbers, or underscores">
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required minlength="8">
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" name="Singup" class="btn">Signup</button>
                <div class="singup">
                    <p>Already have an account <a href="#" id="signinLink" class="singinbtn">Signin</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
