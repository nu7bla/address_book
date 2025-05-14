<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT id, name, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user["password"])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["user_name"] = $user["name"];
                header("Location: dashboard.php"); // ✅ Redirects after login
                exit;
            } else {
                $_SESSION["message"] = "Invalid email or password!";
            }
        } else {
            $_SESSION["message"] = "No account found. <a href='signup.php'>Sign up here.</a>";
        }
        $stmt->close();
    } else {
        $_SESSION["message"] = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
        .login-container {
            width: 100%;
            max-width: 450px;
            background: #ffffff;
            padding: 30px;
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
        .btn-success {
            background-color: #6c63ff; /* Matches signup button */
            border: none;
            font-size: 18px;
            padding: 12px;
            font-family: 'Montserrat', sans-serif;
        }
        .btn-success:hover {
            background-color: #554edf; /* Matches signup hover color */
        }
        .signup-link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center mb-3">Login to Your Account</h2>

        <?php
        if (isset($_SESSION["message"])) {
            echo "<div class='alert alert-success text-center'>" . $_SESSION["message"] . "</div>";
            unset($_SESSION["message"]);
        }
        ?>

        <?php if (!empty($error_message)) { ?>
            <div class="alert alert-danger text-center"><?= $error_message; ?></div>
        <?php } ?>

        <form method="POST">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" required placeholder="Email">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password" class="form-control" required placeholder="Password">
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
            <a href="signup.php" class="signup-link text-center text-primary">Don't have an account? Sign up here</a>
        </form>
    </div>
</body>
</html>