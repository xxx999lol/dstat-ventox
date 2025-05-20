<?php
$ip = $_SERVER['REMOTE_ADDR'];
$file = 'ips.json';

$methodList = ['HTTP', 'HTTP DDoS', 'Bypass', 'Blocked'];
$method = $methodList[array_rand($methodList)];

$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$found = false;
foreach ($data as &$entry) {
    if ($entry['ip'] === $ip) {
        $found = true;
        break;
    }
}
unset($entry);

if (!$found) {
    $data[] = ['ip' => $ip, 'method' => $method];
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

echo count($data);
?>
