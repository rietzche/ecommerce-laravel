@extends('layouts.layout')

@section('content')

<main class="alert {{{ session('resent') ? 'bg-success' : 'bg-warning' }}} alert-styled-right" style="margin:50px 50px">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-semibold">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Sebelum memperoses, silahkan cek email anda untuk melakukan verifikasi.') }}
                        {{ __('jika anda belum menerima email ') }},  <u><a class="alert-link" href="{{ route('verification.resend') }}">{{ __('klik disini') }}</a>.</u>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
