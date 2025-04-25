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
        // Check if the content is empty
        if (empty($content)) {
            return $content;
        }

        // Load content into DOMDocument for proper HTML parsing
        $dom = new DOMDocument();
        // Preserve UTF-8 encoding
        $dom->encoding = 'UTF-8';
        
        // Use error suppression to avoid warnings about HTML5 tags
        @$dom->loadHTML('<?xml encoding="UTF-8">' . $content);
        
        // Get all paragraph and heading elements (better measure of content sections)
        $xpath = new DOMXPath($dom);
        $nodes = $xpath->query('//p|//h1|//h2|//h3|//h4|//h5|//h6');
        
        $totalNodes = $nodes->length;
        
        // If very few content nodes, just return original content
        if ($totalNodes < 4) {
            return $content;
        }
        
        // Calculate position to insert first ad (approximately 1/3 through content)
        $firstAdPosition = max(2, intval($totalNodes / 3)); // Avoid placing too early
        
        // Calculate position to insert second ad (approximately 2/3 through content)
        $secondAdPosition = max($firstAdPosition + 2, intval($totalNodes * 2 / 3));
        
        // Get the ad HTML
        $adHtml = get_ad_html();
        
        // Create ad nodes
        $firstAd = $dom->createDocumentFragment();
        $firstAd->appendXML($adHtml);
        
        $secondAd = $dom->createDocumentFragment();
        $secondAd->appendXML($adHtml);
        
        // Insert ad after the specified node positions
        if ($firstAdPosition < $totalNodes) {
            $node = $nodes->item($firstAdPosition);
            if ($node && $node->parentNode) {
                $node->parentNode->insertBefore($firstAd, $node->nextSibling);
            }
        }
        
        // Get the nodes again since DOM has been modified
        $nodes = $xpath->query('//p|//h1|//h2|//h3|//h4|//h5|//h6');
        
        if ($secondAdPosition < $nodes->length && $secondAdPosition != $firstAdPosition) {
            $node = $nodes->item($secondAdPosition);
            if ($node && $node->parentNode) {
                $node->parentNode->insertBefore($secondAd, $node->nextSibling);
            }
        }
        
        // Extract the body content
        $body = $dom->getElementsByTagName('body')->item(0);
        $content = '';
        
        if ($body) {
            $children = $body->childNodes;
            foreach ($children as $child) {
                $content .= $dom->saveHTML($child);
            }
        }
        
        // Remove XML encoding declaration
        $content = str_replace('<?xml encoding="UTF-8">', '', $content);
        
        return $content;
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