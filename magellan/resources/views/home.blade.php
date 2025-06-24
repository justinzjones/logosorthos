<x-magellan-layout>

  <x-header/>

  <!-- Hero Section - Featured Article -->
  <div class="relative bg-gray-100">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="py-8 lg:py-12">
        @if(isset($articles[0]))
          <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">
            <!-- Main Featured Article -->
            <div class="relative lg:col-span-3">
              <a href="{{ $articles[0]->category->name }}/articles/{{ $articles[0]->id }}" class="group">
                <div class="relative aspect-[16/9] overflow-hidden rounded-lg bg-gray-200">
                  @if(isset($articles[0]->featured_image))
                    <img src="{{ directus_asset($articles[0]->featured_image) }}" 
                         alt="{{ $articles[0]->title }}" 
                         class="object-cover w-full h-full transition-all duration-300 group-hover:scale-105">
                  @elseif(isset($articles[0]->image))
                    <img src="{{ asset('storage/' . $articles[0]->image) }}" 
                         alt="{{ $articles[0]->title }}" 
                         class="object-cover w-full h-full transition-all duration-300 group-hover:scale-105">
                  @else
                    <div class="flex absolute inset-0 justify-center items-center bg-gradient-to-br from-hippie-blue-100 to-hippie-blue-200">
                      <span class="text-lg font-medium text-hippie-blue-600">{{ ucfirst($articles[0]->category->name) }}</span>
                    </div>
                  @endif
                  <div class="absolute inset-0 bg-gradient-to-t to-transparent from-black/70"></div>
                </div>
                <div class="absolute bottom-0 p-6 text-white">
                  <span class="px-3 py-1 text-xs font-semibold text-white rounded-full bg-hippie-blue-500">{{ ucfirst($articles[0]->category->name) }}</span>
                  <h2 class="mt-3 text-2xl font-bold leading-tight text-white transition-colors duration-200 group-hover:text-hippie-blue-200">{{ $articles[0]->title }}</h2>
                  <div class="flex items-center mt-3 text-sm">
                    <span>{{ \Carbon\Carbon::parse($articles[0]->date_created)->format('M d, Y')}}</span>
                  </div>
                </div>
              </a>
            </div>

            <!-- Secondary Featured Articles -->
            <div class="grid grid-cols-1 gap-4 lg:col-span-2">
              @foreach(collect($articles)->slice(1, 2) as $article)
                <a href="{{ $article->category->name }}/articles/{{ $article->id }}" class="group">
                  <div class="flex overflow-hidden h-full bg-white rounded-lg border border-gray-200 transition-all hover:shadow-md">
                    <div class="flex-shrink-0 w-1/3 bg-gray-100" style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important;">
                      @if(isset($article->featured_image))
                        <img src="{{ directus_asset($article->featured_image) }}" 
                             alt="{{ $article->title }}" 
                             class="object-cover w-full h-full" style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important;">
                      @elseif(isset($article->image))
                        <img src="{{ asset('storage/' . $article->image) }}" 
                             alt="{{ $article->title }}" 
                             class="object-cover w-full h-full" style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important;">
                      @else
                        <div class="flex justify-center items-center w-full h-full bg-gradient-to-br from-hippie-blue-50 to-hippie-blue-100" style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important;">
                          <span class="text-sm font-medium text-hippie-blue-600">{{ ucfirst($article->category->name) }}</span>
                        </div>
                      @endif
                    </div>
                    <div class="p-4 w-2/3">
                      <span class="text-xs font-semibold text-hippie-blue-500">{{ ucfirst($article->category->name) }}</span>
                      <h3 class="mt-1 font-semibold text-gray-900 line-clamp-2 group-hover:text-hippie-blue-700">{{ $article->title }}</h3>
                      <time class="mt-2 text-xs text-gray-500">{{ \Carbon\Carbon::parse($article->date_created)->format('M d, Y')}}</time>
                    </div>
                  </div>
                </a>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Category Highlights -->
  <div class="py-10 bg-white">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="flex justify-between items-baseline mb-6">
        @if(isset($current_category) && $current_category)
          <h2 class="text-2xl font-bold tracking-tight text-gray-900">Latest in {{ ucfirst($current_category) }}</h2>
          <a href="/{{ strtolower($current_category) }}" class="text-sm font-medium text-hippie-blue-600 hover:text-hippie-blue-800">View all</a>
        @else
          <h2 class="text-2xl font-bold tracking-tight text-gray-900">Today's highlights</h2>
          <a href="/news" class="text-sm font-medium text-hippie-blue-600 hover:text-hippie-blue-800">More news</a>
        @endif
      </div>
      
      <!-- Article Grid -->
      <x-article-grid :articles="collect($articles)->slice(3, 3)" />
    </div>
  </div>

  <!-- Trending Section -->
  <div class="py-10 bg-gray-50">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="flex justify-between items-baseline mb-6">
        @if(isset($current_category) && $current_category)
          <h2 class="text-2xl font-bold tracking-tight text-gray-900">Trending in {{ $current_category }}</h2>
        @else
          <h2 class="text-2xl font-bold tracking-tight text-gray-900">Trending Now</h2>
        @endif
      </div>
      
      <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
        @foreach(collect($articles)->slice(6, 4) as $article)
          <a href="{{ $article->category->name }}/articles/{{ $article->id }}" class="block group">
            <div class="overflow-hidden relative bg-gray-100 rounded-lg aspect-square">
              @if(isset($article->featured_image))
                <img src="{{ directus_asset($article->featured_image) }}"
                     alt="{{ $article->title }}"
                     class="object-cover w-full h-full">
              @elseif(isset($article->image))
                <img src="{{ asset('storage/' . $article->image) }}"
                     alt="{{ $article->title }}"
                     class="object-cover w-full h-full">
              @else
                <div class="flex absolute inset-0 justify-center items-center bg-gradient-to-br from-hippie-blue-50 to-hippie-blue-100">
                  <span class="text-lg font-medium text-hippie-blue-600">{{ ucfirst($article->category->name) }}</span>
                </div>
              @endif
              <div class="absolute inset-0 bg-gradient-to-t to-transparent opacity-0 transition-opacity from-black/70 via-black/20 group-hover:opacity-100"></div>
              <div class="absolute bottom-0 left-0 p-3 text-white">
                <span class="px-2 py-1 text-xs font-medium rounded-full backdrop-blur-sm bg-hippie-blue-500">{{ ucfirst($article->category->name) }}</span>
              </div>
            </div>
            <h3 class="mt-3 text-sm font-medium text-gray-900 group-hover:text-hippie-blue-700">{{ $article->title }}</h3>
          </a>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Category Quick Links -->
  <div class="py-10 bg-white">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <h2 class="mb-6 text-2xl font-bold tracking-tight text-gray-900">Discover</h2>
      
      <div class="grid grid-cols-2 gap-4 md:grid-cols-5">
        @php
          $categories = ['News','Finance', 'Aviation', 'History', 'Discovery'];
          $categoryImages = [
            'News' => asset('assets/images/categories/news.jpg'),
            'Finance' => asset('assets/images/categories/finance.jpg'),
            'Aviation' => asset('assets/images/categories/aviation.jpg'),
            'History' => asset('assets/images/categories/history.jpg'),
            'Discovery' => asset('assets/images/categories/discovery.jpg'),
          ];
        @endphp

        @foreach($categories as $category)
          <a href="/{{ strtolower($category) }}" class="relative group">
            <div class="aspect-[4/3] overflow-hidden rounded-lg bg-gray-100" style="border-radius: 0.5rem;">
              @if(file_exists(public_path('assets/images/categories/' . strtolower($category) . '.jpg')))
                <img src="{{ $categoryImages[$category] }}" 
                     alt="{{ $category }}" 
                     class="object-cover w-full h-full transition-all duration-300 group-hover:scale-105" style="border-radius: 0.5rem;">
              @else
                <div class="flex absolute inset-0 justify-center items-center bg-gradient-to-br from-hippie-blue-50 to-hippie-blue-100" style="border-radius: 0.5rem;">
                  <span class="text-xl font-bold text-hippie-blue-600">{{ $category }}</span>
                </div>
              @endif
              <div class="absolute inset-0 bg-gradient-to-t to-transparent from-black/80" style="border-radius: 0.5rem;"></div>
              <div class="flex absolute inset-0 justify-center items-center">
                <h3 class="text-xl font-bold text-white">{{ $category }}</h3>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Email Signup -->
  <!-- <div class="py-12 mt-6 bg-hippie-blue-50">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="p-8 rounded-xl bg-hippie-blue-100 md:p-10 lg:flex lg:items-center lg:justify-between">
        <div class="lg:w-2/3">
          <h2 class="text-2xl font-bold tracking-tight text-gray-900">Stay updated with our newsletter</h2>
          <p class="mt-2 text-gray-600">Get the latest news, discovery insights, finance updates, aviation breakthroughs, and historical perspectives delivered directly to your inbox.</p>
        </div>
        <div class="mt-6 lg:mt-0 lg:w-1/3">
          <form class="flex">
            <input type="email" placeholder="Enter your email" class="px-3.5 py-2.5 w-full text-gray-900 rounded-l-lg border-0 ring-1 ring-inset ring-gray-300 shadow-sm focus:ring-2 focus:ring-inset focus:ring-hippie-blue-600">
            <button type="submit" class="px-4 py-2.5 text-sm font-semibold text-white rounded-r-lg shadow-sm bg-hippie-blue-600 hover:bg-hippie-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-hippie-blue-500">Subscribe</button>
          </form>
        </div>
      </div>
    </div>
  </div> -->

  <x-footer/>

</x-magellan-layout>