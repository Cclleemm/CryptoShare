@extends('layouts.template')

@section('page-title')
    Cryptochart | Bénéficiaires
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Bénéficiaires
                <small>Liste des investisseurs</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Accueil</a></li>
                <li class="active">Bénéficiaires</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            @if(session()->has('ok'))
                <div class="row">
                    <div class="col-md-6 alert alert-success alert-dismissible">{!! session('ok') !!}</div>
                </div>
            @endif


            @auth
                <div class="row" style="margin-bottom:30px">
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-success btn-flat" data-toggle="modal"
                                data-target="#modal-add-recipient">Ajouter un bénéficiaire
                        </button>
                    </div>
                </div>
            @endauth
            <div class="row">

            <!-- A SUPPRIMER SI THOMAS AIME BIEN
            <div class="col-md-12">
              <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Type</th>
                      <th>Part</th>
                      <th>Adresse du wallet</th>
                      <th>Balance</th>
                      <th>Bénéficiaire depuis</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recipients as $recipient)
                <tr>
                  <td>{{$recipient->name}}</td>
                      <td>{{$recipient->type}}</td>
                      <td>{{$recipient->shares}}</td>
                      <td>{{$recipient->wallet_address}}</td>
                      <td>{{$recipient->balance}}</td>
                      <td>{{ date("d/m/Y",strtotime($recipient->start_date)) }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
                <!-- FIN A SUPPRIMER -->

                @foreach($recipients as $recipient)
                    <div class="col-md-5 col-lg-4">
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle"
                                     src="{{$recipient->getAvatarUrl()}}" alt="User profile picture">

                                <h3 class="profile-username text-center">{{$recipient->name}}</h3>

                                <p class="text-muted text-center">Actionnaire à <b>{{$recipient->shares}}%</b> <br/>depuis
                                    le {{ date("d/m/Y",strtotime($recipient->start_date)) }}</p>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Type</b> <a class="pull-right">{{$recipient->type}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Wallet</b> <a class="pull-right"
                                                         href="https://verge-blockchain.info/address/{{$recipient->wallet_address}}">{{$recipient->wallet_address}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Balance</b> <a class="pull-right">{{$recipient->balance}}</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Nombre de transactions</b> <a
                                                class="pull-right">{{count($recipient->transactions)}}</a>
                                    </li>

                                </ul>

                                <a href="{{url('/recipient/'.$recipient->id)}}" class="btn btn-primary btn-block"><b>Voir le profil</b></a>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                @endforeach
            </div>
    </section>

    </div>
    <!-- /.content-wrapper -->
    {!! Form::open(['route' => 'recipient.store']) !!}
    <div class="modal fade" id="modal-add-recipient">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ajouter un bénéficiaire</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                        <label for="type">Nom du bénéficiaire</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}">
                        <label for="type">Type de Wallet</label>
                        {!! Form::select('type', array('Crypto' => 'Crypto Wallet', 'Fiat' => 'Fiat Wallet'), 'Crypto', ['class' => 'form-control']) !!}
                        {!! $errors->first('type', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div id="wallet_address"
                         class="form-group {!! $errors->has('wallet_address') ? 'has-error' : '' !!}">
                        <label for="wallet_address">Adresse du wallet</label>
                        {!! Form::text('wallet_address', null, ['class' => 'form-control', 'placeholder' => 'Adresse du wallet']) !!}
                        {!! $errors->first('wallet_address', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div id="balance" style="display:none"
                         class="form-group {!! $errors->has('balance') ? 'has-error' : '' !!}">
                        <label for="balance">Balance</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                {{ $configuration->fiat_currency_symbol }}
                            </div>
                            {!! Form::number('balance', 0, ['class' => 'form-control', 'placeholder' => 'Exemple : 150', 'min' => '0']) !!}
                        </div>

                        {!! $errors->first('balance', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('shares') ? 'has-error' : '' !!}">
                        <label for="shares">Part (%)</label>
                        {!! Form::number('shares', null, ['class' => 'form-control', 'placeholder' => '69', 'min' => '0', 'max' => '100', 'step' => 'any']) !!}
                        {!! $errors->first('shares', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group">
                        <label>Date d'entrée</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            {!! Form::text('start_date', null, ['class' => 'form-control', 'id' => 'datepicker']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Annuler</button>
                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    {!! Form::close() !!}

@endsection

@section('extra-script')

    {{ Html::script('bower_components/select2/dist/js/select2.full.min.js') }}
    {{ Html::script('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}
    {{ Html::script('js/custom.js') }}

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
        });

    </script>

@endsection