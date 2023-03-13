<?php

require(__DIR__ . '/vendor/autoload.php');

class SendEmail
{
    public static function SendMailConfirmation($to, $content)
    {
        print_r($to);
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("poulpyshow@ensc.fr", "PoulpyShow");
        $email->setSubject("&#x1F419 APOAL - Confirmation échange"); //1F441 => eye
        $email->addTo($to);
        $email->addContent("text/plain", "SALUT JOUEUR" . $content);
        //$link =  "<p>" . $content . "</p>";
        $email->addContent(
            "text/html",
            "<strong>HTML</strong>" . "<p>" . $content . "</p>"
        );

        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            return $response;
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
            return false;
        }
    }
}
