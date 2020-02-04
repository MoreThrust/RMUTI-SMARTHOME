<?php

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
    $st_door_img = "https://smarthome-rmuti.herokuapp.com/img/door_lock.png";
} elseif ($val[7] == "0") {
    $st_door = "ยังไม่ได้ล็อก";
    $st_door_img = "https://smarthome-rmuti.herokuapp.com/img/door_unlock_2.png";
}

// set --> Template
$tp_door = [
    "type" => "flex",
    "altText" => "Flex Message",
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
            "text" => "สถานะประตู",
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
                        "url" => $st_door_img,
                        "gravity" => "center",
                        "size" => "sm"
                      ],
                      [
                        "type" => "text",
                        "text" => $st_door,
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
                      "label" => "ล็อก",
                      "text" => "ล็อกประตู"
                    ],
                    "color" => "#2197F3",
                    "style" => "primary"
                  ],
                  [
                    "type" => "button",
                    "action" => [
                      "type" => "message",
                      "label" => "ปลดล็อก",
                      "text" => "ปลดล็อกประตู"
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
