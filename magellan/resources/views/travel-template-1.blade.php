<div class="flex flex-col min-h-screen">
    <!-- Layout Wrapper -->
    <x-magellan-layout>
        <!-- Hero Section -->
        <x-travel_hero :location="$location" />
                <!-- Travel Navbar -->
        <x-travel_navbar />

        <!-- Main Content -->
        <!-- <div class="flex-grow">
            <div class="p-6">
                <h2>Main Content Section</h2>
                <p>Here is some content above the navbar...</p>
                <div class="mt-10 h-96 bg-gray-100"></div>
                <div class="mt-10 h-96 bg-gray-200"></div>
                <div class="mt-10 h-96 bg-gray-300"></div>
            </div>
        </div> -->
         <!-- Main Content -->
         <x-travel_overview :location="$location"/>


        <!-- Footer -->
        <x-footer class="w-full" />
    </x-magellan-layout>
</div>