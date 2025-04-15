
<div>
    <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
    <article class="flex flex-col justify-between items-start">
        <div class="relative w-full">
          <img src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3603&q=80" alt="" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
          <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
        </div>
        <div class="max-w-xl">
          <div x-data="{ bgColor: '{{$article->category->color}}' }" class="flex gap-x-4 items-center mt-8 text-xs">
          
          <!-- @php $bg_category = "bg-".$article->category->color @endphp -->
          
          <p class="text-sm font-semibold leading-7 text-hippie-blue-500">
                {{ ucfirst($article->category->name) }}
              </p>
          </div>
          <div class="relative group">
          <h3 class="mt-3 text-xl font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                             
          <a href="{{ $article->category->name }}/articles/{{ $article->id }}">
          
          

                                <span class="absolute inset-0"></span>
                                {{ $article->title }}
                              </a>
                            </h3>
            @php
                                $excerpt = get_excerpt($article->content, 2, 3); 
                            @endphp
                            <p class="mt-5 text-base leading-6 text-gray-600"> {!!$excerpt!!} </p>
          </div>
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

        </div>
      </article>

</div>