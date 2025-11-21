<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class YouTubeMetadataService
{
    /**
     * Extract YouTube video ID from URL
     */
    public function extractVideoId(string $url): ?string
    {
        // Handle various YouTube URL formats
        $patterns = [
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\?\/]+)/',
            '/youtube\.com\/embed\/([^&\?\/]+)/',
            '/youtube\.com\/v\/([^&\?\/]+)/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    /**
     * Fetch video metadata using YouTube oEmbed API
     */
    public function fetchMetadata(string $videoId): array
    {
        try {
            $url = "https://www.youtube.com/watch?v={$videoId}";
            
            // Use YouTube oEmbed API (no API key required)
            $response = Http::get('https://www.youtube.com/oembed', [
                'url' => $url,
                'format' => 'json'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'title' => $data['title'] ?? 'Untitled Video',
                    'thumbnail_url' => $data['thumbnail_url'] ?? $this->getDefaultThumbnail($videoId),
                    'author_name' => $data['author_name'] ?? null,
                ];
            }
        } catch (\Exception $e) {
            // Fallback to default thumbnail if API fails
        }

        // Return defaults if API fails
        return [
            'title' => 'YouTube Video',
            'thumbnail_url' => $this->getDefaultThumbnail($videoId),
            'author_name' => null,
        ];
    }

    /**
     * Get default YouTube thumbnail URL
     */
    protected function getDefaultThumbnail(string $videoId): string
    {
        return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
    }
}
