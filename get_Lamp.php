<?php
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
    $st_lamp_img = "https://smarthome-rmuti.herokuapp.com/img/lamp_on.png";
} elseif ($val[7] == "0") {
    $st_lamp = "ปิดอยู่";
    $st_lamp_img = "https://smarthome-rmuti.herokuapp.com/img/lamp_off.png";
}



// set --> Template
$tp_lamp = [
    "type" => "flex",
    "altText" => "สถานะหลอดไฟ",
    "contents" => [
        "type" => "bubble",
        "direction" => "ltr",
        "header" => [
            "type" => "box",
            "layout" => "vertical",
            "contents" => [
                [
                    "type" => "spacer",
                    "size" => "xl"
                ],
                [
                    "type" => "text",
                    "text" => "สถานะหลอดไฟ",
                    "size" => "xxl",
                    "align" => "center",
                    "gravity" => "bottom"
                ]
            ]
        ],
        "body" => [
            "type" => "box",
            "layout" => "vertical",
            "contents" => [
                [
                    "type" => "box",
                    "layout" => "horizontal",
                    "contents" => [
                        [
                            "type" => "box",
                            "layout" => "horizontal",
                            "contents" => [
                                [
                                    "type" => "box",
                                    "layout" => "vertical",
                                    "contents" => [
                                        [
                                            "type" => "image",
                                            "url" => $st_lamp_img,
                                            "gravity" => "center",
                                            "size" => "sm"
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => $st_lamp,
                                            "margin" => "lg",
                                            "align" => "center",
                                            "gravity" => "center"
                                        ]
                                    ]
                                ],
                                [
                                    "type" => "separator",
                                    "margin" => "md"
                                ]
                            ]
                        ],
                        [
                            "type" => "box",
                            "layout" => "horizontal",
                            "flex" => 0,
                            "contents" => [
                                [
                                    "type" => "spacer"
                                ]
                            ]
                        ],
                        [
                            "type" => "box",
                            "layout" => "vertical",
                            "contents" => [
                                [
                                    "type" => "button",
                                    "action" => [
                                        "type" => "message",
                                        "label" => "เปิดไฟ",
                                        "text" => "เปิดไฟ"
                                    ],
                                    "color" => "#FFD32A",
                                    "style" => "primary"
                                ],
                                [
                                    "type" => "button",
                                    "action" => [
                                        "type" => "message",
                                        "label" => "ปิดไฟ",
                                        "text" => "ปิดไฟ"
                                    ],
                                    "color" => "#34495E",
                                    "margin" => "xl",
                                    "style" => "primary"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
