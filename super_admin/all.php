<?php
require 'functions/dbconn.php';

$sql = 'SELECT email FROM users';
// $statement = $connection->prepare($sql);
// $statement->execute();
// $emails = $statement->fetchAll();

$errors = array();
$success = array();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';

//if submit button is clicked and inputs are not empty
if (isset($_POST['submit'])) {
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // $mail = new PHPMailer(true);
    // // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    // $mail->isSMTP();
    // $mail->Host = 'sandbox.smtp.mailtrap.io';
    // $mail->SMTPAuth = true;
    // $mail->Port = 2525;
    // $mail->Username = 'ecd9ced4b1a7a4';
    // $mail->Password = '57ef3562c960a4';

    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'live.smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 587;
    $phpmailer->Username = 'api';
    $phpmailer->Password = '00cdc0a4c48e5c6c34935b00ad36536f';
    $mail->setFrom('hello@ecodemy.ca', 'Ecodemy WalkIT'); // Gmail address which you used as SMTP server
    $mail->isHTML(true);
    // $mail->SMTPDebug = 2;
    $mail->Subject = "$subject";
    $mail->Body = "$message";
    $mail->AltBody = '';
    foreach ($connection->query($sql) as $row) {
        $mail->AddAddress($row['email']);
    }

    if ($mail->Send())
        $success['data'] = 'Emails Sent successfully';

    else
        $errors['mail'] = 'Email Not sent';
}




?>

<?php
//All header tag to be included
include('include/header.php');

?>

<?php
//sidebar tag to be included
include('include/sidebar.php');
?>


<main>
    <div class="container-fluid">
        <h1 class="mt-4">Bulk Mail </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Send Bulk Mail</li>
        </ol>
        <!-- if there is an error, echo all of them -->
        <?php if (count($errors) > 0) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php foreach ($errors as $error) : ?>
                    <li style="color: red"><?php echo $error; ?></li>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- if there is success, echo all of them -->
        <?php if (count($success) > 0) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php foreach ($success as $succes) : ?>
                    <li style="color: green"><?php echo $succes; ?></li>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="card-box">
            <div class="col-md-12">
                <form class="form-horizontal" name="bulk email" method="post" autocomplete="off" action="all.php">
                    <div class="form-group">
                        <label class="col-md-6 control-label">Subject</label>
                        <div class="col-md-10">
                            <input name="subject" id="subject" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Message</label>
                        <div class="col-md-10">
                            <textarea class="form-control" rows="5" name="message" id="message"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">&nbsp;</label>
                        <div class="col-md-10">

                            <button type="submit" class="btn text-white btn-block" name="submit">
                                Send Bulk Mail
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>


    </div>
</main>

<?php
//footer tag to be included
include('include/footer.php');
?>

<?php
//javascripts files to be included
include('include/scripts.php');
?>

<script>
    $("#message").summernote({
        placeholder: 'Enter Message here...',
        height: 100,
    });
</script>