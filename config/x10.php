<?php
return $ret = [
    "DISABLE_REGISTER" => FALSE,
    "HALT_CRON" => FALSE,
    "ARTIFACT_COOLDOWN" => 6,
    "WW_PLAN_COOLDOWN" => 3,
    "USE_WW_PLAN_COOLDOWN" => FALSE,
    "INSTANT_TRAIN" => FALSE,
    "INSTANT_TRAIN_MODIFIER" => 61.3,
    "GAME_ROUND" => 93,
    "SERVER_NAME" => "Aspida x10",
    "COSTRES" => 0,
    "DEFAULT_GOLD" => 300,  //DEFAULT GOLD
    "HOWRES" => 10,
    "COSTCP" => 20,
    "EXTRA_MENU" => FALSE,
    "HOWCP" => 1000,
    "AUCTIONTIME" => 7200 * 2,
    "GP_LOCATE" => "gpack/delusion_4.5/",
    "OPENING" => ($opening = 1711954800),
    "REF_POP" => 500,
    "REF_GOLD" => 50,
    "OASISX" => 10, //Oasis def
    "SPEED" => 10, //Speed of the server
    "MAX_FILES" => 1000,
    "MAX_FILESH" => 3000,
    "IMGQUALITY" => 50,
    "MOMENT_TRAIN" => FALSE,
    "QUEST" => True,
    //"ARTEFACTS" =>%ARTEFACTS%,
    //"WW_TIME" =>%WW_TIME%,
    //"WW_PLAN" =>%WW_PLAN%,
    "ROUND_LENGTH" => ($round_length = 30),
    "ROUND_TOTAL" => ($round_total = $round_length * 86400),
    "PART_ROUND" => ($part_round = $round_total / 3),
    "ARTEFACTS" => ($artefacts = $opening + $part_round),
    "WW_TIME" => $opening,
    "WW_PLAN" => ($ww_plan = $artefacts + $part_round),
    "NATARS_TIME" => $ww_plan + $part_round,
    "SELL_CP" => True,
    "SELL_RES" => False,
    "CRANNY_CAP" => 10,
    "ADV_TIME" => 86400 / 20,
    "TRAPPER_CAPACITY" => 10,
    "xQUEST" => 0,

    //Discount options
    "DISCOUNT" => True, //On-Off
    "DISCOUNT_START" => ($discount_start = 345), //Start time (timestamp)
    "DISCOUNT_TIME" => ($discount_time = 3), //Length of discount period in seconds
    "DISCOUNT_END" => $discount_start + ($discount_time * 86400),
    "DICOUNT_BONUS" => 100, //Descount percentage

    //Buy Gold options
    "PACK_A_PRICE" => 2,
    "PACK_B_PRICE" => 4,
    "PACK_C_PRICE" => 8,
    "PACK_D_PRICE" => 16,
    "PACK_E_PRICE" => 32,
    "PACK_F_PRICE" => 50,
    "PACK_H_PRICE" => 100,
    "PACK_A_GOLD" => 1250,
    "PACK_B_GOLD" => 3125,
    "PACK_C_GOLD" => 7750,
    "PACK_D_GOLD" => 19500,
    "PACK_E_GOLD" => 50000,
    "PACK_F_GOLD" => 100000,
    "PACK_H_GOLD" => 250000,

    "MAX_UNIT" => 70,
    "MAX_TRIBE" => 7,
    // ***** Change storage capacity
    "STORAGE_MULTIPLIER" => ($storage_multiplier = 10),

    "STORAGE_BASE" => 800 * $storage_multiplier,

    // ***** World size
    // Defines world size. NOTICE: DO NOT EDIT!!
    "WORLD_MAX" => "200",

    "INCREASE_SPEED" => 10,

    // ***** Beginners Protection
    "PHOUR" => ($phour = "3600"),
    "PROTECTIOND" => ($protectiond = 18000),
    'fromstart' => ($fromstart = time() - $opening),
    'timestoup' => ($timestoup = $fromstart >= 42300 ? floor($fromstart / 42300) : 0),
    "PROTECTION" => $protectiond + ($timestoup * $phour),
    // ***** Trader capacity
    // Values: 1 (normal, 3 (3x speed) etc...
    "TRADER_CAPACITY" => 10,

    "INCLUDE_ADMIN" => True,

    //////////////////////////////////
    //   ****  SQL SETTINGS  ****   //
    //////////////////////////////////

    // ***** SQL Hostname
    // example. sql107.000space.com / localhost
    // If you host server on own PC than this value is: localhost
    // If you use online hosting, value must be written in host cpanel
    "SQL_SERVER" => "127.0.0.1",

    // ***** Database Username
    "SQL_USER" => "aspidagames",

    // ***** Database Password
    "SQL_PASS" => "d{QT@[v-k0xF",

    // ***** Database Name
    "SQL_DB" => "aspidagames_x10",

    'loginDB-index' => array(
        'Server' => "127.0.0.1",
        'User' => "aspidagames",
        'Password' => "d{QT@[v-k0xF",
        'Database' => "aspidagames_x10",
    ),


    "CP" => "1",

    // ***** PLUS
    //Plus account lenght
    "PLUS_TIME" => (3600 * 12),
    //+25% production lenght
    "PLUS_PRODUCTION" => (3600 * 12),
    "TS_THRESHOLD" => 20,


    //////////////////////////////////////////
    //   ****  DO NOT EDIT SETTINGS  ****   //
    //////////////////////////////////////////
    "ALLOW_ALL_TRIBE" => false,
    "USRNM_MIN_LENGTH" => 3,
    "PW_MIN_LENGTH" => 4,
    "BANNED" => 0,
    "MULTIHUNTER" => 8,
    "ADMIN" => 9,
    "COOKIE_EXPIRE" => 60 * 60 * 24 * 7,
    "COOKIE_PATH" => "/",
    "HOMEPAGE" => "https://www.x10.aspidanetwork.com/",
    "MAXLENGHT" => "15",
    "RADIUS" => 2,

    "OFFENSE1_COST" => 50,
    "OFFENSE1_BONUS" => 25,
    "DEFENCE1_COST" => 50,
    "DEFENCE1_BONUS" => 25,
    "OFF_DEF_TIME" => 43200,
    "POP_FOR_BONUS" => 1000,
    "DAILY_MESSAGE_LIMIT" => 0,
];
?>