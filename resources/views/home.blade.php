@include('components.header')
@if($posts->isEmpty())
    <div class="flex items-center justify-center flex-col">
        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
            No post available.
        </p>
        <a class="mt-4 text-gray-500 dark:text-gray-400 text-md leading-relaxed hover:underline decoration-1"
           href="{{url('/')}}">Go Back</a>
    </div>
@else
    @if(session()->has('success'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Done!</p>
                    <p class="text-sm"> {{ session()->get('success') }}</p>
                </div>
            </div>
        </div>
    @endif
    <p class="mt-4 text-gray-500 dark:text-gray-400 text-lg leading-relaxed">
        @if( request()->has('archive') )
            <a class="mt-4 text-gray-500 dark:text-gray-400 text-md leading-relaxed hover:underline decoration-1"
               href="{{url('/')}}">Go Back</a>
        @else
            <a href="{{url('/?archive')}}" class="flex hover:underline decoration-1">Archive List
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                </svg>
            </a>
        @endif
    </p>
    <div class="mt-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            @foreach ($posts as $post)

                <div
                    class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-md leading-relaxed">
                            Category: <a class="text-red-700 hover:text-red-400 hover:underline decoration-1"
                                         href="{{route('category.getPosts', $post->category->id)}}">{{ ucfirst($post->category->name) }}</a>
                        </p>
                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{ ucfirst($post->title) }}</h2>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-md leading-relaxed">
                            {{ $post->content }}
                        </p>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            Created at {{ $post->created_at->diffForHumans() }}
                        </p>
                        @if($post->trashed())
                            <div class="flex align-center gap-5">
                                <form action="{{route('posts.restore',$post->id)}}" method="post">
                                    @csrf
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-8 mt-4 rounded-full">
                                        Restore
                                    </button>
                                </form>
                                <form action="{{route('posts.force_delete', $post->id)}}" method="post">
                                    @csrf
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-8 mt-4 rounded-full"
                                            onclick="return confirm('Are you sure?')">Delete Permanently
                                    </button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('posts.delete', $post->id) }}" method="post">
                                @csrf
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-8 mt-4 rounded-full"
                                        onclick="return confirm('Are you sure?')">Delete
                                </button>
                            </form>
                        @endif

                    </div>

                </div>
    @endforeach
@endif
@include('components.footer')
