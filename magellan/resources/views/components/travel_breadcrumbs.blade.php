<div>
    <nav class="flex" aria-label="Breadcrumb">
        <ol role="list" class="flex items-center space-x-2">
            <!-- Home Breadcrumb -->
            <li>
                <div>
                    <a href="/" class="text-gray-300 hover:text-gray-400">
                        <svg class="size-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Home</span>
                    </a>
                </div>
            </li>

            <!-- Destinations Breadcrumb -->
            <li>
                <div class="flex items-center">
                    <svg class="text-gray-200 size-5 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                    <a href="/travel" class="ml-2 text-sm font-medium text-gray-300 hover:text-gray-400">Destinations</a>
                </div>
            </li>

            <!-- Region Breadcrumb -->
            <li>
                <div class="flex items-center">
                    <svg class="text-gray-200 size-5 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                    <a href="/travel/region/{{$location->fk_region->id ?? $location->id}}" class="ml-2 text-sm font-medium text-gray-300 hover:text-gray-400">
                        {{$location->fk_region->name ?? $location->name}}
                    </a>
                </div>
            </li>

            <!-- Country Breadcrumb (only if location is a country) -->
            @if($location->type === 'country')
            <li>
                <div class="flex items-center">
                    <svg class="text-gray-200 size-5 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                    <a href="#" class="ml-2 text-sm font-medium text-gray-300 hover:text-gray-400" aria-current="page">
                        {{$location->name}}
                    </a>
                </div>
            </li>
            @endif
        </ol>
    </nav>
</div>