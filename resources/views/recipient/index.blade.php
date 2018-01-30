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

          <div id="alert_message" class="row hidden">
            <div class="col-sm-6">
              <div class="alert alert-success alert-dismissible"><span></span></div>
            </div>
          </div>

          @auth
          <div class="row" style="margin-bottom:30px">
            <div class="col-sm-3">
              <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal-add-recipient">Ajouter un bénéficiaire</button>
            </div>
          </div>
          @endauth

          @foreach($recipients as $recipient)
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="box box-primary">
              <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

                <h3 class="profile-username text-center">
                  {{$recipient->name}} 
                  @auth
                  {!! link_to_route('recipient.edit', 'Editer', [$recipient->id], ['class' => 'btn btn-default btn-xs btn-flat', 'data-toggle' => 'modal', 'data-target' => '#modal-edit-recipient']) !!}
                  <button class="btn btn-danger btn-xs delete-recipient" data-id="{{$recipient->id}}" data-name="{{$recipient->name}}" data-toggle="modal"><i class="fa fa-times"></i></button>
                  @endauth
                </h3>

                <p class="text-muted text-center">Actionnaire à {{$recipient->shares}}% <br> depuis le {{$recipient->start_date}}</p>

                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Type</b> <a class="pull-right">{{$recipient->type}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Wallet</b> <a class="pull-right">{{$recipient->wallet_address}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Balance</b> <a class="pull-right">{{$recipient->balance}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Nombre de transactions</b> <a class="pull-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Voir le profil</b></a>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          @endforeach

        </section>

      </div>
      <!-- /.content-wrapper -->

      <!-- Modal Add Recipient -->
      {!! Form::open(['route' => 'recipient.store', 'id' => 'addRecipient']) !!}
      <div class="modal fade" id="modal-add-recipient">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Ajouter un bénéficiaire</h4>
            </div>
            <div class="modal-body">
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
                  
                  <div id="wallet_address" class="form-group">
                    <label for="wallet_address">Adresse du wallet</label>
                    {!! Form::text('wallet_address', null, ['class' => 'form-control', 'placeholder' => 'Adresse du wallet']) !!}
                    <small class="help-block"></small>
                  </div>

                  <div id="balance" style="display:none" class="form-group">
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
      {{ Form::model($recipient, ['route' => ['recipient.update', $recipient->id], 'method' => 'put']) }}
      <div class="modal fade" id="modal-edit-recipient">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Editer un bénéficiaire</h4>
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
                  
                  <div id="wallet_address" class="form-group {!! $errors->has('wallet_address') ? 'has-error' : '' !!}">
                    <label for="wallet_address">Adresse du wallet</label>
                    {!! Form::text('wallet_address', null, ['class' => 'form-control', 'placeholder' => 'Adresse du wallet']) !!}
                    {!! $errors->first('wallet_address', '<small class="help-block">:message</small>') !!}
                  </div>

                  <div id="balance" style="display:none" class="form-group {!! $errors->has('balance') ? 'has-error' : '' !!}">
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
      {!! Form::close() !!}


      {!! Form::open(['method' => 'DELETE', 'route' => ['recipient.destroy', ''], 'id' => 'deleteRecipient']) !!}
      <div class="modal modal-danger fade" id="modal-delete-recipient">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Supprimer un bénéficiaire</h4>
              </div>
              <div class="modal-body">
                <p>Voulez vous vraiment supprimer <span id="recipientName"></span> ?</p>
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

@endsection

@section('extra-script')

  {{ Html::script('bower_components/select2/dist/js/select2.full.min.js') }}
  {{ Html::script('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}
  {{ Html::script('js/custom.js') }}
  {{ Html::script('bower_components/datatables.net/js/jquery.dataTables.min.js') }}
  {{ Html::script('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}

  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2();

      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      })      

      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })

      // var wallet_type = $('select[name=type]').val();
      // if(wallet_type == "Fiat"){
      //   $('#wallet_address').css('visibility', 'hidden');
      // }
    });

  </script>

@endsection