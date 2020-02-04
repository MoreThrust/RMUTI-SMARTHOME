<?php
include("get_Status.php");
include("get_Lamp.php");
include("get_Door.php");
include("get_Plug.php");
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '*********************************************';
$channelSecret = '*********************************************';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$request = file_get_contents('php://input');
$request_array = json_decode($request, true);

if (sizeof($request_array['events']) > 0) {
    foreach ($request_array['events'] as $event) {
        $reply_message = '';
        $reply_token = $event['replyToken'];
        $text = $event['message']['text'];
        $getUid = $event['source']['userId'];

        // --> Req Main Menu
        if ($text == 'สถานะ') {
            $data = [
                'replyToken' => $reply_token,
                'messages' => [$tp_status_menu]
            ];
        }
        if ($text == 'อุปกรณ์') {
            $data = [
                'replyToken' => $reply_token,
                'messages' => [
                    [
                        "type" => "imagemap",
                        "baseUrl" => "https://smarthome-rmuti.herokuapp.com/img/imagemap/home_imagemap3.png?_ignored=",
                        "altText" => "สถานะอุปกรณ์",
                        "baseSize" => [
                            "width" => 1040,
                            "height" => 835
                        ],
                        "actions" => [
                            [
                                "type" => "message",
                                "area" => [
                                    "x" => 113,
                                    "y" => 156,
                                    "width" => 323,
                                    "height" => 342
                                ],
                                "text" => "สถานะหลอดไฟ"
                            ],
                            [
                                "type" => "message",
                                "area" => [
                                    "x" => 593,
                                    "y" => 108,
                                    "width" => 333,
                                    "height" => 347
                                ],
                                "text" => "สถานะปลั๊กไฟ"
                            ],
                            [
                                "type" => "message",
                                "area" => [
                                    "x" => 450,
                                    "y" => 666,
                                    "width" => 173,
                                    "height" => 163
                                ],
                                "text" => "สถานะประตู"
                            ]
                        ]
                    ]
                ]

            ];
        }
        if ($text == 'วิธีใช้งาน') {
            $data = [
                'replyToken' => $reply_token,
                'messages' => [
                    [
                        "type" => "flex",
                        "altText" => "วิธีใช้งาน",
                        "contents" => [
                            "type" => "bubble",
                            "direction" => "ltr",
                            "header" => [
                                "type" => "box",
                                "layout" => "vertical",
                                "contents" => [
                                    [
                                        "type" => "text",
                                        "text" => "วิธีใช้งาน",
                                        "size" => "xl",
                                        "align" => "start",
                                        "weight" => "bold"
                                    ],
                                    [
                                        "type" => "text",
                                        "text" => "เลือกเมนูที่ต้องการ",
                                        "margin" => "lg",
                                        "size" => "lg",
                                        "align" => "start"
                                    ]
                                ]
                            ],
                            "footer" => [
                                "type" => "box",
                                "layout" => "vertical",
                                "contents" => [
                                    [
                                        "type" => "box",
                                        "layout" => "horizontal",
                                        "contents" => [
                                            [
                                                "type" => "spacer",
                                                "size" => "xxl"
                                            ],
                                            [
                                                "type" => "button",
                                                "action" => [
                                                    "type" => "uri",
                                                    "label" => "วิธีใช้งาน",
                                                    "uri" => "line://app/1653765722-Apv9v9Gg"
                                                ],
                                                "color" => "#3c40c6",
                                                "style" => "primary"
                                            ],
                                            [
                                                "type" => "spacer",
                                                "size" => "xxl"
                                            ]
                                        ]
                                    ],
                                    [
                                        "type" => "box",
                                        "layout" => "horizontal",
                                        "margin" => "md",
                                        "contents" => [
                                            [
                                                "type" => "spacer",
                                                "size" => "xxl"
                                            ],
                                            [
                                                "type" => "button",
                                                "action" => [
                                                    "type" => "message",
                                                    "label" => "แจ้งปัญหาการใช้งาน",
                                                    "text" => "แจ้งปัญหา"
                                                ],
                                                "color" => "#f53b57",
                                                "style" => "primary"
                                            ],
                                            [
                                                "type" => "spacer",
                                                "size" => "xxl"
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
        }

        // --> Lamp Function    ###################################

        // --> Req Lamp
        if ($text == 'สถานะหลอดไฟ') {
            $data = [
                'replyToken' => $reply_token,
                'messages' => [$tp_lamp]
            ];
        }
        // --> Set Lamp ON
        if ($text == 'เปิดไฟ') {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://api.anto.io/channel/set/*********************************************/R_H_A_S/lamp/1', CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            include("get_Lamp.php");
            $data = [
                'replyToken' => $reply_token,
                'messages' => [$tp_lamp]
            ];
        }
        // --> Set Lamp OFF
        if ($text == 'ปิดไฟ') {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://api.anto.io/channel/set/*********************************************/R_H_A_S/lamp/0', CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            include("get_Lamp.php");
            $data = [
                'replyToken' => $reply_token,
                'messages' => [$tp_lamp]
            ];
        }

        // --> End Lamp Function    ###################################




        // --> Door Function    ###################################

        // --> Req Door
        if ($text == 'สถานะประตู') {
            $data = [
                'replyToken' => $reply_token,
                'messages' => [$tp_door]
            ];
        }
        // --> Set Door Unlock
        if ($text == 'ปลดล็อกประตู') {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://api.anto.io/channel/set/*********************************************/R_H_A_S/Door/0', CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            include("get_Door.php");
            $data = [
                'replyToken' => $reply_token,
                'messages' => [$tp_door]
            ];
        }
        // --> Set Door Lock
        if ($text == 'ล็อกประตู') {
            $curl = curl_init();
            \curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://api.anto.io/channel/set/*********************************************/R_H_A_S/Door/1', CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            include("get_Door.php");
            $data = [
                'replyToken' => $reply_token,
                'messages' => [$tp_door]
            ];
        }

        // --> End Door Function    ###################################




        // --> Plug Function    ###################################

        // --> Req Plug
        if ($text == 'สถานะปลั๊กไฟ') {
            $data = [
                'replyToken' => $reply_token,
                'messages' => [$tp_plug]
            ];
        }
        // --> Set Plug ON
        if ($text == 'เปิดปลั๊กไฟ') {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://api.anto.io/channel/set/*********************************************/R_H_A_S/plug/1', CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            include("get_Plug.php");
            $data = [
                'replyToken' => $reply_token,
                'messages' => [$tp_plug]
            ];
        }
        // --> Set Plug Off
        if ($text == 'ปิดปลั๊กไฟ') {
            $curl = curl_init();
            \curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://api.anto.io/channel/set/*********************************************/R_H_A_S/plug/0', CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            include("get_Plug.php");
            $data = [
                'replyToken' => $reply_token,
                'messages' => [$tp_plug]
            ];
        }

        // --> End Plug Function    ###################################

        // --> Howto Function    ###################################

        // --> Req Contact
        if ($text == 'แจ้งปัญหา') {
            $data = [
                'replyToken' => $reply_token,
                'messages' => [
                    [
                        "type" => "flex",
                        "altText" => "ช่องทางการติดต่อ",
                        "contents" => [
                            "type" => "bubble",
                            "direction" => "ltr",
                            "header" => [
                                "type" => "box",
                                "layout" => "vertical",
                                "contents" => [
                                    [
                                        "type" => "text",
                                        "text" => "ช่องทางการติดต่อ",
                                        "size" => "xl",
                                        "align" => "center",
                                        "weight" => "bold"
                                    ],
                                    [
                                        "type" => "text",
                                        "text" => "โทร: 098 102 7073 (กู๋)",
                                        "margin" => "xxl",
                                        "align" => "start",
                                        "gravity" => "top"
                                    ],
                                    [
                                        "type" => "text",
                                        "text" => "FB: Peeraphat Phalakul"
                                    ]
                                ]
                            ],
                            "footer" => [
                                "type" => "box",
                                "layout" => "horizontal",
                                "contents" => [
                                    [
                                        "type" => "button",
                                        "action" => [
                                            "type" => "uri",
                                            "label" => "โทร",
                                            "uri" => "tel://0981027073"
                                        ],
                                        "style" => "primary"
                                    ],
                                    [
                                        "type" => "button",
                                        "action" => [
                                            "type" => "uri",
                                            "label" => "Facebook",
                                            "uri" => "https://www.facebook.com/morethrust"
                                        ],
                                        "color" => "#3B5998",
                                        "margin" => "md",
                                        "style" => "primary"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
        }

        // --> End Howto Function    ###################################

        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
        $send_result = send_reply_message($API_URL . '/reply', $POST_HEADER, $post_body);
        echo "Result: " . $send_result . "\r\n";
    }
}

function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
