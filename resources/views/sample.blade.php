@extends('layouts.base')
@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-4 min-h-[700px]">

            {{-- FEATURED STORY  --}}
            <div class="col-span-1 md:col-span-9">
                <div class="grid grid-cols-1 md:grid-rows-2 h-full gap-4">

                    <div class="bg-white overflow-hidden h-64 md:h-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 h-full">

                            <div class="flex flex-col justify-center p-6 md:p-8 order-2 md:order-1">
                                <h1 class="text-xl md:text-3xl lg:text-4xl font-bold mb-4 leading-tight text-gray-800">
                                    <a href="#" class="hover:underline">Global Climate Summit Reaches Historic Agreement</a>
                                </h1>
                                <p class="text-sm md:text-base lg:text-lg text-gray-600 leading-relaxed line-clamp-3">
                                    World leaders unite on unprecedented climate action plan that could reshape global energy policy for decades to come.
                                </p>
                            </div>

                            <div class="relative overflow-hidden order-1 md:order-2">
                                <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=1472&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                     class="w-100 h-64 object-cover"
                                     alt="Breaking News">
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Row -->
                    <div class="hidden md:grid md:grid-cols-4 gap-4">
                        <div class="bg-white overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8d2VifGVufDB8fDB8fHww"
                                 class="w-full h-32 object-cover"
                                 alt="Development">
                            <div class="p-6">
                                <h5 class="text-lg font-bold mb-3 text-gray-800">
                                    <a href="#" class="hover:underline">Regional Development Plan Unveiled</a>
                                </h5>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                    Ambitious infrastructure project promises to transform northern regions with billions in investment.
                                </p>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8d2VifGVufDB8fDB8fHww"
                                 class="w-full h-32 object-cover"
                                 alt="Medical">
                            <div class="p-6">
                                <h5 class="text-lg font-bold mb-3 text-gray-800">
                                    <a href="#" class="hover:underline">Scientific Breakthrough in Medicine</a>
                                </h5>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                    Researchers announce major advancement in cancer treatment that could benefit millions worldwide.
                                </p>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden">
                            <img src="https://plus.unsplash.com/premium_vector-1721296175362-c52a73ff127b?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8d2VifGVufDB8fDB8fHww"
                                 class="w-full h-32 object-cover"
                                 alt="Trade">
                            <div class="p-6">
                                <h5 class="text-lg font-bold mb-3 text-gray-800">
                                    <a href="#" class="hover:underline">International Trade Relations Improve</a>
                                </h5>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                    New agreements signal thawing of tensions between major economic powers.
                                </p>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden">
                            <img src="https://plus.unsplash.com/premium_vector-1682303058649-52fb42b3c7cf?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fHdlYnxlbnwwfHwwfHx8MA%3D%3D"
                                 class="w-full h-32 object-cover"
                                 alt="Technology">
                            <div class="p-6">
                                <h5 class="text-lg font-bold mb-3 text-gray-800">
                                    <a href="#" class="hover:underline">Technology Innovation Accelerates</a>
                                </h5>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                    New tech developments reshape industries and create opportunities.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-span-1 md:col-span-3">
                <div class="flex flex-col h-full gap-4">

                    <div class="bg-white overflow-hidden flex-1">
                        <img src="https://plus.unsplash.com/premium_photo-1661963212517-830bbb7d76fc?q=80&w=1386&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                             class="w-full h-32 object-cover"
                             alt="Politics">
                        <div class="p-5">
                            <h5 class="text-lg font-bold mb-3 text-gray-800">
                                <a href="#" class="hover:underline">Election Results Shock Political Establishment</a>
                            </h5>
                            <p class="text-sm text-gray-600 leading-relaxed line-clamp-4">
                                Unexpected outcomes in key constituencies signal major shift in voter sentiment.
                            </p>
                        </div>
                    </div>


                    <div class="bg-white overflow-hidden">
                        <div class="p-5">
                            <h5 class="text-lg font-bold mb-3 text-gray-800">
                                <a href="#" class="hover:underline">Market Rally Continues Despite Global Uncertainty</a>
                            </h5>
                            <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                Investors remain optimistic as tech stocks surge to new highs.
                            </p>
                        </div>
                    </div>


                    <div class="bg-white overflow-hidden">
                        <div class="p-5">
                            <h5 class="text-lg font-bold mb-3 text-gray-800">
                                <a href="#" class="hover:underline">Market Rally Continues Despite Global Uncertainty</a>
                            </h5>
                            <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                Investors remain optimistic as tech stocks surge to new highs.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
                {{-- FEATURED STORY  --}}
                <div class="col-span-1 md:col-span-9">
                    <div class="grid grid-cols-1 md:grid-rows-2 h-full gap-4">

                        <div class="bg-white overflow-hidden h-64 md:h-auto">
                            <div class="grid grid-cols-1 md:grid-cols-2 h-full">

                                <div class="flex flex-col justify-center p-6 md:p-8 order-2 md:order-1">
                                    <h1 class="text-xl md:text-3xl lg:text-4xl font-bold mb-4 leading-tight text-gray-800">
                                        <a href="#" class="hover:underline">Global Climate Summit Reaches Historic Agreement</a>
                                    </h1>
                                    <p class="text-sm md:text-base lg:text-lg text-gray-600 leading-relaxed line-clamp-3">
                                        World leaders unite on unprecedented climate action plan that could reshape global energy policy for decades to come.
                                    </p>
                                </div>

                                <div class="relative overflow-hidden order-1 md:order-2">
                                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=1472&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        class="w-100 h-64 object-cover"
                                        alt="Breaking News">
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Row -->
                        <div class="hidden md:grid md:grid-cols-4 gap-4">
                            <div class="bg-white overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8d2VifGVufDB8fDB8fHww"
                                    class="w-full h-32 object-cover"
                                    alt="Development">
                                <div class="p-6">
                                    <h5 class="text-lg font-bold mb-3 text-gray-800">
                                        <a href="#" class="hover:underline">Regional Development Plan Unveiled</a>
                                    </h5>
                                    <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                        Ambitious infrastructure project promises to transform northern regions with billions in investment.
                                    </p>
                                </div>
                            </div>
                            <div class="bg-white overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8d2VifGVufDB8fDB8fHww"
                                    class="w-full h-32 object-cover"
                                    alt="Medical">
                                <div class="p-6">
                                    <h5 class="text-lg font-bold mb-3 text-gray-800">
                                        <a href="#" class="hover:underline">Scientific Breakthrough in Medicine</a>
                                    </h5>
                                    <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                        Researchers announce major advancement in cancer treatment that could benefit millions worldwide.
                                    </p>
                                </div>
                            </div>
                            <div class="bg-white overflow-hidden">
                                <img src="https://plus.unsplash.com/premium_vector-1721296175362-c52a73ff127b?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8d2VifGVufDB8fDB8fHww"
                                    class="w-full h-32 object-cover"
                                    alt="Trade">
                                <div class="p-6">
                                    <h5 class="text-lg font-bold mb-3 text-gray-800">
                                        <a href="#" class="hover:underline">International Trade Relations Improve</a>
                                    </h5>
                                    <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                        New agreements signal thawing of tensions between major economic powers.
                                    </p>
                                </div>
                            </div>
                            <div class="bg-white overflow-hidden">
                                <img src="https://plus.unsplash.com/premium_vector-1682303058649-52fb42b3c7cf?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fHdlYnxlbnwwfHwwfHx8MA%3D%3D"
                                    class="w-full h-32 object-cover"
                                    alt="Technology">
                                <div class="p-6">
                                    <h5 class="text-lg font-bold mb-3 text-gray-800">
                                        <a href="#" class="hover:underline">Technology Innovation Accelerates</a>
                                    </h5>
                                    <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                        New tech developments reshape industries and create opportunities.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN -->
                <div class="col-span-1 md:col-span-3">
                    <div class="flex flex-col h-full gap-4">

                        <div class="bg-white overflow-hidden flex-1">
                            <img src="https://plus.unsplash.com/premium_photo-1661963212517-830bbb7d76fc?q=80&w=1386&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="w-full h-32 object-cover"
                                alt="Politics">
                            <div class="p-5">
                                <h5 class="text-lg font-bold mb-3 text-gray-800">
                                    <a href="#" class="hover:underline">Election Results Shock Political Establishment</a>
                                </h5>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-4">
                                    Unexpected outcomes in key constituencies signal major shift in voter sentiment.
                                </p>
                            </div>
                        </div>


                        <div class="bg-white overflow-hidden">
                            <div class="p-5">
                                <h5 class="text-lg font-bold mb-3 text-gray-800">
                                    <a href="#" class="hover:underline">Market Rally Continues Despite Global Uncertainty</a>
                                </h5>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                    Investors remain optimistic as tech stocks surge to new highs.
                                </p>
                            </div>
                        </div>


                        <div class="bg-white overflow-hidden">
                            <div class="p-5">
                                <h5 class="text-lg font-bold mb-3 text-gray-800">
                                    <a href="#" class="hover:underline">Market Rally Continues Despite Global Uncertainty</a>
                                </h5>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                    Investors remain optimistic as tech stocks surge to new highs.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
