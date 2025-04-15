<div class="bg-gray-900">
    <x-travel_header />

    <div class="relative overflow-hidden isolate pt-14">
        @if($location->hero)
            <img src="{{ directus_asset($location->hero) }}" alt="" class="absolute inset-0 object-cover -z-10 size-full">
        @endif

        <div class="absolute inset-x-0 overflow-hidden -top-40 -z-10 transform-gpu blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(...)"></div>
        </div>

        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-5xl py-32 mx-auto sm:py-48 lg:py-56">
                <div class="hidden sm:mb-8 sm:flex sm:justify-left">
                    @if($location)
                        <x-travel_breadcrumbs :location="$location" />
                    @endif
                </div>
                <div class="text-left">
                    <h1 class="text-5xl font-semibold tracking-tight text-white text-balance sm:text-7xl">{{ $location->name ?? 'Unknown Location' }}</h1>
                    @if($location->preamble)
                        <p class="mt-8 text-lg font-medium text-gray-400 text-pretty sm:text-xl/8">{{ $location->preamble }}</p>
                    @endif
                    <div class="flex items-center justify-center mt-10 gap-x-6">
                        <a href="#" class="rounded-md bg-san-felix-900 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-san-felix-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400">Get started</a>
                        <a href="#" class="font-semibold text-white text-sm/6">Learn more <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(...)"></div>
        </div>
    </div>
</div>