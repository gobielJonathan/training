@extends('layout.app')
@section('head.meta')
<meta name="description" content="{{$banner->description}}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{env('APP_URL')}}">
<meta property="og:title" content="{{$banner->title}}">
<meta property="og:description" content="{{$banner->description}}">
<meta property="og:image" content="{{env('APP_URL')}}/{{$banner->image}}">


<script type="application/ld+json">
    {
  "@context": "https://schema.org",
  "@type": "Event",
  "name": "{{$banner->title}}",
  "description": "{{$banner->description}}",
  "image": "{{env("APP_URL")}}/{{$banner->image}}",
  "eventStatus": "https://schema.org/EventScheduled",
  "eventAttendanceMode": "https://schema.org/OnlineEventAttendanceMode",
}
</script>
@endsection
<style>
    nav {
        width: 100%;
        border-radius: 0;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
        background-color: white;
        transition: all .2s ease-in-out;
        box-shadow: 0 0 3px var(--bg-primary);
        white-space: nowrap;
        overflow: auto;
    }

    .nav-container {
        position: fixed;
        bottom: 0;
        left: 0;
    }

    nav .nav-label {
        font-size: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .nav-label a {
        color: black !important;
    }

    nav .btn-collapse {
        top: 50%;
        transform: translateY(-50%) rotate(90deg);
        right: 10px;
    }

    nav.collapsed .nav-text {
        visibility: hidden;
    }

    nav.collapsed {
        width: 80px;
    }

    .container-custom {
        width: 100%;
        max-width: 500px;
        margin: auto;
    }
</style>
@section('content')
<div class="container-custom">
    @if (isset($banner))
    <img class="w-100 h-100 mb-3 object-fill" src="{{$banner->image}}" alt="banner-thumbnail">
    @endif
</div>

<div class="nav-container">
    <nav class="d-flex p-3 flex-row text-black">
        @if (isset($banner))
        <a href="{{route('instantCart', ['banner_id' => $banner->id], false)}}">
            <div class="nav-label col">
                <div>
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </div>
                <span class="nav-text">
                    Daftar Akun
                </span>
            </div>
        </a>
        @endif


        @auth
        @if (isset($banner))
        <div class="nav-label col">
            <div>
                <i class="fa fa-shopping-cart" aria-hidden="true">
                </i>
            </div>
            <span class="nav-text">
                <a href="{{route('buyCart', ['banner_id' => $banner->id], false)}}">Keranjang</a>
            </span>
        </div>
        @endif
        <a href="{{route('seeUser', [], false)}}">
            <div class="nav-label col">
                <div>
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <span class="nav-text">
                    User
                </span>
            </div>
        </a>


        @guest
        <a href="{{route('login', [], false)}}">
            <div class="nav-label col">
                <div>
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <span class="nav-text">
                    Masuk
                </span>
            </div>
        </a>
        @endguest

        <a href="{{route('faq', [], false)}}">
            <div class="nav-label col">
                <div>
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                </div>
                <span class="nav-text">
                    Tanya Jawab
                </span>
            </div>
        </a>

        @if (Auth::user()->isAdmin())
        <a href="{{route('showPageAdmin', [], false)}}">
            <div class="nav-label col">
                <div>
                    <i class="fa fa-book" aria-hidden="true"></i>
                </div>
                <span class="nav-text">
                    Admin
                </span>
            </div>
        </a>
        @endif

        <a href="{{route('logout', [], false)}}">
            <div class="nav-label col">
                <div>
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                </div>
                <span class="nav-text">
                    Keluar
                </span>
            </div>
        </a>
        @endauth

    </nav>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
            $(".btn-collapse").click(function () {
                $('nav').toggleClass("collapsed")
            })
        })
</script>
@endsection