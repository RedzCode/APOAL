<?php

require(__DIR__ . '/vendor/autoload.php');

class SendEmail
{
    public static function SendMailConfirmation($to, $opponent, $content)
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("poulpyshow@ensc.fr", "PoulpyShow");
        $email->setSubject("\u{1F441} APOAL - Confirmation échange"); //1F441 => eye && 1F419 => octopus
        $email->addTo($to);
        $email->addContent(
            "text/html",
            "<p>Ici la voix...</p>" .
                "<p>" . $opponent . " aimerait faire un échange avec toi</p>" .
                '<button style="background-color: #ffd240; border-radius: 4px; color: black;" type="submit"><a href="' . $content . '"><strong>Clique ici pour valider l échange</strong></a></button>' . '
    <p><strong>Si le bouton ne marche pas clique sur le lien qui suit :</strong></p>' .
                '<p>' . $content . '</p>'
        );

        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            /*  print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";*/
            return $response;
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
            return false;
        }
    }
}
