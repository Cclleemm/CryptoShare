@extends('layouts.template')

@section('page-title')
    Cryptochart | Profil
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                {{$recipient->name}}
                <small>Profil de {{$recipient->name}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Accueil</a></li>
                <li><a href="{{url('/recipient')}}">Bénéficiaires</a></li>
                <li class="active">{{$recipient->name}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            @if(session()->has('ok'))
                <div class="row">
                    <div class="col-md-6 alert alert-success alert-dismissible">{!! session('ok') !!}</div>
                </div>
            @endif

            <h2>Mes transactions</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="transaction-table" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Note</th>
                                        <th>Bénificaire</th>
                                        <th>Montant en {{$configuration->crypto_currency_name}}</th>
                                        <th>Montant fiat</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($recipient->transactions as $transaction)
                                        <tr>
                                            <td>{{ date("d/m/Y H:i",strtotime($transaction->created_at)) }}</td>
                                            <td>{{$transaction->note}}</td>
                                            <td>{{$transaction->recipient->name}}</td>
                                            <td class="text-success">+ {{$transaction->crypto_amount_transfered}}  {{$configuration->crypto_currency_symbol}}</td>
                                            <td class="text-success">+ {{$transaction->fiat_amount_transfered}}  {{$configuration->fiat_currency_symbol}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
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