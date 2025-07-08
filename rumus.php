<?php
function convert($value, $from, $to) {
    if ($from === $to) return $value;

    switch ($from) {
        case 'celsius':
            switch ($to) {
                case 'fahrenheit': return ($value * 9 / 5) + 32;
                case 'kelvin': return $value + 273.15;
                case 'reamur': return $value * 0.8;
            }
            break;

        case 'fahrenheit':
            $c = ($value - 32) * 5 / 9;
            switch ($to) {
                case 'celsius': return $c;
                case 'kelvin': return $c + 273.15;
                case 'reamur': return $c * 0.8;
            }
            break;

        case 'kelvin':
            $c = $value - 273.15;
            switch ($to) {
                case 'celsius': return $c;
                case 'fahrenheit': return ($c * 9 / 5) + 32;
                case 'reamur': return $c * 0.8;
            }
            break;

        case 'reamur':
            $c = $value / 0.8;
            switch ($to) {
                case 'celsius': return $c;
                case 'fahrenheit': return ($c * 9 / 5) + 32;
                case 'kelvin': return $c + 273.15;
            }
            break;
    }
    return null;
}

$data = json_decode(file_get_contents('php://input'), true);

if ($data && isset($data['value'], $data['from'], $data['to'])) {
    $value = floatval($data['value']);
    $from = $data['from'];
    $to = $data['to'];

    $converted = convert($value, $from, $to);

    if ($converted !== null) {
        $satuan = ['celsius' => '°C', 'fahrenheit' => '°F', 'kelvin' => 'K', 'reamur' => '°R'];
        $hasilText = "$value {$satuan[$from]} = $converted {$satuan[$to]}\n";
        file_put_contents('hasil_konversi.txt', $hasilText, FILE_APPEND);

        echo $hasilText;
    } else {
        echo "Gagal melakukan konversi.";
    }
} else {
    echo "Data tidak lengkap.";
}
?>