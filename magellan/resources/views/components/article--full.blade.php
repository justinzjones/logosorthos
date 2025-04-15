<div class="px-6 py-16 lg:px-8">
  <div class="mx-auto max-w-2xl text-base leading-7 text-gray-700">
    <!-- <p class="text-base font-semibold leading-7 text-hippie-blue-500">{{ ucfirst($article->category->name) }}</p> -->
    <p class="text-sm font-semibold leading-7 text-hippie-blue-500">{{ ucfirst($article->category->name) }}</p>
    <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $article->title }}</h1>
    
    @if(isset($article->featured_image))
    <figure class="mt-6">
      <img src="http://localhost:8055/assets/{{ $article->featured_image }}" alt="{{ $article->title }}" class="rounded-lg w-full max-h-[500px] object-cover">
    </figure>
    @endif
    
    <!-- <p class="mt-6 text-xl leading-8">Aliquet nec orci mattis amet quisque ullamcorper neque, nibh sem. At arcu, sit dui mi, nibh dui, diam eget aliquam. Quisque id at vitae feugiat egestas ac. Diam nulla orci at in viverra scelerisque eget. Eleifend egestas fringilla sapien.</p> -->
    <div class="flex pt-3 mt-3 border-t border-gray-900/5">
              <div class="flex relative gap-x-4 items-center">



                @if (!empty($article->author->avatar))
                <img src="{{ directus_asset($article->author->avatar) }}" alt="" class="w-10 h-10 bg-gray-50 rounded-full">
                @endif

                <div class="text-sm leading-6">
                  <!-- <p class="font-semibold text-gray-900">
                    <a href="#">
                      <span class="absolute inset-0"></span>
                      {{ $article->author->first_name ?? '' }} {{ $article->author->last_name ?? '' }}
                    </a>
                  </p> -->
                  <!-- <p class="text-gray-600">Co-Founder / CTO</p> -->
                  <time datetime="2020-03-16" class="text-gray-500">{{ \Carbon\Carbon::parse($article->date_created)->format('M d, Y')}}</time>
                </div>
              </div>
            </div>
    
    
    <div class="mt-8 max-w-2xl">
      {!! insert_ads_in_content($article->content) !!}
    </div>

    
    <!-- <figure class="mt-16">
      <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&auto=format&fit=facearea&w=1310&h=873&q=80&facepad=3" alt="">
      <figcaption>
        <svg class="flex-none mt-0.5 w-5 h-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
        </svg>
        Faucibus commodo massa rhoncus, volutpat.
      </figcaption>
    </figure>
    <div class="mt-16 max-w-2xl">
      <h2>Everything you need to get up and running</h2>
      <p class="mt-6">Purus morbi dignissim senectus mattis adipiscing. Amet, massa quam varius orci dapibus volutpat cras. In amet eu ridiculus leo sodales cursus tristique. Tincidunt sed tempus ut viverra ridiculus non molestie. Gravida quis fringilla amet eget dui tempor dignissim. Facilisis auctor venenatis varius nunc, congue erat ac. Cras fermentum convallis quam.</p>
      <p class="mt-8">Faucibus commodo massa rhoncus, volutpat. Dignissim sed eget risus enim. Mattis mauris semper sed amet vitae sed turpis id. Id dolor praesent donec est. Odio penatibus risus viverra tellus varius sit neque erat velit.</p>
    </div> -->
  </div>
</div>

<!-- Related Articles Section -->
@if(count($related_articles) > 0)
<div class="py-10 bg-gray-50">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="mb-6">
      <h2 class="text-2xl font-bold tracking-tight text-gray-900">Related Articles</h2>
    </div>
    
    <!-- Use the article-grid component -->
    <x-article-grid :articles="$related_articles" />
  </div>
</div>
@endif

