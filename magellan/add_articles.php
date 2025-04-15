<?php
// Update these credentials with your Directus login information
$login_data = [
    "email" => "justinzjones@hotmail.com", // Replace with your Directus admin email
    "password" => "Kippercat1!" // Replace with your Directus admin password
];

$ch = curl_init("http://localhost:8055/auth/login");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($login_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
$response = curl_exec($ch);
$result = json_decode($response, true);

if (isset($result["errors"])) {
    echo "Authentication failed: " . $result["errors"][0]["message"] . "\n";
    echo "Please update the script with correct credentials.\n";
    exit(1);
}

$token = $result["data"]["access_token"];
echo "Successfully authenticated with Directus\n";

// Function to create an article
function createArticle($token, $title, $content, $category_id) {
    $article_data = [
        "title" => $title,
        "content" => $content,
        "category" => $category_id,
        "status" => "published"
    ];
    
    $ch = curl_init("http://localhost:8055/items/articles");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($article_data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . $token
    ]);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    
    if (isset($result["errors"])) {
        echo "Failed to create article: " . $result["errors"][0]["message"] . "\n";
        return false;
    }
    
    echo "Successfully created article: " . $title . "\n";
    return true;
}

// News Articles
$news1_title = "Global Tourism Rebounds: Record Numbers Expected in 2023";
$news1_content = '<p>International tourism is witnessing an unprecedented recovery, with industry experts projecting record-breaking visitor numbers by the end of 2023. According to the latest data from the World Tourism Organization (UNWTO), global travel figures have already surpassed pre-pandemic levels in several regions, signaling a robust return of consumer confidence.</p>

<h2>Key Recovery Indicators</h2>

<p>The most significant growth has been observed in the Asia-Pacific region, where inbound tourism has increased by 42% compared to 2022. Europe follows closely with a 35% increase, while the Americas have seen a steady 28% growth in international arrivals.</p>

<p>"What we\'re witnessing is not just a recovery but a transformation of the tourism landscape," says Elena Mendoza, Chief Analyst at Global Travel Insights. "Travelers are staying longer, spending more, and seeking more authentic experiences than before the pandemic."</p>';

createArticle($token, $news1_title, $news1_content, 7);

// Add Travel Article
$travel1_title = "Hidden Gems of Croatia: Beyond Dubrovnik's Ancient Walls";
$travel1_content = '<p>While Dubrovnik\'s majestic walls and terracotta rooftops have captivated Game of Thrones fans and history buffs alike, Croatia\'s true magic lies in its lesser-known destinations. From serene island hideaways to enchanting inland villages, these hidden gems offer authentic experiences away from the summer crowds.</p>

<h2>Vis Island: The Adriatic\'s Best-Kept Secret</h2>

<p>Two hours by ferry from Split lies Vis, an island shrouded in mystique that was closed to foreign visitors until 1989 while serving as a Yugoslav military base. This forced isolation preserved its traditional character, making it perhaps the most authentic coastal experience in Croatia.</p>

<p>The island\'s two main settlements, Vis Town and Komiža, offer distinctly different atmospheres. Vis Town features elegant Venetian architecture around a sweeping harbor, while Komiža presents a more rustic fishing village charm nestled beneath towering cliffs.</p>';

createArticle($token, $travel1_title, $travel1_content, 2);

// Add Aviation Article
$aviation1_title = "Electric Aviation: The Promise and Challenges of Zero-Emission Flight";
$aviation1_content = '<p>Against the backdrop of increasing climate concerns, the aviation industry—responsible for approximately 2.5% of global carbon emissions—faces mounting pressure to decarbonize. Electric propulsion stands as perhaps the most promising pathway to truly emissions-free flight, with profound implications for everything from regional air mobility to the economics of air travel.</p>

<h2>The Current State of Electric Aviation</h2>

<p>While major commercial airliners remain years away from electrification, remarkable progress is already transforming smaller aircraft segments. Pipistrel\'s Velis Electro became the world\'s first fully electric aircraft to receive type certification in 2020, marking a crucial regulatory milestone for the industry. Meanwhile, companies like Eviation, Heart Aerospace, and Bye Aerospace are advancing designs for larger commuter and regional aircraft.</p>';

createArticle($token, $aviation1_title, $aviation1_content, 6);

// Add Markets Article
$markets1_title = "The Rise of Sustainable Finance: How ESG is Reshaping Investment";
$markets1_content = '<p>The global financial landscape is undergoing a profound transformation as environmental, social, and governance (ESG) factors increasingly drive investment decisions. What began as a niche consideration has evolved into a mainstream investment approach, with ESG assets projected to exceed $50 trillion by 2025—representing more than a third of the projected total assets under management worldwide.</p>

<h2>Beyond Ethical Investing</h2>

<p>The evolution from traditional socially responsible investing to modern ESG integration represents more than semantic change. While early ethical investing primarily focused on excluding controversial sectors like tobacco or weapons, today\'s approach involves comprehensive analysis of how environmental, social, and governance factors impact financial performance.</p>';

createArticle($token, $markets1_title, $markets1_content, 3);

// Add History Article
$history1_title = "The Forgotten Innovators: Overlooked Figures Who Changed History";
$history1_content = '<p>History\'s spotlight tends to illuminate a familiar cast of characters—Edison, Einstein, Curie—while countless others who transformed our world remain in the shadows. These overlooked innovators, often marginalized by gender, race, or social status, developed groundbreaking ideas and technologies that continue to shape modern life.</p>

<h2>Hedy Lamarr: From Hollywood Glamour to Wireless Technology</h2>

<p>In 1940s Hollywood, Hedy Lamarr was celebrated as "the most beautiful woman in the world," starring alongside legends like Clark Gable and Spencer Tracy. Few knew that behind her silver screen persona was a brilliant inventor whose work would eventually help enable WiFi, Bluetooth, and cellular technology.</p>';

createArticle($token, $history1_title, $history1_content, 8);

echo "Content creation process complete\n";
