<?php
$configFilePath = __DIR__ . '/config.json';

if (!file_exists($configFilePath)) {
    die('Configuration file not found.');
}

function fetchLatestYouTubeVideo($apiKey, $channelId, $jsonFilePath) {
    $url = "https://www.googleapis.com/youtube/v3/search?key={$apiKey}&channelId={$channelId}&part=snippet&type=video&order=date&maxResults=1";

    $response = file_get_contents($url);
    if ($response === FALSE) {
        die('Error occurred while fetching data from YouTube.');
    }

    $data = json_decode($response, true);

    if (!isset($data['items']) || empty($data['items'])) {
        die('No videos found.');
    }

    $latestVideo = $data['items'][0];
    $videoId = $latestVideo['id']['videoId'];
    $title = $latestVideo['snippet']['title'];
    $description = $latestVideo['snippet']['description'];
    $isLive = $latestVideo['snippet']['liveBroadcastContent'] === 'live';
    $publishedAt = $latestVideo['snippet']['publishedAt'];

    $videoData = [
        'videoId' => $videoId,
        'title' => $title,
        'description' => $description,
        'isLive' => $isLive,
        'publishedAt' => $publishedAt
    ];

    file_put_contents($jsonFilePath, json_encode($videoData, JSON_PRETTY_PRINT));
}

// Configuration
$config = json_decode(file_get_contents($configFilePath), true);
$apiKey = $config['YOUTUBE_PUBLIC_API_KEY'];
$channelId = $config['YOUTUBE_CHANNEL_ID'];
$jsonFilePath = 'latest_video.json'; // JSON file to store video data

fetchLatestYouTubeVideo($apiKey, $channelId, $jsonFilePath);

echo "YouTube data fetched and saved.";
?>