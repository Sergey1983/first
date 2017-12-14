

@if (count($breadcrumbs))

{{--     <nav class="navbar navbar-default background-transparent border-color-transparent no-border no-margin-bottom">
 --}}        
        <ul class="nav navbar-nav">
            
                    @foreach ($breadcrumbs as $breadcrumb)

                    @if ($breadcrumb->url && !$loop->last)
                        <li>

                            <a class="color-white" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>

                        </li>
                    @else
                        <li>

                            <a class="active-breadcrumb color-black" href="#">
                                {{ $breadcrumb->title }}
                            </a>

                        </li>
                    @endif

                @endforeach
        </ul>

{{--     </nav>
 --}}
@endif