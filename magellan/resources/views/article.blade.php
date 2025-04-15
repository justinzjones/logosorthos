<x-magellan-layout>

  <x-header :category="$category" />


  
  <x-article--full :article="$article" :related_articles="$related_articles"/>

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

  <x-footer/>
  
</x-magellan-layout>
