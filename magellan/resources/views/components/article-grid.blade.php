<!-- Article Grid Component -->
@php
  // Dynamically adjust grid columns based on the number of articles
  $columnClass = count($articles) >= 3 ? "grid-cols-1 md:grid-cols-2 lg:grid-cols-3" :
                (count($articles) == 2 ? "grid-cols-1 md:grid-cols-2" : "grid-cols-1");
@endphp

<div class="grid gap-6 {{ $columnClass }}">
  @foreach($articles as $article)
    <a href="/{{ strtolower($article->category->name) }}/articles/{{ $article->id }}" class="block group">
      <div class="overflow-hidden relative rounded-lg border border-gray-100 transition-all hover:shadow-md">
        <div class="aspect-[16/9] overflow-hidden bg-gray-100" style="border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important;">
          @if(isset($article->featured_image))
            <img src="{{ directus_asset($article->featured_image) }}"
                 alt="{{ $article->title }}"
                 class="object-cover w-full h-full transition-all duration-300 group-hover:scale-105" style="border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important;">
          @elseif(isset($article->image))
            <img src="{{ asset('storage/' . $article->image) }}"
                 alt="{{ $article->title }}"
                 class="object-cover w-full h-full transition-all duration-300 group-hover:scale-105" style="border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important;">
          @else
            <div class="flex absolute inset-0 justify-center items-center bg-gradient-to-br from-hippie-blue-50 to-hippie-blue-100" style="border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important;">
              <span class="text-lg font-medium text-hippie-blue-600">{{ ucfirst($article->category->name) }}</span>
            </div>
          @endif
        </div>
        <div class="p-4">
          <div class="flex justify-between items-center">
            <span class="text-xs font-semibold text-hippie-blue-500">{{ ucfirst($article->category->name) }}</span>
            <time class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($article->date_created)->format('M d, Y')}}</time>
          </div>
          <h3 class="mt-2 text-lg font-semibold text-gray-900 transition-colors group-hover:text-hippie-blue-700">{{ $article->title }}</h3>
          @php
            $excerpt = get_excerpt($article->content, 1, 0);
          @endphp
          <p class="mt-2 text-sm text-gray-600 line-clamp-2">{!! $excerpt !!}</p>
        </div>
      </div>
    </a>
  @endforeach
</div> 