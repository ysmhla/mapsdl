<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['url'])) {
    echo json_encode(['success' => false, 'message' => 'No URL provided.']);
    exit;
}

$url = $data['url'];
$decodedUrl = urldecode($url);

// Check if it's a review photo or video
if (preg_match('/!6s(https:\/\/lh\d*\.googleusercontent\.com\/[^!=]+)/', $decodedUrl, $matches)) {
    $baseMediaUrl = $matches[1];
    
    // Check if it's a video by testing the "=dv" (Download Video) modifier
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseMediaUrl . '=dv');
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 302 || $httpCode == 200 || $httpCode == 301) {
        // It's a video, use the original download video modifier
        $finalUrl = $baseMediaUrl . '=dv';
        $isVideo = true;
    } else {
        // It's an image, use the size 0 modifier for uncompressed HD
        $finalUrl = $baseMediaUrl . '=s0';
        $isVideo = false;
    }
    
    echo json_encode(['success' => true, 'url' => $finalUrl, 'is_video' => $isVideo]);
}
// Otherwise, try to fallback to a Street View static API capture by parsing coordinates
else if (preg_match('/@([-.\d]+),([-.\d]+),.*?,([-\d.]+)y,([-\d.]+)t/', $url, $matches)) {
    $lat = $matches[1];
    $lng = $matches[2];
    $heading = $matches[3];
    $pitch = (float)$matches[4] - 90;
    
    $apiKey = 'REPLACE_WITH_YOUR_API_KEY';
    $imageUrl = "https://maps.googleapis.com/maps/api/streetview?size=600x400&location={$lat},{$lng}&heading={$heading}&pitch={$pitch}&key={$apiKey}";
    
    echo json_encode(['success' => true, 'url' => $imageUrl, 'is_video' => false]);
} else {
    echo json_encode(['success' => false, 'message' => 'Could not parse the URL. Is it a valid Google Maps review or Street View URL?']);
}
