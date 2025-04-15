




<div class="py-16 bg-white sm:py-16">
  <div class="px-6 mx-auto max-w-7xl lg:px-8">
    <!-- <div class="max-w-2xl mx-auto text-center"> -->
      <!-- <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">From the blog</h2> -->
      <!-- <p class="mt-2 text-lg leading-8 text-gray-600">Learn how to grow your business with our expert advice.</p> -->
    <!-- </div> -->
    <div class="grid max-w-2xl grid-cols-1 gap-8 mx-auto mt-0 auto-rows-fr sm:mt-0 lg:mx-0 lg:max-w-none lg:grid-cols-3">

      
    @foreach (collect($articles)->take(3) as $article)
      <x-article--short2 :article="$article" />
    @endforeach

    </div>
  </div>
</div>















