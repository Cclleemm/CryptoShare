@extends('layouts.template')

@section('page-title')
    Cryptochart | Transactions
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Accueil</a></li>
                <li class="active">Transactions</li>
            </ol>
            <h2>
                Transactions
                @auth
                    <button type="button" class="btn btn-success btn-flat" data-toggle="modal"
                            data-target="#modal-add-transaction">Ajouter
                    </button>
                @endauth
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
                    <div class="col-md-12">
                        <div class="card strpied-tabled-with-hover">
                            <div class="card-header ">
                                <h4 class="card-title">Toutes les transactions</h4>
                            </div>
                            <div class="card-body table-full-width table-responsive">
                                <table   class="table table-hover table-striped">
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
                                            <td class="text-success">
                                                + {{$transaction->crypto_amount_transfered}}  {{$configuration->crypto_currency_symbol}}</td>
                                            <td class="text-success">
                                                + {{$transaction->fiat_amount_transfered}}  {{$configuration->fiat_currency_symbol}}</td>
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
    <!-- /.content-wrapper -->
    {!! Form::open(['route' => 'transaction.store']) !!}
    <div class="modal fade" id="modal-add-transaction">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <div class="modal-profile">
                        <i class="nc-icon nc-money-coins"></i>
                    </div>
                    <h3>Ajouter une transaction</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body card">
                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                        <label for="type">Note</label>
                        {!! Form::text('note', null, ['class' => 'form-control', 'placeholder' => 'Description de la transaction']) !!}
                        {!! $errors->first('note', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('crypto_amount_transfered') ? 'has-error' : '' !!}">
                        <label for="shares">Montant en {{$configuration->crypto_currency_name}}</label>
                        {!! Form::number('crypto_amount_transfered', null, ['class' => 'form-control', 'placeholder' => '42', 'min' => '0', 'max' => '1000000000', 'step' => 'any']) !!}
                        {!! $errors->first('crypto_amount_transfered', '<small class="help-block">:message</small>') !!}
                    </div>

                <div class="form-group {!! $errors->has('recipient_id') ? 'has-error' : '' !!}">
                        <label for="shares">Bénéficiaire</label>
                        <select class="form-control" name="recipient_id">
                            <option value="">- Choisissez un bénéficiare -</option>
                            @foreach($recipients as $recipient)
                                <option value="{{ $recipient->id }}"
                                        @if(old('recipient_id') == $recipient->id) selected @endif>{{ $recipient->name }}</option>
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