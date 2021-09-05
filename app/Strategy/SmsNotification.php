<?php
namespace App\Strategy;
use App\Strategy\SendMessage;

class SmsNotification implements SendMessage{

    public function notification($data){

        $basic  = new \Nexmo\Client\Credentials\Basic('d05d6cd0', '0qbeKt8D8EKnzYKY');
        $client = new \Nexmo\Client($basic);

        $dat =(!empty($data))? "8801682295309" : "8801682295309";
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($dat, 'DIP GHOSH', 'A text message sent using the Nexmo SMS API')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }

    }
}
