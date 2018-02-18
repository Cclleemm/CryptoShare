@extends('layouts.template')

@section('page-title')
    Cryptochart | Profil
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Accueil</a></li>
                <li><a href="{{url('/recipient')}}">Bénéficiaires</a></li>
                <li class="active">{{$recipient->name}}</li>
            </ol>
            <h2>
                {{$recipient->name}}
                <small>Détails du bénéficiaire</small>
            </h2>
        </section>

        <!-- Main content -->
        <section class="content">

            @if(session()->has('ok'))
                <div class="row">
                    <div class="col-md-6 alert alert-success alert-dismissible">{!! session('ok') !!}</div>
                </div>
            @endif


            <div class="row">
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="card-image">

                            <img src="{{ asset('img/bg-'.($recipient->id%6).'.png') }}"
                                 alt="...">
                        </div>
                        <div class="card-body">
                            <div class="author">
                                <a href="{{url('/recipient/'.$recipient->id)}}">
                                    <img class="avatar border-gray" src="{{$recipient->getAvatarUrl()}}"
                                         alt="avatar">
                                    <h4 class="title">{{$recipient->name}} </h4>
                                </a>
                                <p class="description">
                                    Actionnaire à <b>{{$recipient->shares}}%</b> <br/>depuis
                                    le {{ date("d/m/Y",strtotime($recipient->start_date)) }}
                                </p>
                            </div>
                            <p class="description text-center">
                                <a target="_blank"
                                   href="https://verge-blockchain.info/address/{{$recipient->wallet_address}}">{{$recipient->wallet_address}}</a>

                            </p>
                        </div>
                        <hr>
                        <div class="row text-center" style="margin-top:10px;">
                            <div class="col-md-4">
                                <h5>{{count($recipient->transactions)}}<br>
                                    <small>Transactions</small>
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <h5>{{$recipient->transactionsFiatSum()}} {{$configuration->fiat_currency_symbol}}<br>
                                    <small>Gagné</small>
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <h5>{{$recipient->type}}<br>
                                    <small>Wallet</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">Mes transactions</h4>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Note</th>
                                    <th>Montant en {{$configuration->crypto_currency_name}}</th>
                                    <th>Montant fiat</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($recipient->transactions as $transaction)
                                    <tr>
                                        <td>{{ date("d/m/Y H:i",strtotime($transaction->created_at)) }}</td>
                                        <td>{{$transaction->note}}</td>
                                        <td class="text-success">+ {{$transaction->crypto_amount_transfered}}  {{$configuration->crypto_currency_symbol}}</td>
                                        <td class="text-success">+ {{$transaction->fiat_amount_transfered}}  {{$configuration->fiat_currency_symbol}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>

@endsection

@section('extra-script')

    {{ Html::script('bower_components/datatables.net/js/jquery.dataTables.min.js') }}
    {{ Html::script('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}

    <script>
        $(function () {

            $('#transaction-table').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })

        });

    </script>


@endsection