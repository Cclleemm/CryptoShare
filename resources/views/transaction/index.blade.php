@extends('layouts.template')

@section('page-title')
    Cryptochart | Transactions
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Transactions
                <small>Liste des transactions</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Accueil</a></li>
                <li class="active">Transactions</li>
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
                                data-target="#modal-add-transaction">Ajouter une transaction
                        </button>
                    </div>
                </div>
            @endauth
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
                                @foreach($transactions as $transaction)
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
    <!-- /.content-wrapper -->
    {!! Form::open(['route' => 'transaction.store']) !!}
    <div class="modal fade" id="modal-add-transaction">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ajouter une transaction</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                        <label for="type">Note</label>
                        {!! Form::text('note', null, ['class' => 'form-control', 'placeholder' => 'Description de la transaction']) !!}
                        {!! $errors->first('note', '<small class="help-block">:message</small>') !!}
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group {!! $errors->has('crypto_amount_transfered') ? 'has-error' : '' !!}">
                        <label for="shares">Montant en {{$configuration->crypto_currency_name}}</label>
                        {!! Form::number('crypto_amount_transfered', null, ['class' => 'form-control', 'placeholder' => '42', 'min' => '0', 'max' => '1000000000', 'step' => 'any']) !!}
                        {!! $errors->first('crypto_amount_transfered', '<small class="help-block">:message</small>') !!}
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group {!! $errors->has('recipient_id') ? 'has-error' : '' !!}">
                        <label for="shares">Bénéficiaire</label>
                        <select class="form-control" name="recipient_id">
                            <option value="">- Choisissez un bénéficiare -</option>
                            @foreach($recipients as $recipient)
                                <option value="{{ $recipient->id }}" @if(old('recipient_id') == $recipient->id) selected @endif>{{ $recipient->name }}</option>
                            @endforeach
                        </select>
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