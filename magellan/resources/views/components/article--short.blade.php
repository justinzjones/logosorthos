<div class="py-8 bg-white sm:py-10">


  <!-- change px-6 to px-0 , lg:px-8 topx-0 -->
  <div class="px-0 mx-auto max-w-7xl lg:px-0">
    <div class="mx-auto max-w-2xl lg:max-w-4xl">
      <!-- <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">From the blog</h2>
                      <p class="mt-2 text-lg leading-8 text-gray-600">Learn how to grow your business with our expert advice.</p> -->
      <div class="mt-0 space-y-20 lg:mt-0 lg:space-y-20">
        <article class="flex isolate relative flex-col gap-8 lg:flex-row">
          <div class="relative aspect-[16/9] sm:aspect-[2/1] lg:aspect-square lg:w-64 lg:shrink-0">
            <img src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3603&q=80" alt="" class="object-cover absolute inset-0 w-full h-full bg-gray-50 rounded-2xl">
            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
          </div>
          <div>
            <div x-data="{ bgColor: '{{$article->category->color}}' }" class="flex gap-x-4 items-center text-xs">
              <!-- <time datetime="2020-03-16" class="text-gray-500">Mar 16, 2020</time> -->
              <!-- <time datetime="2020-03-16" class="text-gray-500">{{ \Carbon\Carbon::parse($article->date_created)->format('M d, Y')}}</time> -->


      

              <!-- <a href="#"
                 :class="`bg-${bgColor}`"
                class="relative z-10 px-3 py-1.5 font-medium text-gray-600 rounded-full">
                {{ ucfirst($article->category->name) }}
              </a> -->
              <p class="text-sm font-semibold leading-7 text-hippie-blue-500">
                {{ ucfirst($article->category->name) }}
              </p>
              <!-- <p class="text-base font-semibold leading-7 text-hippie-blue-500">{{ ucfirst($article->category->name) }}</p> -->
            </div>
            <div class="relative max-w-xl group">
              <h3 class="mt-3 text-xl font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                <a href="{{ $article->category->name }}/articles/{{ $article->id }}">
                  <span class="absolute inset-0"></span>
                  {{ $article->title }}
                </a>
              </h3>
              <!-- Get the first 2 sentences for excerpt -->
              @php
              $excerpt = get_excerpt($article->content, 3, 3);
              @endphp
              <p class="mt-5 text-base leading-6 text-gray-600"> {!!$excerpt!!} </p>
            </div>
            <div class="flex pt-6 mt-6 border-t border-gray-900/5">
              <div class="flex relative gap-x-4 items-center">



                <!-- @if (!empty($article->author->avatar))
                <img src="{{ directus_asset($article->author->avatar) }}" alt="" class="w-10 h-10 bg-gray-50 rounded-full">
                @endif -->

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
          </div>
        </article>

        <!-- More posts... -->
      </div>
    </div>
  </div>
</div>