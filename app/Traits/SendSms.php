<?php
namespace App\Traits;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

/**
 * Trait SMS
 * @package App\Traits
 */

 trait SendSms
 {

    private $SMS_SENDER = 'Nkonta';
    private $RESPONSE_TYPE = 'json';
    private $SMS_USERNAME = 'tsg-teksup';
    private $SMS_PASSWORD = 'Mirlin12';

    public function getUserNumber(Request $request)
    {
        $phone_number = $request->input('phone_number');

        $message = "A message has been sent to you";

        $this->initiateSmsActivation($phone_number, $message);
      // $this->initiateSmsGuzzle($phone_number, $message);

        return redirect()->back()->with('message', 'Message has been sent successfully');
    }

    public function sendSmS($destination, $message)
    {
        $client = new Client();
        // $message = $msg;
        $response = $client->post(
        "http://sms.apavone.com:8080/bulksms/bulksms?username=tsg-teksup&password=Mirlin12&type=0&dlr=0&destination=$destination&source=Nkonta&message= $message");

        $response = json_decode($response->getBody(), true);
    }

    public function initiateSmsActivation($phone_number, $message){
        $isError = 0;
        $errorMessage = true;

        //Preparing post parameters
        $postData = array(
            'username' => $this->SMS_USERNAME,
            'password' => $this->SMS_PASSWORD,
            'message' => $message,
            'sender' => $this->SMS_SENDER,
            'mobiles' => $phone_number,
            'response' => $this->RESPONSE_TYPE
        );

        $url = "http://sms.apavone.com:8080/bulksms/bulksms?";

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);


        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);


        if($isError){
            return array('error' => 1 , 'message' => $errorMessage);
        }else{
            return array('error' => 0 );
        }
    }

 }
?>
