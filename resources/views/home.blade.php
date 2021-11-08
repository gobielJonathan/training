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
        left: 0;
        bottom: 0;
        width: 100%;
        border-radius: 0;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
        padding-left: .9rem;
        padding-top: 1rem;
        padding-bottom: .5rem;
        background-color: white;
        transition: all .2s ease-in-out;
        box-shadow: 0 0 3px var(--bg-primary);
        white-space: nowrap;
        overflow: auto;
        height: 80px;
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
    <img class="w-100 h-100" src="{{$banner->image}}" alt="banner-thumbnail">
    @endif

    <nav class="d-flex flex-row text-black">
        @if (isset($banner))
        <div class="nav-label col">
            <div>
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <span class="nav-text">
                <a href="{{route('instantCart', ['banner_id' => $banner->id], false)}}">Beli</a>
            </span>
        </div>
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
        <div class="nav-label col">
            <div>
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <span class="nav-text">
                <a href="{{route('seeUser', [], false)}}">User</a>
            </span>
        </div>


        @guest
        <div class="nav-label col">
            <div>
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <span class="nav-text">
                <a href="{{route('login', [], false)}}">Masuk</a>
            </span>
        </div>
        @endguest

        <div class="nav-label col">
            <div>
                <i class="fa fa-info-circle" aria-hidden="true"></i>
            </div>
            <span class="nav-text">
                <a href="{{route('faq', [], false)}}">Tanya Jawab</a>
            </span>
        </div>

        @if (Auth::user()->isAdmin())
        <div class="nav-label col">
            <div>
                <i class="fa fa-book" aria-hidden="true"></i>
            </div>
            <span class="nav-text">
                <a href="{{route('showPageAdmin', [], false)}}">Admin</a>
            </span>
        </div>
        @endif

        <div class="nav-label col">
            <div>
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </div>
            <span class="nav-text">
                <a href="{{route('logout', [], false)}}">Keluar</a>
            </span>
        </div>
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