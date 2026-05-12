<?php
$char = ["xiao", "kazuha", "furina", "nilou", "mualani", "raiden", "nahida", "neuvillete", "mavuica", "arlechino", "xianyun", "xilonen", "citlali"];
    foreach($char as $c){
        echo $c."<br>";
    }

$siswa = [
    [
    "nama" => "Jelita",
    "alamat" => "Sumampir",
    "kelas" => "xi rpl 1"
],  
[
    "nama" => "Nanda",
    "alamat" => "Gunung Wuled",
    "kelas" => "xi rpl 3"
],
[
    "nama" => "Gina",
    "alamat" => "Rajawana",
    "kelas" => "xi rpl 2"
] 
];

foreach($siswa as $s){
    echo $s["nama"]."<br>";
}
?>