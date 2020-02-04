<?php

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
    $st_plug_img = "https://smarthome-rmuti.herokuapp.com/img/plug_3.png";
} elseif ($val[7] == "0") {
    $st_plug = "ปิดอยู่";
    $st_plug_img = "https://smarthome-rmuti.herokuapp.com/img/unplug_3.png";
}

// set --> Template
$tp_plug = [
    "type" => "flex",
    "altText" => "ปลั๊กไฟ",
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
            "text" => "สถานะปลั๊กไฟ",
            "size" => "3xl",
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
                        "url" => $st_plug_img,
                        "gravity" => "center",
                        "size" => "sm"
                      ],
                      [
                        "type" => "text",
                        "text" => $st_plug,
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
                      "label" => "เปิดปลั๊กไฟ",
                      "text" => "เปิดปลั๊กไฟ"
                    ],
                    "color" => "#2ECC71",
                    "style" => "primary"
                  ],
                  [
                    "type" => "button",
                    "action" => [
                      "type" => "message",
                      "label" => "ปิดปลั๊กไฟ",
                      "text" => "ปิดปลั๊กไฟ"
                    ],
                    "color" => "#F92424",
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
