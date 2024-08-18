<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
   $secretKey = '6Ld3QSkqAAAAAEBS9PuOZqBreVPGVNOoQUKHD4cG';
   $captchaResponse = $_POST['g-recaptcha-response'];
   $remoteIp = $_SERVER['REMOTE_ADDR'];

   if(!$captchaResponse){
       header('Location: index.php');
       exit;
   }

   $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
   $response = file_get_contents($verifyUrl . '?secret=' . $secretKey . '&response=' . $captchaResponse . '&remoteip=' . $remoteIp);
   $responseKeys = json_decode($response);

   if($responseKeys->success){
       $name = $_POST['name'];
       $email = $_POST['email'];
       $phone = $_POST['phone'];
       $message = $_POST['message'];

       if(!empty($name) && !empty($email) && !empty($phone) && !empty($message)){
           $to = 'wendyds1985@gmail.com';
           $subject = 'Nuevo mensaje de contacto';
           $body = "Nombre: $name\nTeléfono: $phone\nEmail: $email\nMensaje: $message";
           $headers = "From: wendyds1985@gmail.com\n".
                      "Reply-To: wendyds1985@gmail.com\r\n".
                      "X-Mailer: PHP/".phpversion();

           if(mail($to, $subject, $body, $headers)){
               header('Location: index.php');
           } else {
               echo 'Error al enviar mensaje';
           }
       } else {
           echo 'Todos los campos son requeridos';
       }
   } else {
       echo 'Error al verificar el captcha';
   }
}
?>
