<?php

function sendMessage(){
    $appId = "c52d2aec-xxxx-xxxx-xxxx-e80603109bc3";
    $apiKey = "YTljOXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXNzM4";
    $content = ["en" => 'Esto es una prueba:' . random_int(1, 999)];
    $fields = [
        'app_id' => $appId,
        // 'included_segments' => array('All'),
        'include_player_ids' => ['1db7b9e5-XXXX-XXXX-XXXX-23d6d19e69db'],
        'data' => [
            "foo" => "bar",
            'vibrate'	=> 1,
            'sound'		=> 1,
            'largeIcon'	=> 'large_icon',
            'smallIcon'	=> 'small_icon'
        ],
        'contents' => $content
    ];

    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                               'Authorization: Basic ' . $apiKey));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

$response = sendMessage();
$return["allresponses"] = $response;
$return = json_encode( $return);

print("\n\nJSON received:\n");
print($return);
print("\n");