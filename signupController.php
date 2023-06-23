<?php
include('dbconn.php');

$errors = array();
$success = array();

if (isset($_POST['register'])) {

    $full_name = $_POST['full_name'];
    $country = $_POST['country'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $code = $_POST['password'];
    $confirm = $_POST['confirmpassword'];
    $mobile_code = $_POST['mobile_code'];

    //trim input tags

    $full_name = trim($full_name);
    $country = trim($country);
    $mobile = trim($mobile);
    $email = trim($email);
    $password = trim($code);
    $confirm = trim($confirm);
    $mobile = trim($mobile);
    $role = "admin";
    $reg_date = date("Y-m-d H:i:s", time());
    $mobile_code = '+' . $mobile_code;


    if ($full_name === "" || $country === "" || $country === "" || $email === "" || $password === "" || $confirm === "") {
        $errors['fields'] = "All fields are Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email is invalid";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password too short";
    } elseif ($password != $confirm) {
        $errors['passwordf'] = "Passwords don't match";
    } else {
        $query = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
        if (mysqli_num_rows($query) > 0) {
            $errors['pass'] = "Email Exists";
        } else {
            $password = password_hash($code, PASSWORD_DEFAULT);
            $query = mysqli_query($conn, "INSERT INTO users (names, country, mobile_code, mobile_no, email, role, password, registered_on) VALUES('$full_name','$country','$mobile_code','$mobile','$email','$role','$password','$reg_date')");
            if ($query) {
                //$success['confirm'] = "You are now registered <a href='signin.php'>Login Here</a>";
                $qry = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
                if (mysqli_num_rows($qry) > 0) {
                    $row = mysqli_fetch_array($qry);
                    $id = $row['user_id'];
                    $fullname = $row['names'];
                    $mobile = $row['mobile_no'];
                    $pwd = $row['password'];
                    $email = $row['email'];
                    $role = $row['role'];
                    $country = $row['country'];
                    $code = $_POST['password'];

                    if (password_verify($code, $pwd)) {
                        $_SESSION['user'] = $id;
                        $_SESSION['fullname'] = $fullname;
                        $_SESSION['mobile'] = $mobile;
                        $_SESSION['email'] = $email;
                        $_SESSION['country'] = $country;
                        $_SESSION['role'] = $role;
                        header('location:admin/index.php');
                    } else {
                        $errors['username'] = "Incorrect Password";
                    }
                } else {
                    $errors['username'] = "User not found";
                }
            } else {
                $errors['pass'] = "Error Registering";
            }
        }
    }
}
