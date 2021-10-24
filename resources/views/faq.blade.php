@extends('layout.app')
@section('head.meta')
<meta name="description" content="Tata Cara Pendaftaran dan Pembayaran Keikutsertaan Pelatihan">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{env('APP_URL')}}">
<meta property="og:title" content="FAQ">
<meta property="og:description" content="Tata Cara Pendaftaran dan Pembayaran Keikutsertaan Pelatihan">


<script type="application/ld+json">
    {
  "@context": "https://schema.org/", 
  "@type": "HowTo", 
  "name": "Tata Cara Pendaftaran dan Pembayaran Keikutsertaan Pelatihan",
  "description": "Tata Cara Pendaftaran dan Pembayaran Keikutsertaan Pelatihan",
  "estimatedCost": {
    "@type": "MonetaryAmount",
    "currency": "IDR",
    "value": ""
  },
  "step": [{
    "@type": "HowToStep",
    "text": "Tahap 1. Calon peserta mendaftarkan diri dengan membuat akun (sign up) pada website: https://www.pelatihandaringeksperimen.com/auth/login"
  },{
    "@type": "HowToStep",
    "text": "Tahap 2. Calon peserta memasuki (sign in) laman pendaftaran pada website: https://www.pelatihandaringeksperimen.com melalui akun masing-masing."
  },{
    "@type": "HowToStep",
    "text": "Tahap 3. Calon peserta memilih fitur: yang terletak pada sisi kiri tengah laman pendaftaran website, apabila ingin langsung melakukan pembayaran."
  },{
    "@type": "HowToStep",
    "text": "Tahap 4. Calon peserta memilih fitur:  yang terletak pada sisi kiri tengah laman pendaftaran website, apabila tidak ingin langsung melakukan pembayaran."
  },{
    "@type": "HowToStep",
    "text": "Tahap 5. Calon peserta melakukan pembayaran (checkout) dengan melakukan transfer pada alternatif pilihan bank yang tersedia."
  },{
    "@type": "HowToStep",
    "text": "Tahap 6. Calon peserta mengunduh bukti transfer pada fitur “upload bukti pembayaran”."
  },{
    "@type": "HowToStep",
    "text": "Tahap 7. Calon peserta melakukan konfirmasi telah melakukan pembayaran kepada nomer salah satu contact person yang tertera pada e-poster pada website: https://www.pelatihandaringeksperimen.com"
  },{
    "@type": "HowToStep",
    "text": "Tahap 8. Calon peserta menunggu e-ticket yang berisi link dan passcode Zoom untuk mengikuti pelatihan.  E-ticket akan dikirimkan langsung ke email calon peserta yang pembayarannya sudah diverifikasi oleh panitia."
  },]    
}
</script>
@endsection

@section('content')
<div class="w-100 h-100  d-flex">
    <h3>Tata Cara Pendaftaran dan Pembayaran Keikutsertaan Pelatihan</h3>
    <div id="accordion">
        @foreach ($datas as $item)
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#{{$item[0]}}" aria-expanded="true"
                        aria-controls="collapseOne">
                        {{$item[0]}}
                    </button>
                </h5>
            </div>

            <div id="{{$item[0]}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    {{$item[1]}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection