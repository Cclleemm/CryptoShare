@extends('layouts.template')

@section('page-title')
    Cryptochart | Configuration
@endsection

@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Configuration
            <small>Donnés utiles au bon fonctionnement de cette app</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Accueil</a></li>
            <li class="active">Configuration</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          @if(session()->has('ok'))
            <div class="row">
              <div class="col-md-6 alert alert-success alert-dismissible">{!! session('ok') !!}</div>
            </div>
          @endif          

          <!-- FORM START HERE -->
          @foreach($configurations as $configuration)
          @if($configuration->count() == 1)
              {{ Form::model($configuration, ['route' => ['configuration.update', $configuration->id], 'method' => 'put']) }}
          @else
              {!! Form::open(['route' => 'configuration.store']) !!}
          @endif
          @endforeach

          {!! Form::open(['route' => 'configuration.store']) !!}

          <div class="row">
            <!-- left column -->
            <div class="col-md-8">

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Clé API du pool</h3>
                </div>
                <div class="box-body">
                  <div class="form-group {!! $errors->has('api_key') ? 'has-error' : '' !!}">
                    {!! Form::text('api_key', null, ['class' => 'form-control input-lg', 'placeholder' => 'Copier la clé ici']) !!}
                    {!! $errors->first('api_key', '<small class="help-block">:message</small>') !!}
                  </div>
                </div>
                <!-- /.box-body -->
              </div>

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Mon Mining rig</h3>
                </div>
                <div class="box-body">

                  <div class="col-sm-4">
                    <div class="form-group {!! $errors->has('number_cpus') ? 'has-error' : '' !!}">
                      <label for="number_cpus">Nombre de GPUs</label>
                      {!! Form::number('number_cpus', null, ['class' => 'form-control input-lg', 'placeholder' => '1, 2, 3 ... ?', 'min' => '0']) !!}
                      {!! $errors->first('number_cpus', '<small class="help-block">:message</small>') !!}
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group {!! $errors->has('fiat_currency_symbol') ? 'has-error' : '' !!}" style="display:block">
                      <label for="fiat_currency_symbol">Devise d'affichage (FIAT)</label>
                      {!! Form::select('fiat_currency_symbol', array('EUR' => 'Euro', 'USD' => 'US Dollar'), isset($configuration) ? $configuration->fiat_currency_symbol : 'USD', ['class' => 'form-control input-lg']) !!}    
                      {!! $errors->first('fiat_currency_symbol', '<small class="help-block">:message</small>') !!}
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group {!! $errors->has('electricity_cost') ? 'has-error' : '' !!}">
                      <label for="electricity_cost">Coût électrique / mois</label>
                      <div class="input-group">
                        {!! Form::number('electricity_cost', null, ['class' => 'form-control input-lg', 'placeholder' => '', 'min' => '0']) !!}
                        <span class="input-group-addon">{{isset($configuration) ? $configuration->fiat_currency_symbol : 'USD'}} / mois</span>
                      </div>
                      {!! $errors->first('electricity_cost', '<small class="help-block">:message</small>') !!}
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group {!! $errors->has('crypto_currency_symbol') ? 'has-error' : '' !!}">
                      <label for="crypto_currency_symbol">Monnaie minée</label>
                      <select name="crypto_currency_symbol" class="form-control select2" style="width: 100%;">
                        @foreach($allCoins as $coin)
                          @if(isset($configuration) && $coin->symbol==$configuration->crypto_currency_symbol)
                            <option value="{{$coin->symbol}}|{{$coin->id}}" selected>{{ $coin->name}}</option>
                          @else
                            <option value="{{$coin->symbol}}|{{$coin->id}}">{{ $coin->name}}</option>
                          @endif
                        @endforeach
                      </select>
  
                      {!! $errors->first('crypto_currency_symbol', '<small class="help-block">:message</small>') !!}
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>

              {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary pull-left']) !!}

            </div>
          </div>


          {!! Form::close() !!}

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

@endsection

@section('extra-script')

  {{ Html::script('bower_components/select2/dist/js/select2.full.min.js') }}

  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    });
  </script>

@endsection