<?php

if (!function_exists('directus_asset')) {
    /**
     * Generate a URL for a Directus asset.
     *
     * @param  string  $path
     * @return string
     */
    function directus_asset($path)
    {
        // For asset URLs in the browser, we need to use a publicly accessible URL
        // Use DIRECTUS_PUBLIC_URL for browser-accessible assets instead of the internal Docker network name
        return rtrim(env('DIRECTUS_PUBLIC_URL', 'http://localhost:8055'), '/') . '/assets/' . ltrim($path, '/');
    }
}

if (!function_exists('get_excerpt')) {
    /**
     * Generate an excerpt from HTML content.
     *
     * @param  string  $content  The HTML content to extract from
     * @param  int  $sentences  Number of sentences to extract
     * @param  int  $words_min  Minimum number of words if sentences are too short
     * @return string
     */
    function get_excerpt($content, $sentences = 2, $words_min = 15)
    {
        if (!$content) {
            return '';
        }
        
        // Strip HTML tags and decode entities
        $text = strip_tags($content);
        $text = html_entity_decode($text);
        
        // Get sentences
        $sentences_array = preg_split('/(?<=[.!?])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        
        // Get the specified number of sentences
        $excerpt = implode(' ', array_slice($sentences_array, 0, $sentences));
        
        // If the excerpt is too short, use word count instead
        $word_count = str_word_count($excerpt);
        if ($word_count < $words_min && count($sentences_array) > $sentences) {
            // Get more sentences until we reach the minimum word count
            $i = $sentences;
            while ($word_count < $words_min && isset($sentences_array[$i])) {
                $excerpt .= ' ' . $sentences_array[$i];
                $word_count = str_word_count($excerpt);
                $i++;
            }
        }
        
        // Add ellipsis if the excerpt doesn't end with punctuation
        if (!preg_match('/[.!?]$/', $excerpt)) {
            $excerpt .= '...';
        }
        
        return $excerpt;
    }
}

if (!function_exists('insert_ads_in_content')) {
    /**
     * Insert advertisements into article content
     * 
     * @param string $content The HTML content
     * @return string Content with ads inserted
     */
    function insert_ads_in_content($content) 
    {
        // Remove any existing HTML comments
        $content = preg_replace('/<!--.*?-->/s', '', $content);
        
        // Split content by paragraphs (basic approach)
        $paragraphs = preg_split('/<\/p>\s*<p[^>]*>/i', $content);
        
        // If less than 3 paragraphs, just return original content
        if (count($paragraphs) < 3) {
            return $content;
        }
        
        // The total number of paragraphs
        $totalParagraphs = count($paragraphs);
        
        // Calculate position to insert first ad (approximately 1/3 through content)
        $firstAdPosition = max(1, floor($totalParagraphs / 3));
        
        // Calculate position to insert second ad (approximately 2/3 through content)
        $secondAdPosition = max($firstAdPosition + 1, floor($totalParagraphs * 2 / 3));
        
        // Get the ad HTML
        $adHtml = get_ad_html();
        
        // Insert ads at calculated positions
        $result = '';
        
        for ($i = 0; $i < $totalParagraphs; $i++) {
            // Add the paragraph
            $result .= $paragraphs[$i];
            
            // Add paragraph closing/opening tags if this isn't the last paragraph
            if ($i < $totalParagraphs - 1) {
                $result .= '</p><p>';
            }
            
            // Add first ad after the firstAdPosition paragraph
            if ($i == $firstAdPosition) {
                $result .= '</p>' . $adHtml . '<p>';
            }
            
            // Add second ad after the secondAdPosition paragraph
            if ($i == $secondAdPosition && $secondAdPosition != $firstAdPosition) {
                $result .= '</p>' . $adHtml . '<p>';
            }
        }
        
        // Make sure content is properly wrapped in paragraph tags
        if (!preg_match('/^<p/i', $result)) {
            $result = '<p>' . $result;
        }
        if (!preg_match('/<\/p>$/i', $result)) {
            $result .= '</p>';
        }
        
        return $result;
    }
}

if (!function_exists('get_ad_html')) {
    /**
     * Generate HTML for an advertisement
     * 
     * @return string Ad HTML
     */
    function get_ad_html() 
    {
        return '<div class="mt-4 mb-4"> <div class="p-4 my-12 bg-gray-50 rounded-lg border border-gray-200">
            <h3 class="mb-2 text-lg font-semibold">Sponsored Content</h3>
            <p class="text-gray-600">Advertisement placeholder</p>
        </div> </div>';
    }
} 