<?php
namespace App\Services;
use SendGrid\Mail\Mail as SendgridMail;
class Sendgrid
{
    /**
     * Send bulk email using sendgrid API key
     * Chunk the requests in with set of 1000 users
     *
     * @param string $subject
     * @param array $sendgridPersonalization
     * @param string $content
     * @return array
     * @throws Exception
     */
    public static function sendBulkEmail($subject, $sendgridPersonalization, $content = '')
    {
        $chunkedUsers = array_chunk($sendgridPersonalization, 1000, true);
        $sendgridApiKey = \Config::get('services.sendgrid_key');
        $setupEmail = \Config::get('mail.from.address');
        $setupEmailName = \Config::get('mail.from.name');
        $sendgrid = new \SendGrid($sendgridApiKey);
        foreach ($chunkedUsers as $singleChunk) {
            $email = new SendgridMail();
            $email->setFrom($setupEmail, $setupEmailName);
            $email->setSubject($subject);
            $email->addTo($setupEmail);
            $email->addContent("text/html", $content);
            foreach ($singleChunk as $personalization) {
                $email->addPersonalization($personalization);
            }
            try {
                // Send in batch of 1000 users
                $response = $sendgrid->send($email);
            } catch (Exception $e) {
                return array(
                    'status' => false,
                    'message' => 'Failed to send bulk email. Error message: ' . $e->getMessage()
                );
            }
        }
        return array('status' => true);
    }
}