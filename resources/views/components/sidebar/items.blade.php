@foreach($items as $item)

    @php $active = menuItemActive($item) @endphp
    @if(isset($item['items']))
        <li class="{{ $active ? 'active' : null }}">
            <a href="#" class="has-ul">
                <span>{!! $item['title'] !!}</span>
            </a>
            <ul class="{{ $active ? null : 'hidden-ul' }}">
                @include('components.sidebar.items',['items' => $item['items']])
            </ul>
        </li>
    @else
        <li class="{{ $active ? 'active' : null }}">
            <a href="@if(isset($item['route'])) {{ route($item['route']) }} @elseif(isset($item['href'])) {{ $item['href'] }} @endif ">
                @if(isset($item['icon']))
                    <i class="{{ $item['icon'] }}"></i>
                @endif
                {!! $item['title'] !!}
            </a>
        </li>
    @endif

@endforeach
