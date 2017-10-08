<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        @auth
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left">
                        <img src="/assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">{{ \Auth::user()->name ?? "Guest" }}</span>
                        @if(\Auth::user()->companyName())
                            <div class="text-size-mini text-muted">
                                <i class="icon-office text-size-small"></i> &nbsp;{{ \Auth::user()->companyName() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endauth
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <li class="navigation-header">
                        <span>Menu</span>
                        <i class="icon-menu" title="Menu"></i>
                    </li>
                    <li class="{{ menuItemActive(['route' => 'dashboard']) ? 'active' : null }}">
                        <a href="{{ route('dashboard') }}">
                            <i class="icon-home4"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @include('components.sidebar.items',['items' => config('trudo.menu.items',[])])
                </ul>
            </div>
        </div>

    </div>
</div>
