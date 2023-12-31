@php use App\Models\Post; @endphp
@include('components.header')
<div class="flex items-center flex-col justify-center">
    <h1 class="text-xl pt-5 dark:text-white">{{ucfirst($categoryName)}}
        ({{Post::getCountByCategory($categoryID)}})</h1>
    <a class="mt-4 text-gray-500 dark:text-gray-400 text-md leading-relaxed hover:underline decoration-1"
       href="{{url()->previous()}}">Back</a>
</div>
<div class="mt-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
        @foreach ($categories as $category)
            <div
                class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div>
                    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{ ucfirst($category->title) }}</h2>

                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-md leading-relaxed">
                        {{ $category->content }}
                    </p>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Created at {{ $category->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
@endforeach
@include('components.footer')
