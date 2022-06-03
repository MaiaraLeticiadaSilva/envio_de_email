<?php
    include "config.php";
    include TEMPLATE_PATH."/header.php";
    include TEMPLATE_PATH."/nav.php";
    
?>

<main>
    <h2>CONTATO</h2>
    <h3 id="tituloh3">ENVIO DE E-MAIL</h3>
    <form method="POST" action="contato.php" enctype="multipart/form-data">
        <div>
            <div>
                <label>Insira seu nome:</label>
            </div>
            <div>
                <input type="text" name="nome" id="nome"/>
            </div>
        </div>
        <div>
            <div>
                <label>Qual o assunto?</label>
            </div>
            <div>
                <input type="text" name="assunto" id="assunto"/>
            </div>
        </div>
        <div>
            <div>
                <label>Mensagem:</label>
            </div>
            <div>
                <textarea name="mens" id="mens" rows="8" cols="50"></textarea>
            </div>
        </div>
        <div id="botoes">
            <input class="btn" type="submit" name="Enviar" value="Enviar"/>
                            
            <input class="btn" type="reset" value="Limpar">
        </div>
    </form>

</main>

<?php
    #incluir PHPMailer
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);
    $nome = $_POST["nome"];
    $assunto = $_POST["assunto"];
    $mensagem = $_POST["mensagem"];

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'user@example.com';                     //SMTP username
        $mail->Password   = 'secret';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('from@example.com', $nome);
        $mail->addAddress('sanny-belisario@educar.rs.gov.br', 'Sanny');     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');
    
        //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $assunto;
        $mail->Body    = $mensagem;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    #incluir rodapé;
    include TEMPLATE_PATH."/footer.php";
?>