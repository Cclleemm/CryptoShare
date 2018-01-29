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
          @auth
          <div class="row" style="margin-bottom:30px">
            <div class="col-sm-3">
              <button type="button" class="btn btn-success btn-flat">Ajouter un bénéficiaire</button>
            </div>
          </div>
          @endauth
          <div class="row">
            <div class="col-md-3">
              <div class="box box-primary">
                  <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

                    <h3 class="profile-username text-center">Nina Mcintire</h3>
                    @auth
                    <p class="text-muted text-center"><a href="" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Editer</button></a></p>
                    @endauth

                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        <b>Part</b> <a class="pull-right">33 %</a>
                      </li>
                      <li class="list-group-item">
                        <b>Balance</b> <a class="pull-right">543</a>
                      </li>
                      <li class="list-group-item">
                        <b>Wallet</b> <a class="pull-right">wererwesdfsdfrwe23432423423</a>
                      </li>
                    </ul>

                    <a href="#" class="btn btn-primary btn-block"><b>Détails</b></a>
                  </div>
                  <!-- /.box-body -->
              </div>
            </div>
          </div>
        </section>

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