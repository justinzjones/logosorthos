<?php

$categories = [
    'news' => 'https://images.unsplash.com/photo-1495020689067-958852a7765e?w=800&q=80',
    'travel' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=800&q=80',
    'aviation' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
    'markets' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=800&q=80',
    'history' => 'https://images.unsplash.com/photo-1505664194779-8beaceb93744?w=800&q=80'
];

$targetDir = __DIR__ . '/../public/assets/images/categories';

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0755, true);
}

foreach ($categories as $category => $url) {
    $targetFile = $targetDir . '/' . $category . '.jpg';
    echo "Downloading image for {$category}...\n";
    
    $imageData = file_get_contents($url);
    if ($imageData !== false) {
        file_put_contents($targetFile, $imageData);
        echo "Successfully downloaded {$category} image\n";
    } else {
        echo "Failed to download {$category} image\n";
    }
}

echo "Done!\n"; 