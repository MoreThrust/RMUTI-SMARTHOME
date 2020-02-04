<?php
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '*********************************************';
$channelSecret = '*********************************************';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$request = file_get_contents('php://input');
$request_array = json_decode($request, true);
$kooID = "*********************************************";
    
$tp_alert = [
    "type" => "flex",
    "altText" => "แจ้งเตือน!! พบการงัดแงะ",
    "contents" => [
        "type" => "bubble",
        "direction" => "ltr",
        "header" => [
            "type" => "box",
            "layout" => "vertical",
            "contents" => [
                [
                    "type" => "spacer"
                ]
            ]
        ],
        "hero" => [
            "type" => "image",
            "url" => "https://smarthome-rmuti.herokuapp.com/img/vibrate_1.png",
            "gravity" => "center",
            "size" => "full",
            "aspectRatio" => "1.51:1",
            "aspectMode" => "fit"
        ],
        "body" => [
            "type" => "box",
            "layout" => "vertical",
            "contents" => [
                [
                    "type" => "text",
                    "text" => "แจ้งเตือน!!!",
                    "size" => "xxl",
                    "align" => "center",
                    "gravity" => "center",
                    "weight" => "bold"
                ],
                [
                    "type" => "separator",
                    "margin" => "xl"
                ],
                [
                    "type" => "text",
                    "text" => "พบการงัดแงะ",
                    "margin" => "xxl",
                    "size" => "xxl",
                    "align" => "center",
                    "gravity" => "center",
                    "weight" => "bold",
                    "color" => "#8e44ad"
                ]
            ]
        ]
    ]
];

    $data = [
        'to' => $kooID,
        'messages' => [$tp_alert]
    ];
    pushMsg2($POST_HEADER, $data);


function pushMsg2($POST_HEADER, $data){
    $strUrl = "https://api.line.me/v2/bot/message/push";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $strUrl);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $POST_HEADER);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
}