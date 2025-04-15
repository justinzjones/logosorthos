<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    <div>
        <div>
            <!-- <div class="isolate relative pt-16">
                <div class="overflow-hidden absolute inset-0 -z-10" aria-hidden="true">
                    <div class="absolute left-16 top-full -mt-16 opacity-50 blur-3xl transform-gpu xl:left-1/2 xl:-ml-80">
                        <div class="aspect-[1154/678] w-[72.125rem] bg-gradient-to-br from-[#FF80B5] to-[#9089FC]" style="clip-path: polygon(100% 38.5%, 82.6% 100%, 60.2% 37.7%, 52.4% 32.1%, 47.5% 41.8%, 45.2% 65.6%, 27.5% 23.4%, 0.1% 35.3%, 17.9% 0%, 27.7% 23.4%, 76.2% 2.5%, 74.2% 56%, 100% 38.5%)"></div>
                    </div>
                    <div class="absolute inset-x-0 bottom-0 h-px bg-gray-900/5"></div>
                </div>


            </div> -->

            <div class="px-4 mx-auto mt-8 max-w-3xl sm:px-6 lg:max-w-7xl lg:px-8">
                <h1 class="sr-only">Page title</h1>
                <!-- Main 3 column grid -->
                <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-3 lg:gap-8">
                    <!-- Left column -->
                    <div class="grid grid-cols-1 gap-4 lg:col-span-2">
                        <section aria-labelledby="section-1-title">
                            <h2 class="sr-only" id="section-1-title">Section title</h2>
                            <div class="overflow-hidden bg-white rounded-lg">
                                <div class="p-0">
                                    <!-- changing the above p-6 to zero -->
                                    <!-- Your content -->

                                    @foreach ($articles as $article)
                                    <x-article--short :article="$article" />
                                    @endforeach

                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Right column -->
                    <div class="grid grid-cols-1 gap-4 py-8 sm:py-10">
    <section aria-labelledby="section-2-title">
        <h2 class="sr-only" id="section-2-title">Section title</h2>
        <div class="overflow-hidden bg-white rounded-lg">
            <div class="p-0">
                <!-- Existing ad image -->
                <!-- <img class="float-right w-auto h-auto" src="{{ asset('assets/images/ad.jpeg') }}" alt="Ad Image"> -->

                <!-- New image below the ad.jpeg -->
                <!-- <img class="mt-12 float-right w-auto h-[169px]" src="{{ asset('assets/images/ad2.webp') }}" alt="Rectangular Image"> -->
                <img class="float-right w-auto h-auto" src="https://www.soglos.com/images/advert/eastnorcastle-11jul2022-superskyscraper.gif" alt="Ad Image">
                
            </div>
            <div class="p-0">
                <!-- Existing ad image -->
                <!-- <img class="float-right w-auto h-auto" src="{{ asset('assets/images/ad.jpeg') }}" alt="Ad Image"> -->

                <!-- New image below the ad.jpeg -->
                <!-- <img class="mt-12 float-right w-auto h-[169px]" src="{{ asset('assets/images/ad2.webp') }}" alt="Rectangular Image"> -->
                <img class="float-right mt-8 w-auto h-auto" src="https://www.soglos.com/images/display-adverts/newsletters/cheltenhamracecourse-20feb-mpu.gif" alt="Ad Image">
            </div>
        </div>
    </section>
</div>

                    </section>

                </div>
            </div>
        </div>

    </div>
</div>



</div>