<?php
$org_id="6bb2e1c7-c66b-4d47-9301-4a6b9e792e2c";
$url="https://jefferson-staging.herokuapp.com/api/v1/organizations/".$org_id."/badges";

//pass token as argument so it's not in code base
$username = $argv[1];
$password = "";

$data = array(
    'badge_template_id' => 'ab8b9e91-b83b-4e80-acb6-33449016ec11', 
    'issued_to_first_name' => 'yancy',
    'issued_to_last_name' => 'ribbens',
    'expires_at' => '2018-04-01 09:41:00 -0500',
    'recipient_email' => 'yancy.ribbens+test_again@gmail.com',
    'issued_at' => '2014-04-01 09:41:00 -0500'
);

function create_badge($url,$username,$password,$data){
    $ch = curl_init();

    $curlConfig = array(
        CURLOPT_HTTPHEADER     => array('Accept: application/json'),
        CURLOPT_CUSTOMREQUEST  => "POST",
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERPWD        => $username . ":" . $password,
        CURLOPT_POSTFIELDS     => $data,
    );
    curl_setopt_array($ch, $curlConfig);

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    print $httpCode;
    curl_close($ch);
}

create_badge($url,$username,$password,$data);

?>
