<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";
$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
//ganti dengan email dan password yang akan di gunakan sebagai email pengirim
$mail->Username = '#';
$mail->Password = '#';
$mail->SMTPSecure = 'ssl';
$mail->isHTML(true);
$mail->Port = 465;
//ganti dengan email yg akan di gunakan sebagai email pengirim
$mail->setFrom('#', '#');
$mail->addAddress($_POST['email'], $_POST['nama_depan']);
$mail->isHTML(true);
$mail->Subject = "Aktivasi alamat email";
$mail->Body = "
<body style=\"background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;\">
    <span style=\"color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;\">Terimakasih telah memilih plane untuk memesan tiket pesawat. Sekarang kamu bisa duduk, bersantai, dan kami akan bantu kamu.</span>
    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;\">
        <tr>
            <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top;\">&nbsp;</td>
            <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 480px; padding: 10px; width: 480px;\">
                <div style=\"box-sizing: border-box; display: block; Margin: 0 auto; max-width: 480px; padding: 10px;\">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <table style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;\">

                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;\">
                                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;\">
                                    <tr>
                                        <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top;\">
                                            <h2 style=\"font-family: sans-serif; font-size:32px;margin-bottom: 15px;\">Yay! Selamat datang <strong>Budi Setiawan!</strong></h2>
                                            <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;\">Terimakasih telah memilih plane untuk memesan tiket pesawat. Sekarang kamu bisa duduk, bersantai, dan kami akan bantu kamu</p>
                                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"btn btn-primary\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;\">
                                                <tbody>
                                                    <tr>
                                                        <td align=\"left\" style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;\">
                                                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;\">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;\"> <a href=\"http://localhost/praktikum/4c/plane/activation.php?t=$token\" target=\"_blank\" style=\"display: inline-block;width:100%; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;\">Verifikasi Email</a> </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color:#6C757D;\">Jika anda tidak membuat akun, anda tidak perlu melakukan apapun. Jadi itu sangat mudah.</p>
                                            <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;color:#6C757D;\">Salam</p>
                                            <br>
                                            <br>
                                            <br>
                                            <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;color:#007BFF;\">Plane.com</p>
                                            <br>
                                            <br>
                                            <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: ;color:#6C757D;\">Jika anda mengalami masalah saat mengklik tombol \"Verifikasi Email\", salin dan tempel URL di bawah ini ke browser web anda:  \";
                                                </p> <a href=\"http://localhost/praktikum/4c/plane/activation.php?t=$token\">$token</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>

                    <!-- END CENTERED WHITE CONTAINER -->
                </div>
            </td>
            <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top;\"></td>
        </tr>
    </table>
</body>
";
$mail->send();
echo 'Message has been sent';
