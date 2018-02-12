@extends('layouts.template')

@section('page-title')
    Cryptochart | Bénéficiaires
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Accueil</a></li>
                <li class="active">Bénéficiaires</li>
            </ol>
            <h2>
                Bénéficiaires
                @auth
                            <button type="button" class="btn btn-success btn-flat" data-toggle="modal"
                                    data-target="#modal-add-recipient">Ajouter
                            </button>
                @endauth
            </h2>



        </section>

        <!-- Main content -->
        <section class="content">




            <div class="row">
                @foreach($recipients as $key=>$recipient)


                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="card-image">
                                @auth
                                    <button type="button" style="position: absolute; top:8px; left:10px;"
                                            class="btn btn-xs btn btn-primary btn-flat modify-recipient btn-fill" data-toggle="modal"
                                            data-id="{{$recipient->id}}" data-name="{{$recipient->name}}"
                                            data-type="{{$recipient->type}}"
                                            data-wallet="{{$recipient->wallet_address}}"
                                            data-shares="{{$recipient->shares}}" data-balance="{{$recipient->balance}}"
                                            data-start="{{$recipient->start_date}}"><i class="fa fa-pencil"></i> Editer
                                    </button>
                                    <button type="button" style="position: absolute; top:8px; right:10px;"
                                            class="btn btn-xs btn btn-danger btn-flat delete-recipient btn-fill" data-toggle="modal"
                                            data-id="{{$recipient->id}}" data-name="{{$recipient->name}}"><i
                                                class="fa fa-times"></i></button>
                                @endauth
                                <img src="{{ asset('img/bg-'.($key%6).'.png') }}"
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
                            <!--
                              <button href="#" class="btn btn-simple btn-link btn-icon">
                                  <i class="fa fa-facebook-square"></i>
                              </button>
                              <button href="#" class="btn btn-simple btn-link btn-icon">
                                  <i class="fa fa-twitter"></i>
                                  <br />{{$recipient->balance}}
                                    </button>
                                    <button href="#" class="btn btn-simple btn-link btn-icon">
                                        <i class="fa fa-google-plus-square"></i>
                                    </button>
-->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </section>

        <!-- Modal Add Recipient -->
        {!! Form::open(['route' => 'recipient.store', 'id' => 'addRecipient']) !!}
        <div class="modal fade" id="modal-add-recipient">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <div class="modal-profile">
                            <i class="nc-icon nc-single-02"></i>
                        </div>
                        <h3>Ajouter un bénéficiaire</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body card">
                        <div class="form-group">
                            <label for="type">Nom du bénéficiaire</label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                            <small class="help-block"></small>
                        </div>

                        <div class="form-group">
                            <label for="type">Type de Wallet</label>
                            {!! Form::select('type', array('Crypto' => 'Crypto Wallet', 'Fiat' => 'Fiat Wallet'), 'Crypto', ['class' => 'form-control']) !!}
                            <small class="help-block"></small>
                        </div>

                        <div class="wallet_address form-group">
                            <label for="wallet_address">Adresse du wallet</label>
                            {!! Form::text('wallet_address', null, ['class' => 'form-control', 'placeholder' => 'Adresse du wallet']) !!}
                            <small class="help-block"></small>
                        </div>

                        <div class="balance form-group" style="display:none">
                            <label for="balance">Balance</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    {{ $configuration->fiat_currency_symbol }}
                                </div>
                                {!! Form::number('balance', 0, ['class' => 'form-control', 'placeholder' => 'Exemple : 150', 'min' => '0']) !!}
                                <small class="help-block"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="shares">Part (%)</label>
                            {!! Form::number('shares', null, ['class' => 'form-control', 'placeholder' => '69', 'min' => '0', 'max' => '100', 'step' => 'any']) !!}
                            <small class="help-block"></small>
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

    <!-- Modal Edit Recipient -->
        {{ Form::model($recipient, ['route' => ['recipient.update', ''], 'method' => 'put', 'id' => 'modifyRecipient']) }}
        <div class="modal fade" id="modal-modify-recipient">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <div class="modal-profile">
                            <i class="nc-icon nc-ruler-pencil"></i>
                        </div>
                        <h3>Editer un bénéficiaire</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body card">
                        <div class="form-group">
                            <label for="type">Nom du bénéficiaire</label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                            <small class="help-block"></small>
                        </div>

                        <div class="form-group">
                            <label for="type">Type de Wallet</label>
                            {!! Form::select('type', array('Crypto' => 'Crypto Wallet', 'Fiat' => 'Fiat Wallet'), 'Crypto', ['class' => 'form-control']) !!}
                            <small class="help-block"></small>
                        </div>

                        <div class="wallet_address form-group">
                            <label for="wallet_address">Adresse du wallet</label>
                            {!! Form::text('wallet_address', null, ['class' => 'form-control', 'placeholder' => 'Adresse du wallet']) !!}
                            <small class="help-block"></small>
                        </div>

                        <div style="display:none" class="balance form-group">
                            <label for="balance">Balance</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    {{ $configuration->fiat_currency_symbol }}
                                </div>
                                {!! Form::number('balance', 0, ['class' => 'form-control', 'placeholder' => 'Exemple : 150', 'min' => '0']) !!}
                            </div>

                            <small class="help-block"></small>
                        </div>

                        <div class="form-group">
                            <label for="shares">Part (%)</label>
                            {!! Form::number('shares', null, ['class' => 'form-control', 'placeholder' => '69', 'min' => '0', 'max' => '100', 'step' => 'any']) !!}
                            <small class="help-block"></small>
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
        {!! Form::close() !!}


        {!! Form::open(['method' => 'DELETE', 'route' => ['recipient.destroy', ''], 'id' => 'deleteRecipient']) !!}
        <div class="modal modal-danger fade" id="modal-delete-recipient">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <div class="modal-profile">
                            <i class="nc-icon nc-simple-remove"></i>
                        </div>
                        <h3>Supprimer un bénéficiaire</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body card">
                        <p>Voulez vous vraiment supprimer <b><span id="recipientName"></span></b> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Annuler</button>
                        {!! Form::submit('Supprimer', ['class' => 'btn btn-outline btn-danger']) !!}
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {!! Form::close() !!}

    </div>

@endsection

@section('extra-script')

    {{ Html::script('bower_components/select2/dist/js/select2.full.min.js') }}
    {{ Html::script('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}
    {{ Html::script('js/custom.js') }}

    <script>
        $(function () {
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
        });

    </script>

@endsection