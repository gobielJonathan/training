@extends('layout.app')
@section('head.meta')
<meta name="description" content="Pelatihan Pengembangan Desain Penelitian Eksperimen untuk Pemula merupakan pelatihan yang diperuntukkan untuk para akademisi dan praktisi yang ingin mengenal metode eksperimen">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{env('APP_URL')}}">
<meta property="og:title" content="{{$banner->title}}">
<meta property="og:description" content="Pelatihan Pengembangan Desain Penelitian Eksperimen untuk Pemula merupakan pelatihan yang diperuntukkan untuk para akademisi dan praktisi yang ingin mengenal metode eksperimen">
<meta property="og:image" content="{{env('APP_URL')}}/{{$banner->image}}">


<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Event",
  "name": "{{$banner->title}}",
  "description": "{{$banner->title}}",
  "image": "{{env("APP_URL")}}/{{$banner->image}}",
  "eventStatus": "https://schema.org/EventScheduled",
  "eventAttendanceMode": "https://schema.org/OnlineEventAttendanceMode",
}
</script>
@endsection
<style>
    nav{
        top: 50%;
        transform: translateY(-50%);
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
        padding-left: .9rem;
        padding-top: 1rem;
        padding-bottom: .5rem;
        background-color: white;
        transition: all .2s ease-in-out;
        box-shadow : 0 0 3px var(--bg-primary);
    }
    nav .nav-label{
        width: 130px;
        min-width: 50px;
        font-size: 1.2rem;
        display: flex;
        margin-bottom: .5rem;
    }

    .nav-label a {
        color: black  !important;
    }

    nav .btn-collapse{
        top: 50%;
        transform: translateY(-50%)  rotate(90deg);
        right: 10px;
    }

    nav.collapsed .nav-text{
        visibility: hidden;
    }

    nav.collapsed{
        width: 80px;
    }

</style>
@section('content')
<div class="w-100 h-100  d-flex">
    @if (isset($banner))
    <img class="container mx-auto" src="{{$banner->image}}" alt="banner-thumbnail"> 
    @endif

    <nav class="position-fixed text-black">
        @if (isset($banner))
        <div class="nav-label">
            <div style="width: 16px">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <span class="ml-3 nav-text">
                <a href="{{route('instantCart', ['banner_id' => $banner->id], false)}}">Buy</a>
            </span>
        </div>
        @endif


        @auth
        @if (isset($banner))
        <div class="nav-label">
            <div style="width: 16px">
                <i class="fa fa-shopping-cart" aria-hidden="true">
                </i>
            </div>
            <span class="ml-3 nav-text">
             <a href="{{route('buyCart', ['banner_id' => $banner->id], false)}}">Cart</a>
            </span>
        </div>
        @endif
        <div class="nav-label">
            <div style="width: 16px">
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <span class="ml-3 nav-text">
                <a href="{{route('seeUser', [], false)}}">User</a>
            </span>
        </div>

        @if (Auth::user()->isAdmin())
        <div class="nav-label">
            <div style="width: 16px">
                <i class="fa fa-book" aria-hidden="true"></i>
            </div>
            <span class="ml-3 nav-text">
                <a href="{{route('showPageAdmin', [], false)}}">Admin</a>
            </span>
        </div>
        @endif

        <div style="width: 16px">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
            </div>
            <span class="ml-3 nav-text">
                <a href="{{route('faq', [], false)}}">FAQ</a>
            </span>
        </div>

        <div class="nav-label">
            <div style="width: 16px">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </div>
            <span class="ml-3 nav-text">
                <a href="{{route('logout', [], false)}}">Logout</a>
            </span>
        </div>
        @endauth

        @guest
        <div class="nav-label">
            <div style="width: 16px">
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <span class="ml-3 nav-text">
                <a href="{{route('login', [], false)}}">Sign In</a>
            </span>
        </div>
        @endguest

        <button class="btn btn-collapse btn-sm bg-transparent position-absolute">
            <i class="fa fa-bars text-primary" aria-hidden="true"></i>
        </button>
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