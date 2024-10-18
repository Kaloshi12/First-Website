<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</head>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family:'Poppins',sans-serif;
        
    }

    .contact{
        position: relative;
        min-height: 100vh;
        padding: 0 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background: url('https://img.freepik.com/free-photo/view-boat-floating-water-with-nature-scenery_23-2150693374.jpg');
        background-size: cover;
    }
    .contact .content{
        max-width: 800px;
        text-align: center;
    }

#title{
    font-size: 50px;
    font-weight: 500;
    margin-right: 550px;
    color: #fff;
    position: relative;
}
.contact .content p{
    font-weight:300;
    color: #fff;   
}
.container{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    top: -30px;
}
.container .contactInfo{
    width: 50%;
    display: flex;
    flex-direction: column;
}
.container .contactInfo .box{
    position: relative;
    padding: 20px 0;
    display: flex;
}
.container .contactInfo .box .icon{
    min-width: 60px;
    height: 60px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 30px;
}
.container .contactInfo .box .text{
    display: flex;
    margin-left: 20px;
    font-size: 20px;
    color: #fff;
    flex-direction: column;
    font-weight: 300;
}
.container .contactInfo .box .text h3{
    font-weight: 500;
    color:#00bcd4;
}

.contactForm{
    width: 40%;
    padding: 40px;
    background: #fff;
}
.contactForm h2{
    font-size: 30px;
    color: #333;
    font-weight: 500;
}

.contactForm .inputBox{
    position: relative;
    width: 100%;
    margin-top: 10px;
}
.contactForm .inputBox input,
.contactForm .inputBox textarea{
    width: 100%;
    padding: 5px 0;
    font-size: 20px;
    margin: 10px 0;
    border: none;
    border-bottom: 2px solid #333;
    outline: none;
}
.contactForm .inputBox span{
    position: absolute;
    left: 0;
    padding: 5px 0;
    font-size: 15px;
    margin: 10px 0;
    pointer-events: none;
    transition: 0.5s;
    color: #666;

}
.contactForm .inputBox input:focus~span{
    color: #3A36AF;
    font-size: 15px;
    transform: translateY(-20px);
}

.contactForm .inputBox1{
    position: relative;
    width: 100%;
    margin-top: 10px;
}
.contactForm .inputBox input,
        .contactForm .inputBox textarea {
            width: 100%;
            padding: 5px 0;
            font-size: 20px;
            margin: 10px 0;
            border: none;
            border-bottom: 2px solid #333;
            outline: none;
        }
        .contactForm .inputBox span,
        .contactForm .inputBox textarea~span {
            position: absolute;
            left: 0;
            padding: 5px 0;
            font-size: 15px;
            margin: 10px 0;
            pointer-events: none;
            transition: 0.5s;
            color: #666;
        }
        .contactForm .inputBox input:focus~span,
        .contactForm .inputBox input:valid~span,
        .contactForm .inputBox textarea:focus~span,
        .contactForm .inputBox textarea:valid~span {
            color: #3A36AF;
            font-size: 15px;
            transform: translateY(-20px);
        }
.contactForm .inputBox button {
            width: 100px;
            background: #00bcd4;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 10px;
            font-size: 16px; 
            border-radius: 5px; 
            transition:  0.3s ease;
        }
        .contactForm .inputBox button:hover {
            background: #0097a7;
        }
        @media(max-width: 991px){
            .contact{
                padding: 50px;
            }
            .container{
                flex-direction: column;
            }
            .container .contactInfo {
                margin-bottom: 40px;
            }
            .contact .contactInfo{
                width: 100%;
            }
        }
            
        
</style>
<?php
    require_once('header.php');
?>
<body>
    <section class="contact">
        <div class="content">
            <h2 id="title">Contact Us</h2>
                </div>
        <div class="container">
            <div class="contactInfo">
                <div class="box">
                    <div class="icon"> <i class='bx bxs-map'></i></div>
                    <div class="text">
                        <h3>Address</h3>
                        <p>Vore, Rruga Tiranë - Rinas, Km 12, Tiranë,<br> Tiranë 1000 · 12 km</p>
                    </div>
                </div>
                <div>
                <div class="box">
                    <div class="icon"> <i class='bx bxs-phone'></i></div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p>068 829 6261</p> 
                    </div>
                </div>
                <div class="box">
                    <div class="icon"> <i class='bx bx-envelope'></i></div>
                    <div class="text">
                        <h3>Email</h3> 
                        <p>fkaloshi22@epoka.edu.al</p> 
                    </div>
                </div>
                </div>
                </div>
               
                <div class="contactForm">
                <form action="applyprocess.php" method="post">
    <h2>Send Message</h2>
    <div class="inputBox">
        <input type="text" name="fname" required="required"  pattern="[A-Za-z][A-Za-z0-9_]*">
        <span>Name</span>
    </div>
    <div class="inputBox">
        <input type="text" name="lname" required="required"  pattern="[A-Za-z][A-Za-z0-9_]*">
        <span>Surname</span>
    </div>
    <div class="inputBox">
        <input type="email" name="email" required="required">
        <span>Email</span>
    </div>
    <div class="inputBox">
        <input type="text" name="phonenumber" required pattern="[0-9]{3} [0-9]{3} [0-9]{4}">
        <span>Phone number</span>
    </div>
    <br>
    <br>
    <div class="inputBox1">
        <input type="date" name="birthdate" required>
        <span>Birthday</span>
    </div>
    <br>
    <br>
    <div class="inputBox1">
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <span style="bottom: 30px;">Gender</span>
    </div>
    <div class="inputBox">
        <textarea name="appLetter" required></textarea>
        <span>Message</span>
    </div>
    <div class="inputBox">
        <button type="submit" name="submit" value="send">Send</button>
    </div>
</form>
                </div>
        </div>

        </section>
</body>
</html>