
<div class="flex flex-col min-h-screen">
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->

    <!-- Layout Wrapper -->
    <x-magellan-layout>
        <!-- Hero Section -->
        <x-travel_hero :country="$country" />
                <!-- Travel Navbar -->
        <div class="z-10 w-full bg-gray-800">
            <x-travel_navbar />
        </div>

        <!-- Main Content -->
        <x-travel_overview />



        <!-- Footer -->
        <x-footer class="w-full" />
    </x-magellan-layout>
</div>

