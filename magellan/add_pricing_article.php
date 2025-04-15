<?php
// Authenticate with Directus
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

// First, let's upload an image from Unsplash
$unsplash_image_url = "https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=1200";
$image_data = file_get_contents($unsplash_image_url);

// Upload image to Directus
$image_filename = "airline_pricing_" . time() . ".jpg";
$boundary = uniqid();
$file_data = "--" . $boundary . "\r\n";
$file_data .= 'Content-Disposition: form-data; name="title"' . "\r\n\r\n";
$file_data .= "Airline Pricing Image\r\n";
$file_data .= "--" . $boundary . "\r\n";
$file_data .= 'Content-Disposition: form-data; name="file"; filename="' . $image_filename . '"' . "\r\n";
$file_data .= 'Content-Type: image/jpeg' . "\r\n\r\n";
$file_data .= $image_data . "\r\n";
$file_data .= "--" . $boundary . "--\r\n";

$ch = curl_init("http://localhost:8055/files");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $file_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $token,
    "Content-Type: multipart/form-data; boundary=" . $boundary,
    "Content-Length: " . strlen($file_data)
]);
$response = curl_exec($ch);
$image_result = json_decode($response, true);

if (isset($image_result["errors"])) {
    echo "Failed to upload image: " . $image_result["errors"][0]["message"] . "\n";
    exit(1);
}

$image_id = $image_result["data"]["id"];
echo "Successfully uploaded image with ID: " . $image_id . "\n";

// Create article with the formatted content
$title = "How Airline Pricing Works – The Foundations of Fare Construction";
$content = '<p><em>"If you want to understand how airlines compete, follow the fare."</em><br>— Airline Pricing Analyst, on their 10th coffee</p>

<h2>Introduction</h2>

<p>At the heart of every airline seat sold is a carefully calculated price. But airline pricing is far from simple—it\'s a complex dance between demand, competition, costs, timing, and technology. This article aims to demystify how airline pricing works, especially for those new to the topic or coming from outside the airline industry.</p>

<p>Whether you\'re a product manager, a developer, or just curious about how airfares appear on your favorite booking site, this guide will give you the foundation to understand pricing decisions—and how tools like PriceEye help airlines compete in a volatile market.</p>

<hr>

<h2>What Is Airline Pricing?</h2>

<p>At a high level, airline pricing is the process by which an airline determines what price to charge for each seat on a flight. Unlike many other industries, airlines sell a perishable product—once a plane takes off, any unsold seat generates $0. This changes everything.</p>

<p>Pricing in this context isn\'t just about covering costs; it\'s about maximizing revenue and managing demand under uncertain and competitive conditions.</p>

<hr>

<h2>Key Concepts and Terminology</h2>

<p>Let\'s explore some of the foundational concepts that underpin airline pricing.</p>

<h3>1. Fares vs. Prices</h3>
<ul>
  <li>Fare: The base amount an airline charges for transportation (e.g., $300).</li>
  <li>Price: The total amount the customer pays, including taxes, fees, and surcharges (e.g., $387.60).</li>
</ul>

<h3>2. Fare Class (or Booking Class)</h3>
<ul>
  <li>Airlines use fare classes (e.g., Y, M, K, L) to segment inventory.</li>
  <li>Each class comes with its own rules, restrictions, and price.</li>
  <li>This is the basic unit that Revenue Management systems control.</li>
</ul>

<h3>3. Published vs. Private Fares</h3>
<ul>
  <li>Published fares are available to anyone through global distribution systems (GDS).</li>
  <li>Private fares are offered through negotiated deals, tour operators, or corporate contracts.</li>
</ul>

<h3>4. Fare Rules</h3>
<ul>
  <li>Determine refundability, changeability, advance purchase, and more.</li>
  <li>Essential for differentiating product offerings beyond price alone.</li>
</ul>

<hr>

<h2>Who Sets the Fares?</h2>

<p>Pricing is typically owned by the Pricing or Pricing & Revenue Management team at the airline. Their role includes:</p>
<ul>
  <li>Monitoring competitive fares</li>
  <li>Defining fare structures by market</li>
  <li>Setting price points and product differentiation</li>
  <li>Creating fare rules and restrictions</li>
  <li>Collaborating with RM to manage seat inventory and availability</li>
</ul>

<p>Some key players in the ecosystem include:</p>
<ul>
  <li>ATPCO (Airline Tariff Publishing Company): The central repository where airlines file fares.</li>
  <li>GDSs (e.g., Sabre, Amadeus, Travelport): Distribute fares to travel agencies and booking platforms.</li>
  <li>OTA/Metas (e.g., Expedia, Google Flights): Display and sell airline fares to consumers.</li>
</ul>

<hr>

<h2>The Fare Construction Process</h2>

<p>Here\'s a simplified overview of how a fare is created and delivered:</p>

<h3>1. Market Strategy</h3>
<ul>
  <li>Pricing analysts define what markets (city pairs) they want to serve.</li>
  <li>Decisions are based on demand forecasts, competitive positioning, and route profitability.</li>
</ul>

<h3>2. Fare Filing</h3>
<ul>
  <li>Fares are created and filed in ATPCO.</li>
  <li>Filed fares include: fare amount, origin-destination pair, class of service, rules, seasonality, and day-of-week applicability.</li>
</ul>

<h3>3. Distribution</h3>
<ul>
  <li>The fare is distributed to sales channels through GDSs and direct airline systems.</li>
  <li>Consumers can now book the fare through OTAs, agencies, or airline websites.</li>
</ul>

<h3>4. Monitoring and Adjustment</h3>
<ul>
  <li>Fares are constantly monitored for effectiveness and competitiveness.</li>
  <li>PriceEye and similar tools help automate monitoring of fare positioning and anomalies.</li>
</ul>

<hr>

<h2>Competitive Considerations</h2>

<p>Airline pricing is intensely competitive. Airlines constantly monitor each other\'s pricing in real time using scraping tools, subscription to competitive fare feeds, or third-party solutions like PriceEye.</p>

<p>Reacting quickly is essential. A competitor\'s new fare in your market might mean:</p>
<ul>
  <li>You\'re overpriced and losing traffic</li>
  <li>You\'re underpriced and losing revenue</li>
  <li>Your product (fare rules, schedule, brand) needs adjustment</li>
</ul>

<hr>

<h2>Price Discrimination and Segmentation</h2>

<p>Airlines famously charge different prices for the same seat on the same plane. Why?</p>

<p>Because they segment their market by:</p>
<ul>
  <li>Purchase timing</li>
  <li>Length of stay</li>
  <li>Refundability</li>
  <li>Booking channel</li>
  <li>Traveler type (leisure vs. business)</li>
</ul>

<p>This is called price discrimination, and it\'s not unfair—it\'s how airlines can profitably serve both cost-conscious leisure travelers and schedule-driven business travelers on the same flight.</p>

<hr>

<h2>The Role of Technology</h2>

<p>Fare management involves a mix of:</p>
<ul>
  <li>Fare filing tools (used to file prices and rules into ATPCO)</li>
  <li>Analytical platforms (e.g., PriceEye, for comparing and reacting to market prices)</li>
  <li>Revenue Management Systems (which control availability of each fare class)</li>
</ul>

<hr>

<h2>Conclusion</h2>

<p>Airline pricing is a fast-moving, analytical, and strategic process. It\'s shaped by competitive forces, demand uncertainty, and sophisticated technology. At its heart is a balancing act: sell the right seat, to the right customer, at the right time, for the right price.</p>

<p>In the next article, we\'ll explore Revenue Management—the discipline that ensures those carefully crafted fares are matched with the right inventory to maximize revenue.</p>';

$article_data = [
    "title" => $title,
    "content" => $content,
    "category" => 6, // Aviation category
    "status" => "published",
    "featured_image" => $image_id
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
    exit(1);
}

echo "Successfully created article: " . $title . "\n";
echo "Content creation process complete\n"; 