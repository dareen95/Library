<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <a class="navbar-brand text-white">@lang('site.library')</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('allBooks') }}">@lang('site.books')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('allAuthors') }}">@lang('site.auths')</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
            </li> --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('categories.index') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @lang('site.cats')
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if(count($categories))
                        @foreach ($categories as $category)
                            <a class="dropdown-item" href="{{ route('categories.show', $category->id) }}">{{$category->name}}</a>
                        @endforeach
                    @else
                        <p style="padding: 5px">There's no categories in our database
                            @auth
                                @if(Auth::user()->role == 'admin')
                                    , <a href="{{ route('categories.create') }}">Create new</a>
                                @endif
                            @endauth
                        </p>
                    @endif
                </div>
            </li>
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('notes.index') }}">@lang('site.notes')</a>
                </li>
            @endauth
        </ul>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.register') }}">@lang('site.regs')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.login') }}">@lang('site.login')</a>
                </li>
            @endguest

            {{--  @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.logout') }}">@lang('site.logout')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active">{{ Auth::user()->role }}: {{ Auth::user()->name }}</a>
                </li>
            @endauth  --}}

            @auth
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->role }}: {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('auth.logout') }}">@lang('site.logout')</a>
                    </div>
                </li>
            @endauth


            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(Route::currentRouteName() == 'lang.ar') @lang('site.langEn') @else @lang('site.langAr') @endif
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if(Route::currentRouteName() == 'lang.en')
                        <a class="dropdown-item" href="{{ route('lang.ar') }}">@lang('site.langAr')</a>
                    @else
                        <a class="dropdown-item" href="{{ route('lang.en') }}">@lang('site.langEn')</a>
                    @endif
                </div>
            </li> --}}

             @if(Session::get('lang') == 'ar')

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('lang.ar') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @lang('site.langAr')
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('lang.en') }}">@lang('site.langEn')</a>
                    </div>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('lang.en') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @lang('site.langEn')
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('lang.ar') }}">@lang('site.langAr')</a>
                    </div>
                </li>
            @endif



            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('lang.ar') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @lang('site.langAr')
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('lang.en') }}">@lang('site.langEn')</a>
                </div>
            </li>  --}}

        </ul>
    </div>
</nav>
