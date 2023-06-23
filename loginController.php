<?php
include('dbconn.php');
$errors = array();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $captcha = $_POST['g-recaptcha-response'];

    $email = trim($email);
    $password = trim($password);

    if ($email === "") {
        $errors['email'] = "Email is required";
    }
    if ($password === "") {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "password too short";
    }
    if ($captcha === "") {
        $errors['captcha'] = "Captcha is required";
    } elseif (!empty($captcha)) {
        $secret_key = '6LdTmk4cAAAAAJn9MtDme2NEAFBSGUJAjR3zuBK-';
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response']);
        $response_data = json_decode($response);
        if (!$response_data->success) {
            $errors['captcha'] = 'Captcha verification failed';
        }

        $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
            $id = $row['user_id'];
            $fullname = $row['names'];
            $mobile = $row['mobile_no'];
            $pwd = $row['password'];
            $email = $row['email'];
            $role = $row['role'];
            $country = $row['country'];

            if (password_verify($password, $pwd)) {
                if ($query && $role === "super_admin") {
                    $_SESSION['user'] = $id;
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['mobile'] = $mobile;
                    $_SESSION['email'] = $email;
                    $_SESSION['country'] = $country;
                    $_SESSION['role'] = $role;
                    header('location:super_admin/index');
                    exit();
                }

                if ($query && $role === "admin") {
                    $_SESSION['user'] = $id;
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['mobile'] = $mobile;
                    $_SESSION['email'] = $email;
                    $_SESSION['country'] = $country;
                    $_SESSION['role'] = $role;
                    header('location:admin/index');
                }
            } else {
                $errors['username'] = "Incorrect Password";
            }
        } else {
            $errors['username'] = "User not found";
        }
    }
}
