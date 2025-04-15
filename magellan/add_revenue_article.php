<?php
// Authenticate with Directus
$login_data = [
    "email" => "justinzjones@hotmail.com",
    "password" => "Kippercat1!"
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
$unsplash_image_url = "https://images.unsplash.com/photo-1575629393440-887257f4e199?q=80&w=1200";
$image_data = file_get_contents($unsplash_image_url);

// Upload image to Directus
$image_filename = "airline_revenue_" . time() . ".jpg";
$boundary = uniqid();
$file_data = "--" . $boundary . "\r\n";
$file_data .= 'Content-Disposition: form-data; name="title"' . "\r\n\r\n";
$file_data .= "Airline Revenue Management Image\r\n";
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
$title = "Introduction to Airline Revenue Management – Balancing Demand and Profit";
$content = '<p><em>"It\'s not about selling every seat. It\'s about selling the right seats, at the right price, to the right people."</em><br>— Airline RM mantra</p>

<h2>Introduction</h2>

<p>Once an airline publishes its fares, the next question becomes: how many seats should be sold at each fare? That\'s where Revenue Management (RM) comes in.</p>

<p>Airline Revenue Management is the art and science of maximizing revenue from a fixed, perishable inventory (seats on a flight) by selling it in a way that matches demand to price sensitivity. This article will help you understand the core concepts of RM, how it connects to pricing, and how it drives decisions airlines make every minute of every day.</p>

<hr>

<h2>Why Revenue Management Matters</h2>

<p>Airlines operate in a unique environment:</p>
<ul>
  <li>Seats are perishable: once the plane departs, any empty seat is lost revenue.</li>
  <li>Demand is uncertain: customer behavior shifts due to seasons, events, competitor actions, and more.</li>
  <li>Margins are thin: optimizing every seat sold can mean the difference between profit and loss.</li>
</ul>

<p>RM exists to address these challenges by answering key questions:</p>
<ul>
  <li>How many seats should be made available at each fare class?</li>
  <li>When should cheaper fares be closed off?</li>
  <li>How much demand do we expect for each class?</li>
  <li>What\'s the optimal mix of leisure and business customers?</li>
</ul>

<hr>

<h2>The Building Blocks of RM</h2>

<p>RM isn\'t a single action—it\'s a discipline built on three core pillars:</p>

<h3>1. Demand Forecasting</h3>

<p>Forecasting helps estimate how many passengers will want to travel on a flight, and how much they are willing to pay. Airlines use historical booking patterns, seasonality, events (e.g., conferences), and booking curves to project:</p>
<ul>
  <li>Total demand per flight</li>
  <li>Demand by price point</li>
  <li>Booking lead times</li>
</ul>

<h3>2. Inventory Control</h3>

<p>Once demand is forecasted, RM systems decide how many seats to allocate to each booking class. This isn\'t the same as overbooking—this is about controlling availability:</p>
<ul>
  <li>High-paying business travelers often book late, so seats are reserved for them.</li>
  <li>Lower fare classes might be closed off as departure nears and demand increases.</li>
</ul>

<p>This is also known as availability management.</p>

<h3>3. Overbooking Management</h3>

<p>Airlines overbook flights knowing a percentage of passengers will no-show. RM helps estimate safe overbooking levels to avoid flying with empty seats while minimizing denied boarding.</p>

<hr>

<h2>Fare Classes and Availability</h2>

<p>Think of each fare class (Y, M, L, K, etc.) as a bucket of seats sold at a specific price. These are filed by the pricing team, but it\'s the RM system that decides:</p>
<ul>
  <li>Which fare classes are available for sale at any given moment</li>
  <li>How many seats can be sold in each class</li>
</ul>

<p>For example, if a flight is 60 days out, the system might open all fare classes (cheap and expensive). As demand builds, it will start closing lower fare classes to preserve inventory for higher-paying passengers.</p>

<p>This is called dynamic availability.</p>

<hr>

<h2>Example: How RM Changes Availability</h2>

<p>Let\'s say an airline has these filed fares in economy for a given flight:</p>

<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Fare Class</th>
        <th>Price</th>
        <th>Refundable</th>
        <th>Changeable</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>K</td>
        <td>$150</td>
        <td>No</td>
        <td>No</td>
      </tr>
      <tr>
        <td>M</td>
        <td>$200</td>
        <td>No</td>
        <td>Yes</td>
      </tr>
      <tr>
        <td>Y</td>
        <td>$400</td>
        <td>Yes</td>
        <td>Yes</td>
      </tr>
    </tbody>
  </table>
</div>

<p>At 90 days before departure:</p>
<ul>
  <li>RM might open all classes, including K.</li>
</ul>

<p>At 14 days before departure:</p>
<ul>
  <li>RM might close K and M, only offering Y class, expecting business travelers.</li>
</ul>

<p>This strategic control of availability is the heart of RM.</p>

<hr>

<h2>The Role of Systems</h2>

<p>RM is far too complex to manage manually. Airlines rely on specialized Revenue Management Systems (RMS), which use algorithms and historical data to automate:</p>
<ul>
  <li>Demand forecasts</li>
  <li>Availability decisions</li>
  <li>Dynamic pricing triggers (in some cases)</li>
</ul>

<p>Major RM systems include:</p>
<ul>
  <li>Sabre AirVision</li>
  <li>Amadeus Optym</li>
  <li>PROS RM</li>
  <li>Lufthansa Systems NetLine/Ops</li>
</ul>

<p>Some airlines have even built proprietary RM systems for greater control.</p>

<hr>

<h2>Segmenting the Market</h2>

<p>A core principle of RM is market segmentation. Not all passengers are alike—RM seeks to serve multiple passenger types on the same flight:</p>

<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Segment</th>
        <th>Characteristics</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Leisure traveler</td>
        <td>Price-sensitive, books early, flexible dates</td>
      </tr>
      <tr>
        <td>Business traveler</td>
        <td>Less price-sensitive, books late, fixed times</td>
      </tr>
      <tr>
        <td>Group traveler</td>
        <td>Price-sensitive, books early, fills many seats</td>
      </tr>
    </tbody>
  </table>
</div>

<p>RM aims to:</p>
<ul>
  <li>Sell lower fares to fill the plane early</li>
  <li>Preserve high-fare availability for late-booking business travelers</li>
  <li>Balance overall yield (revenue per seat)</li>
</ul>

<hr>

<h2>Revenue vs. Load Factor</h2>

<p>A common misconception is that the goal is to fill every seat. Not always.</p>

<p>Airlines are more interested in maximizing revenue, not just passengers. A fuller flight doesn\'t always mean more profit. RM often prefers to sell fewer seats at higher fares than fill a plane with low-paying travelers.</p>

<p>This is why you might see empty seats on a plane that was "sold out" in lower fare classes—it\'s intentional.</p>

<hr>

<h2>How RM and Pricing Work Together</h2>

<p>Think of Pricing as setting the menu, and RM as deciding what\'s available from that menu at any given time.</p>

<p>They need to be closely aligned:</p>
<ul>
  <li>If prices are set too low, RM can\'t yield enough revenue.</li>
  <li>If RM restricts too much availability, seats go unsold.</li>
</ul>

<p>In modern airline organizations, pricing and RM often sit in the same department or collaborate tightly through shared systems and goals.</p>

<hr>

<h2>The RM Toolkit</h2>

<p>In addition to RMS platforms, RM teams use:</p>
<ul>
  <li>Dashboards and alerts to track booking trends and anomalies</li>
  <li>Competitive fare monitoring tools like PriceEye to adjust to market moves</li>
  <li>Post-departure analytics to analyze performance and recalibrate forecasts</li>
</ul>

<p>For example, if an RM analyst sees that a competitor just lowered fares for a key route, they might adjust availability or escalate for a potential reprice.</p>

<hr>

<h2>Challenges in RM</h2>

<p>Some of the real-world challenges RM professionals face include:</p>
<ul>
  <li>Forecasting volatility (e.g., during pandemics, geopolitical events)</li>
  <li>Balancing automation vs. human intervention</li>
  <li>Managing demand spikes from fare wars or events</li>
  <li>Integrating ancillaries and dynamic pricing models</li>
</ul>

<hr>

<h2>RM in the Age of Data</h2>

<p>Modern RM is evolving. Machine learning, customer segmentation, personalization, and real-time data are reshaping RM practices.</p>

<p>Some airlines are experimenting with continuous pricing—moving away from rigid fare buckets to offer more flexible prices based on real-time inputs.</p>

<p>Others are integrating ancillaries (bags, seats, meals) into RM to optimize total revenue, not just ticket price.</p>

<hr>

<h2>Conclusion</h2>

<p>Revenue Management is the engine behind airline profitability. It ensures the fares created by the pricing team are sold in a way that captures the most value. RM is data-driven, highly dynamic, and deeply tied to forecasting and automation.</p>

<p>Understanding RM helps explain why airfares seem to change constantly—and why two passengers sitting side-by-side may have paid dramatically different amounts.</p>

<p>In the next article, we\'ll explore how airlines actually make changes to fares in the marketplace—including how those changes are filed, distributed, and monitored using tools like PriceEye.</p>';

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
    "Content-Type": "application/json",
    "Authorization": "Bearer " . $token
]);
$response = curl_exec($ch);
$result = json_decode($response, true);

if (isset($result["errors"])) {
    echo "Failed to create article: " . $result["errors"][0]["message"] . "\n";
    exit(1);
}

echo "Successfully created article: " . $title . "\n";
echo "Content creation process complete\n"; 