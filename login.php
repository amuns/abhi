<?php 
    @session_start();
    require "./utils.php";
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="./css/app.css">
</head>

<body>
    <div class="login-wrapper">
        <!-- Left column: welcome + form -->
        <div class="login-form">
            <div class="form">
                <form method="POST" action="login-process.php">
                    <img class="logo" src="./img/logo.png" alt="FBMD logo">
                    <h2 class="title">FBMD</h2>
                    <p class="subtitle"><i>"Seconds <span style="color: #2663A7;">Save</span> <span style="color: #51A75E;">Lives</span>"</i></p>

                    <h3>Welcome Back</h3>
                    <p class="form-intro">Enter your email, password and user type to access your account.</p>

                    <?=flashMessages()?>

                    <label class="field-label" for="email">Email</label>
                    <input id="email" type="email" placeholder="you@example.com" name="email" required>

                    <label class="field-label" for="pw">Password</label>
                    <div class="password-field">
                        <input type="password" placeholder="Enter your password" name="password" id="pw" required>
                        <button type="button" class="password-toggle" id="toggle" aria-label="Toggle password visibility">
                            <img src="./img/hide-eye-icon.png" alt="Toggle password visibility">
                        </button>
                    </div>

                    <label class="field-label" for="role">User Type</label>
                    <select id="role" name="role" required>
                        <option disabled selected>-- Select user type --</option>
                        <option value="ADMIN">Admin</option>
                        <option value="FRESPONDER">First Responder</option>
                        <option value="DOCTOR">Doctor</option>
                        <option value="RECEPTIONIST">Receptionist</option>
                        <option value="PATIENT">Patient</option>
                    </select>

                    <div class="form-row-between">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-password">Forgot your password?</a>
                    </div>

                    <button type="submit" class="primary-btn">Log In</button>
                </form>
            </div>
        </div>

        <!-- Right column: blue hero with placeholder rectangle -->
        <div class="login-image">
            <div class="hero-content">
                <h2 class="hero-title">Effortlessly manage your team and operations.</h2>
                <p class="hero-subtitle">Log in to access your CRM dashboard and manage your team.</p>
                <div class="hero-placeholder">
                    <span>Dashboard preview placeholder</span>
                </div>
            </div>
        </div>
    </div>

    <script>
    const pwBtn = document.querySelector('#pw');
    const toggleBtn = document.querySelector('#toggle');
    if (toggleBtn && pwBtn) {
        toggleBtn.addEventListener('click', () => {
            pwBtn.type = pwBtn.type === "password" ? "text" : "password";
        });
    }
    </script>
</body>

</html>