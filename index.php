<?php
    $title = "Index";
    $hello = "Hello";
?>
<html>
    <head>
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <h1><?php echo $hello; ?></h1>
        <div id="live-video-container"></div>
    <script>
        let player;

function onYouTubeIframeAPIReady() {
    fetchAndDisplayLiveVideo();
}

async function fetchAndDisplayLiveVideo() {
    try {
        const response = await fetch('get_video.php');
        const data = await response.json();

        if (data.error) {
            console.log(data.error);
            return;
        }

        const { videoId, title, description, isLive, publishedAt } = data;

        // Calculate if the video should be displayed
        const currentTime = new Date();
        const publishedTime = new Date(publishedAt);
        const diffInHours = (currentTime - publishedTime) / (1000 * 60 * 60);

        // if (isLive || diffInHours <= 24) {
        if (true) { // testing purposes only
            // Create a div for the YouTube player if not already present
            let container = document.getElementById('live-video-container');
            container.innerHTML = `
                <div id="youtube-player"></div>
                <h2>${title}</h2>
                <p>${description}</p>
            `;
            container.style.display = 'block';

            // Initialize YouTube Player
            player = new YT.Player('youtube-player', {
                    height: '315',
                    width: '560',
                    videoId: videoId,
                    playerVars: {
                        'autoplay': 1,
                        'mute': 1
                    },
                    events: {
                        'onStateChange': onPlayerStateChange
                    }
                });
            } else {
                hideLiveVideo();
            }
            } catch (error) {
                console.error('Error fetching video data:', error);
            }
        }

        function onPlayerStateChange(event) {
            // Check if the video has ended
            if (event.data === YT.PlayerState.ENDED) {
                hideLiveVideo();
            }
        }

        function hideLiveVideo() {
            const container = document.getElementById('live-video-container');
            container.style.display = 'none';
        }

        // Load YouTube IFrame API script
        const tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        const firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    </script>
    </body>
</html>