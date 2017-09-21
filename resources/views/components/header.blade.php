<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            @isset($title)
            <h4>
                @isset($title['icon'])
                <i class="{{ $title['icon'] }} position-left"></i>
                @endisset
                <span class="text-semibold">{{ $title['title'] }}</span>
                @isset($title['subTitle'])
                -
                {{ $title['subTitle'] }}
                @endisset
            </h4>
            @endisset
        </div>

        {{--@isset($headerItems)--}}
        <div class="heading-elements">
            <div class="heading-btn-group">
                @foreach($headerItems ?? [] as $item)
                    <a href="#" class="btn btn-link btn-float has-text">
                        @isset($item['icon'])
                        <i class="text-primary {{ $item['icon'] }}"></i>
                        @endisset
                        <span>{{ $item['title'] }}</span>
                    </a>
                @endforeach
                @stack('headingElements')
            </div>
        </div>
        {{--@endisset--}}
    </div>

    @isset($breadcrumbs)
    <div class="breadcrumb-line">

        <ul class="breadcrumb">
            @foreach($breadcrumbs['items'] ?? [] as $item)
                <li class="{{ $item['class'] ?? '' }}">
                    <a href="{{ $item['url'] ?? '#' }}">
                        <i class="{{ $item['icon'] }} position-left"></i>
                        {{ $item['title'] }}
                    </a>
                </li>
                @stack('breadcrumbItems')
            @endforeach
        </ul>

        <ul class="breadcrumb-elements">
            @foreach($breadcrumbs['action'] as $item)
            @endforeach
            {{--<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>--}}
            {{--<li class="dropdown">--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
            {{--<i class="icon-gear position-left"></i>--}}
            {{--Settings--}}
            {{--<span class="caret"></span>--}}
            {{--</a>--}}

            {{--<ul class="dropdown-menu dropdown-menu-right">--}}
            {{--<li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>--}}
            {{--<li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>--}}
            {{--<li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li><a href="#"><i class="icon-gear"></i> All settings</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
        </ul>
    </div>
    @endisset

</div>
