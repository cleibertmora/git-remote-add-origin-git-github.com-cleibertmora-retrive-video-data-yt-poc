# YouTube Live Event Detection PoC

This PoC demonstrates how to detect and embed live YouTube events from a specified channel using PHP and JavaScript.

## Prerequisites

- PHP installed (preferably PHP 8.0 or newer)
- API Key for YouTube Data API
- Valid YouTube channel ID

## Setup

### 1. Clone the Repository

git clone <repository-url>
cd project-root

### 2. Configure API Credentials

Create a `config.json` file in the project root. This file will store your API key and YouTube channel ID. **Ensure this file is listed in your `.gitignore` to protect sensitive data.**

#### Example `config.json`

{
    "YOUTUBE_PUBLIC_API_KEY": "YOUR_YOUTUBE_API_KEY",
    "YOUTUBE_CHANNEL_ID": "YOUR_YOUTUBE_CHANNEL_ID"
}

### 3. Run the PHP Script Manually

To fetch the latest video, run:

`php fetch_last_video.php`

This will create/update a `latest_video.json` file with the latest video details.

### 4. Frontend Integration

The `index.php` file contains a simple webpage that loads the video data through JavaScript and embeds the video.

### 5. Viewing the PoC

Run `php -S localhost:8000` Open `localhost:8000` in a browser to test the embedding functionality.

## Usage

1. Create and update `config.json` with valid API credentials.
2. Run `fetch_last_video.php` to fetch and store video details.
3. Open the webpage to see if a live video is embedded.
4. The last video will be displayed automatically.
