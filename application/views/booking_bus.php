<?php
$ch = curl_init();
//$url=$this->url."etsAPI/api/seatBooking?blockTicketKey=".$ticket;
$url = "myfairservice.com"
$username='XXXX';
$password='bnbn678';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
$output = curl_exec($ch);
curl_close($ch);

Response:
$someArray = json_decode($output, true);
        return $someArray;
		
		?>