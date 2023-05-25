<?php

use app\models\City;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$result = json_decode($result);

if ($result->status == 'success') {
    echo $result->city;


    $getIdByName = City::find()->where('name = :name', [':name' => $result->city])->one();  //поиск имени в базе и вывод его id

    if (!$getIdByName) {                      //сохраняем сразу город если нет в базе
        $customer = new City();
        $customer->name = $result->city;
        $customer->save();
    }
}