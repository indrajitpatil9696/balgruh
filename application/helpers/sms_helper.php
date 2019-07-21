<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('sendSms')) {
    function sendSms($sms, $recievers)
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->limit(1);
        $query = $ci->db->get('sms_setting');
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            $sender = $data['sender'];
            $api_key = $data['api_key'];

        }

        $fields = array(
            "sender_id" => $sender,
            "message" => $sms,
            "language" => "unicode",
            "route" => "p",
            "numbers" => $recievers,
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "authorization: " . $api_key,
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $res = array('error' => $err);
            return $res;
        } else {
            $resArr = json_decode($response, true);
            return $resArr;
        }

    }
}