<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords"
        content="pelatihan daring, pelatihan eksperimen, pelatihan online, online training, experiment training, online experiment, online experiment training">

    @yield('head.meta')
    <title>
        @if(isset($banner))
        {{$banner->title}}
        @else
        Hadirilah Pelatihan Daring Eksperimen Abad Ini
        @endif
    </title>

    <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.min.css')}}">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="{{asset('/assets/icons/font-awesome/css/font-awesome.css')}}">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

    <script src="{{asset('/assets/js/axios.min.js')}}"></script>
    <script src="{{asset('/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('/assets/js/bootstrap.min.js')}}"></script>

    <style>
        :root {
            --bg-primary: #6D9CC6;
            --bg-secondary: #8E8E8E;
        }

        .bg-primary {
            background-color: var(--bg-primary) !important;
        }

        .text-primary {
            color: var(--bg-primary) !important;
        }

        @font-face {
            src: url('{{asset("/assets/fonts/Poppins/Poppins-SemiBold.ttf")}}');
            font-family: 'font-bold';
            font-display: 'swap';
        }

        @font-face {
            src: url('{{asset("/assets/fonts/Poppins/Poppins-Light.ttf")}}');
            font-family: 'font-light';
            font-display: 'swap';
        }

        @font-face {
            src: url('{{asset("/assets/fonts/Poppins/Poppins-Regular.ttf")}}');
            font-family: 'font-regular';
            font-display: 'swap';
        }

        .text-bold {
            font-family: 'font-bold' !important;
        }

        .text-secondary {
            color: var(--bg-secondary) !important;
        }

        .text-light {
            font-family: 'font-light' !important
        }

        body {
            font-family: 'font-regular';
            font-size: 14px;
            width: 100vw;
            height: 100vh;
        }

        .box-shadow {
            box-shadow: 0 0 10px rgba(109, 156, 198, .5)
        }

        .box-rounded {
            border-radius: 7.6px;
        }

        .box-top-left-rounded {
            border-top-left-radius: 7.6px;
        }

        .box-top-right-rounded {
            border-top-right-radius: 7.6px;
        }

        .box-bottom-left-rounded {
            border-bottom-left-radius: 7.6px;
        }

        .box-bottom-right-rounded {
            border-bottom-right-radius: 7.6px;
        }


        .w-fit-content {
            width: fit-content
        }

        .h-fit-content {
            height: fit-content
        }

        .nav-link.active {
            background-color: var(--bg-primary) !important;
            color: white !important;
        }

        img {
            object-fit: contain;
            user-select: none;
        }

        a {
            color: var(--bg-primary) !important;
            text-decoration: none;
        }

        .center-h-v {
            display: grid;
            place-items: center;
        }

        .object-fill {
            object-fit: fill;
        }
    </style>
</head>

<body>
    @yield('content')
</body>


@yield('script')

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-212549994-1">
</script>
<script>
    window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-212549994-1');
</script>

</html>