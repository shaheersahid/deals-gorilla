@props(['crumbs' => []])

<nav class="flex py-3 text-gray-700 bg-transparent rounded-lg" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-violet-600 transition-colors">
                <i class="fa-solid fa-house me-2 text-xs"></i>
                Home
            </a>
        </li>
        @foreach ($crumbs as $crumb)
        <li>
            <div class="flex items-center">
                <i class="fa-solid fa-chevron-right text-gray-400 mx-1 text-[10px]"></i>
                @if (isset($crumb['url']) && !$loop->last)
                    <a href="{{ $crumb['url'] }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-violet-600 transition-colors md:ms-2">{{ $crumb['label'] }}</a>
                @else
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">{{ $crumb['label'] }}</span>
                @endif
            </div>
        </li>
        @endforeach
    </ol>
</nav>
