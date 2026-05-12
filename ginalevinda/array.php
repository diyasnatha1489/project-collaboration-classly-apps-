<?php
function tampilArray(){
    $rpl2 = ["Aleana", "Annisa", "Anjani", "Cahaya", "Defin", "Diyas", "Faizah", "Fandi", "Fateeh", "Fioletha", "Gina", "Hafisd", "Hidayat", "Indana", "Iren", "Kesya", "Keza", "Khikin", "Liliana", "Lutfiana", "Mahera", "Maula", "Moza", "Nara", "Nabila", "Naisa", "Nasywa", "Naufal", "Novita", "Ririn", "Rizky", "Rozzmal", "Sabila", "Tatik", "Titik", "Zerlinda"];
    foreach($rpl2 as $s){
        echo $s."<br>";
    }

$char = [
    [
        "character" => "Sunday",
        "path" => "Harmony",
        "element" => "Imaginary",
    ],
    [
        "character" => "Phainon",
        "path" => "Destruction",
        "element" => "Physical",
    ],
    [
        "character" => "Anaxa",
        "path" => "Erudition",
        "element" => "Wind",
    ],
    [
        "character" => "Mydei",
        "path" => "Destruction",
        "element" => "Imaginary",
    ],
    [
        "character" => "Jing Yuan",
        "path" => "Erudition",
        "element" => "Lightning",
    ]
];

foreach($char as $c){
    echo "Character : ".$c["character"]."<br>";
    echo "Path : ".$c["path"]."<br>";
    echo "Element : ".$c["element"]."<br>";
}
}
tampilArray();
tampilArray();
tampilArray();
?>