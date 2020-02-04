<?php

date_default_timezone_set('Asia/Bangkok');
$dt = date('เมื่อวันที่ d/m/Y เวลา H:i:s น.');

// get Status
// get --> Temp Status      ======================================================================>
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.anto.io/channel/get/*********************************************/R_H_A_S/temp', CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
$resp = curl_exec($curl);
curl_close($curl);
$val = explode('"', $resp);
$st_temp = $val[7];


// get --> Humi Status      ======================================================================>
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.anto.io/channel/get/*********************************************/R_H_A_S/humi', CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
$resp = curl_exec($curl);
curl_close($curl);
$val = explode('"', $resp);
$st_humi = $val[7];


// get --> Rain Status      ======================================================================> 
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.anto.io/channel/get/*********************************************/R_H_A_S/Rain', CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
$resp = curl_exec($curl);
curl_close($curl);
$val = explode('"', $resp);
if ($val[7] >= "1") {
    $st_rain = "ฝนกำลังตก";
} elseif ($val[7] == "0") {
    $st_rain = "ไม่มีฝน";
}

// get --> Lamp Status      ======================================================================>
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.anto.io/channel/get/*********************************************/R_H_A_S/lamp', CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
$resp = curl_exec($curl);
curl_close($curl);
$val = explode('"', $resp);

if ($val[7] >= "1") {
    $st_lamp = "เปิดอยู่";
    $st_lamp_c = "#4cd137";
} elseif ($val[7] == "0") {
    $st_lamp = "ปิดอยู่";
    $st_lamp_c = "#eb3b5a";
}

// get --> Door Status      ======================================================================> 
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.anto.io/channel/get/*********************************************/R_H_A_S/Door', CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
$resp = curl_exec($curl);
curl_close($curl);
$val = explode('"', $resp);

if ($val[7] >= "1") {
    $st_door = "กำลังล็อกอยู่";
    $st_door_c = "#4cd137";
} elseif ($val[7] == "0") {
    $st_door = "ยังไม่ได้ล็อก";
    $st_door_c = "#eb3b5a";
}

// get --> Plug Status      ======================================================================>
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.anto.io/channel/get/*********************************************/R_H_A_S/plug', CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
$resp = curl_exec($curl);
curl_close($curl);
$val = explode('"', $resp);

if ($val[7] >= "1") {
    $st_plug = "เปิดอยู่";
    $st_plug_c = "#4cd137";
} elseif ($val[7] == "0") {
    $st_plug = "ปิดอยู่";
    $st_plug_c = "#eb3b5a";
}



// set Template
$tp_status_menu = [
    "type" => "flex",
    "altText" => "สถานะ",
    "contents" => [
        "type" => "bubble",
        "direction" => "ltr",
        "body" => [
            "type" => "box",
            "layout" => "vertical",
            "contents" => [
                [
                    "type" => "text",
                    "text" => "สถานะปัจจุบัน",
                    "size" => "xl",
                    "weight" => "bold"
                ],
                [
                    "type" => "box",
                    "layout" => "vertical",
                    "spacing" => "sm",
                    "margin" => "lg",
                    "contents" => [
                        [
                            "type" => "box",
                            "layout" => "horizontal",
                            "contents" => [
                                [
                                    "type" => "box",
                                    "layout" => "vertical",
                                    "flex" => 2,
                                    "contents" => [
                                        [
                                            "type" => "text",
                                            "text" => "อุณหภูมิ",
                                            "size" => "lg"
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => "ความชื้น",
                                            "size" => "lg"
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => "ฝน",
                                            "size" => "lg"
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => "ประตูบ้าน",
                                            "size" => "lg"
                                        ],
                                        [
                                          "type" => "text",
                                          "text" => "หลอดไฟ",
                                          "size" => "lg"
                                        ],
                                        [
                                          "type" => "text",
                                          "text" => "ปลั๊กไฟ",
                                          "size" => "lg"
                                        ]
                                    ]
                                ],
                                [
                                    "type" => "box",
                                    "layout" => "vertical",
                                    "flex" => 2,
                                    "contents" => [
                                        [
                                            "type" => "text",
                                            "text" => $st_temp . "°C",
                                            "size" => "lg",
                                            "color" => "#3867D6"
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => $st_humi . "%",
                                            "size" => "lg",
                                            "color" => "#3867D6"
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => $st_rain,
                                            "size" => "lg",
                                            "color" => "#3867D6"
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => $st_door,
                                            "size" => "lg",
                                            "color" => $st_door_c,
                                            "action" => [
                                                "type" => "message",
                                                "text" => "สถานะประตู"
                                            ]
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => $st_lamp,
                                            "size" => "lg",
                                            "color" => $st_lamp_c,
                                            "action" => [
                                                "type" => "message",
                                                "text" => "สถานะหลอดไฟ"
                                            ]
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => $st_plug,
                                            "size" => "lg",
                                            "color" => $st_plug_c,
                                            "action" => [
                                                "type" => "message",
                                                "text" => "สถานะปลั๊กไฟ"
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
        "footer" => [
            "type" => "box",
            "layout" => "vertical",
            "flex" => 0,
            "spacing" => "sm",
            "contents" => [
                [
                    "type" => "button",
                    "action" => [
                        "type" => "message",
                        "label" => "เช็คสถานะอีกครั้ง",
                        "text" => "สถานะ"
                    ],
                    "color" => "#F39C12",
                    "margin" => "md",
                    "height" => "md",
                    "style" => "primary"
                ],
                [
                    "type" => "separator",
                    "margin" => "xl"
                ],
                [
                    "type" => "text",
                    "text" => $dt,
                    "margin" => "lg",
                    "size" => "xxs",
                    "align" => "center",
                    "gravity" => "center"
                ]
            ]
        ]
    ]
];
