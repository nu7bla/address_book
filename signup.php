<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($name) && !empty($email) && !empty($password)) {

        // ✅ Check password length (must be at least 8 characters)
        if (strlen($password) < 8) {
            $_SESSION["message"] = "Password must be at least 8 characters!";
            header("Location: signup.php");
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();

        if ($checkEmail->num_rows > 0) {
            $_SESSION["message"] = "Email already in use. Try another!";
            header("Location: signup.php");
            exit;
        } else {
            // Insert user into database
            $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $email, $hashedPassword);

            if ($stmt->execute()) {
                $_SESSION["message"] = "Account created successfully! Please log in.";
                header("Location: login.php");
                exit;
            } else {
                $_SESSION["message"] = "Signup Failed! Please try again.";
                header("Location: signup.php");
                exit;
            }
            $stmt->close();
        }
        $checkEmail->close();
    } else {
        $_SESSION["message"] = "All fields are required!";
        header("Location: signup.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            color: #333;
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }
        .signup-container {
            width: 100%;
            max-width: 550px;
            background: #ffffff;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            background: #f0f0f0;
            border: 1px solid #ddd;
            padding: 12px;
            font-size: 16px;
            font-family: 'Montserrat', sans-serif;
        }
        .input-group-text {
            background: #6c63ff;
            color: #fff;
            border: none;
            padding: 12px;
            font-family: 'Montserrat', sans-serif;
        }
        .btn-primary {
            background-color: #6c63ff;
            border: none;
            font-size: 18px;
            padding: 12px;
            font-family: 'Montserrat', sans-serif;
        }
        .btn-primary:hover {
            background-color: #554edf;
        }
        .login-link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2 class="text-center mb-3">Create an Account</h2>
        <?php
        if (isset($_SESSION["message"])) {
            echo "<div class='alert alert-warning text-center'>" . $_SESSION["message"] . "</div>";
            unset($_SESSION["message"]);
        }
        ?>
        <form method="POST">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="name" class="form-control" required placeholder="Full Name">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" required placeholder="Email Address">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password" class="form-control" required placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
            <a href="login.php" class="login-link text-center text-primary">Already have an account? Login here</a>
        </form>
    </div>
</body>
</html>