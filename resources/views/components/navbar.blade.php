<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ url('/') }}">Truck Log</a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>

            @if(isset($sidebar))
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            @endif
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            {{--@if(isset($sidebar))--}}

                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>
                    {{--@endif--}}
                </li>
                @if(isset($notifications))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-git-compare"></i>
                            <span class="visible-xs-inline-block position-right">Notifications</span>
                            <span class="badge bg-warning-400">{{ $notifications['total'] ?? 0 }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-content">
                            <div class="dropdown-content-heading">
                                Git updates
                                <ul class="icons-list">
                                    {{--<li><a href="#"><i class="icon-sync"></i></a></li>--}}
                                </ul>
                            </div>

                            <ul class="media-list dropdown-content-body width-350">
                                @foreach($notifications['items'] ?? [] as $item)
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="@if(isset($item['route'])) {{ route($item['route']) }} @elseif(isset($item['href'])) {{ $item['href'] }}@endif"
                                               class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm">

                                                <i class="{{ $item['icon'] }}"></i>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            {!! $item['text'] !!}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            {{--<div class="dropdown-content-footer">--}}
                            {{--<a href="#" data-popup="tooltip" title="All activity"><i--}}
                            {{--class="icon-menu display-block"></i></a>--}}
                            {{--</div>--}}
                        </div>
                    </li>
                @endif
        </ul>

        {{--<p class="navbar-text"><span class="label bg-success">Online</span></p>--}}

        <ul class="nav navbar-nav navbar-right">
            @if(isset($languages))
                <li class="dropdown language-switch">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/assets/images/flags/gb.png" class="position-left" alt="">
                        English
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        @foreach($languages as $item)
                            <li><a class="deutsch">
                                    <img src="assets/images/flags/{{ $item['code'] }}.png" alt="">{{ $item['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
            @if(isset($messages))
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-bubbles4"></i>
                        <span class="visible-xs-inline-block position-right">Messages</span>
                        <span class="badge bg-warning-400">2</span>
                    </a>

                    <div class="dropdown-menu dropdown-content width-350">
                        <div class="dropdown-content-heading">
                            Messages
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-compose"></i></a></li>
                            </ul>
                        </div>

                        <ul class="media-list dropdown-content-body">
                            <li class="media">
                                <div class="media-left">
                                    <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                    <span class="badge bg-danger-400 media-badge">5</span>
                                </div>

                                <div class="media-body">
                                    <a href="#" class="media-heading">
                                        <span class="text-semibold">James Alexander</span>
                                        <span class="media-annotation pull-right">04:58</span>
                                    </a>

                                    <span class="text-muted">who knows, maybe that would be the best thing for me...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="media-left">
                                    <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                    <span class="badge bg-danger-400 media-badge">4</span>
                                </div>

                                <div class="media-body">
                                    <a href="#" class="media-heading">
                                        <span class="text-semibold">Margo Baker</span>
                                        <span class="media-annotation pull-right">12:16</span>
                                    </a>

                                    <span class="text-muted">That was something he was unable to do because...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="media-left"><img src="assets/images/placeholder.jpg"
                                                             class="img-circle img-sm"
                                                             alt=""></div>
                                <div class="media-body">
                                    <a href="#" class="media-heading">
                                        <span class="text-semibold">Jeremy Victorino</span>
                                        <span class="media-annotation pull-right">22:48</span>
                                    </a>

                                    <span class="text-muted">But that would be extremely strained and suspicious...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="media-left"><img src="assets/images/placeholder.jpg"
                                                             class="img-circle img-sm"
                                                             alt=""></div>
                                <div class="media-body">
                                    <a href="#" class="media-heading">
                                        <span class="text-semibold">Beatrix Diaz</span>
                                        <span class="media-annotation pull-right">Tue</span>
                                    </a>

                                    <span class="text-muted">What a strenuous career it is that I've chosen...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="media-left"><img src="assets/images/placeholder.jpg"
                                                             class="img-circle img-sm"
                                                             alt=""></div>
                                <div class="media-body">
                                    <a href="#" class="media-heading">
                                        <span class="text-semibold">Richard Vango</span>
                                        <span class="media-annotation pull-right">Mon</span>
                                    </a>

                                    <span class="text-muted">Other travelling salesmen live a life of luxury...</span>
                                </div>
                            </li>
                        </ul>

                        <div class="dropdown-content-footer">
                            <a href="#" data-popup="tooltip" title="All messages"><i
                                        class="icon-menu display-block"></i></a>
                        </div>
                    </div>
                </li>
            @endif

            @auth
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="/assets/images/placeholder.jpg" alt="">
                    <span>{{ \Auth::user()->name }}</span>
                    <i class="caret"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    {{--<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>--}}
                    {{--<li><a href="#"><i class="icon-coins"></i> My balance</a></li>--}}
                    {{--<li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i--}}
                    {{--class="icon-comment-discussion"></i> Messages</a></li>--}}
                    {{--<li class="divider"></li>--}}
                    {{--<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>--}}
                    <li><a href="{{ route('logout-get') }}"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
            @endauth
        </ul>
    </div>
</div>
