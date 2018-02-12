@extends('layouts.template')

@section('page-title')
    Cryptochart | Bienvenue
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->

    @if(isset($error))
        <div class="row">
            <div class="alert alert-warning col-sm-12">
                <h4>Clé API manquante ou erronné !</h4>

                Veuillez renseigner une clé API validecorrespondant à
                votre compte sur le pool pour le bon fonctionnement de cette plateforme.
                <br/><br/>
                <a href="{{ url('/configuration') }}" class="btn btn-primary">Configurer ma clé API</a>

            </div>

        </div>

    @else


        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big  {{ ($coin_change < 0) ? 'text-danger' : 'text-success' }} text-center">
                                    <i class="nc-icon nc-chart-bar-32"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p>Cours du {{$coin_symbol}}</p>
                                    {{$coin_price}}
                                    <small> {{$currency}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>
                            <div class="stats">
                                <i class="nc-icon {{ ($coin_change < 0) ? 'nc-stre-down' : 'nc-stre-up' }}"></i>
                                <b>{{$coin_change}}%</b> depuis les dernières 24h
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-primary text-center">
                                    <i class="nc-icon nc-spaceship"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p>Vitesse de minage</p>
                                    {{round($hashrate)}}
                                    <small> MH/s</small>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>
                            <div class="stats">
                                <i class="nc-icon nc-refresh-02"></i> Vitesse estimée il y a 1 minute
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-warning text-center">
                                    <i class="nc-icon nc-money-coins"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p>Gains du pool</p>
                                    {{$balance}}
                                    <small>{{$coin_symbol}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>
                            <div class="stats">
                                <i class="nc-icon nc-bulb-63"></i> <b>{{$balance_fiat}}
                                    <small>{{$currency}}</small>
                                </b> au cours actuel
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <a href="{{url('/recipient')}}">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-info text-center">
                                        <i class="nc-icon nc-circle-09"></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p>Bénéficaires</p>
                                        {{ count($recipients) }}
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr>
                                <div class="stats">
                                    <i class="nc-icon nc-stre-right"></i> Afficher les bénéficaires
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Gains par bénéficiaires</h4>
                        <p class="card-category">Répartition des gains par bénéficiaires</p>
                    </div>
                    <div class="card-body ">
                        <div id="chartPreferences" class="ct-chart ct-perfect-fourth">

                            <div class="ct-chart ct-golden-section" id="chart1"></div>



                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="nc-icon nc-bulb-63"></i> Basé sur le {{$coin_name}}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Gains du RIG (Comming soon)</h4>
                        <p class="card-category">Gains depuis la création du RIG</p>
                    </div>
                    <div class="card-body ">
                        <div id="chartHours" class="ct-chart">
                            <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="245px"
                                 class="ct-chart-line" style="width: 100%; height: 245px;">
                                <g class="ct-grids">
                                    <line y1="210" y2="210" x1="50" x2="850" class="ct-grid ct-vertical"></line>
                                    <line y1="185.625" y2="185.625" x1="50" x2="850" class="ct-grid ct-vertical"></line>
                                    <line y1="161.25" y2="161.25" x1="50" x2="850" class="ct-grid ct-vertical"></line>
                                    <line y1="136.875" y2="136.875" x1="50" x2="850" class="ct-grid ct-vertical"></line>
                                    <line y1="112.5" y2="112.5" x1="50" x2="850" class="ct-grid ct-vertical"></line>
                                    <line y1="88.125" y2="88.125" x1="50" x2="850" class="ct-grid ct-vertical"></line>
                                    <line y1="63.75" y2="63.75" x1="50" x2="850" class="ct-grid ct-vertical"></line>
                                    <line y1="39.375" y2="39.375" x1="50" x2="850" class="ct-grid ct-vertical"></line>
                                    <line y1="15" y2="15" x1="50" x2="850" class="ct-grid ct-vertical"></line>
                                </g>
                                <g>
                                    <g class="ct-series ct-series-a">
                                        <path d="M50,210L50,140.044C83.333,140.044,116.667,116.156,150,116.156C183.333,116.156,216.667,90.563,250,90.563C283.333,90.563,316.667,90.075,350,90.075C383.333,90.075,416.667,74.963,450,74.963C483.333,74.963,516.667,67.163,550,67.163C583.333,67.163,616.667,39.863,650,39.863C683.333,39.863,716.667,40.594,750,40.594C783.333,40.594,816.667,26.7,850,26.7C883.333,26.7,916.667,17.925,950,17.925C983.333,17.925,1016.667,3.787,1050,3.787C1083.333,3.787,1116.667,-20.1,1150,-20.1L1150,210Z"
                                              class="ct-area"
                                              values="[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object]"></path>
                                    </g>
                                    <g class="ct-series ct-series-b">
                                        <path d="M50,210L50,193.669C83.333,193.669,116.667,172.95,150,172.95C183.333,172.95,216.667,175.144,250,175.144C283.333,175.144,316.667,151.5,350,151.5C383.333,151.5,416.667,140.044,450,140.044C483.333,140.044,516.667,128.344,550,128.344C583.333,128.344,616.667,103.969,650,103.969C683.333,103.969,716.667,103.481,750,103.481C783.333,103.481,816.667,78.619,850,78.619C883.333,78.619,916.667,77.887,950,77.887C983.333,77.887,1016.667,77.4,1050,77.4C1083.333,77.4,1116.667,52.294,1150,52.294L1150,210Z"
                                              class="ct-area"
                                              values="[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object]"></path>
                                    </g>
                                    <g class="ct-series ct-series-c">
                                        <path d="M50,210L50,204.394C83.333,204.394,116.667,182.456,150,182.456C183.333,182.456,216.667,193.669,250,193.669C283.333,193.669,316.667,183.675,350,183.675C383.333,183.675,416.667,163.688,450,163.688C483.333,163.688,516.667,151.744,550,151.744C583.333,151.744,616.667,135.169,650,135.169C683.333,135.169,716.667,134.925,750,134.925C783.333,134.925,816.667,102.994,850,102.994C883.333,102.994,916.667,110.063,950,110.063C983.333,110.063,1016.667,110.063,1050,110.063C1083.333,110.063,1116.667,85.931,1150,85.931L1150,210Z"
                                              class="ct-area"
                                              values="[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object]"></path>
                                    </g>
                                </g>
                                <g class="ct-labels">
                                    <foreignObject style="overflow: visible;" x="50" y="215" width="100" height="20">
                                        <span class="ct-label ct-horizontal ct-end" style="width: 100px; height: 20px"
                                              xmlns="http://www.w3.org/1999/xhtml">9:00AM</span></foreignObject>
                                    <foreignObject style="overflow: visible;" x="150" y="215" width="100" height="20">
                                        <span class="ct-label ct-horizontal ct-end" style="width: 100px; height: 20px"
                                              xmlns="http://www.w3.org/1999/xhtml">12:00AM</span></foreignObject>
                                    <foreignObject style="overflow: visible;" x="250" y="215" width="100" height="20">
                                        <span class="ct-label ct-horizontal ct-end" style="width: 100px; height: 20px"
                                              xmlns="http://www.w3.org/1999/xhtml">3:00PM</span></foreignObject>
                                    <foreignObject style="overflow: visible;" x="350" y="215" width="100" height="20">
                                        <span class="ct-label ct-horizontal ct-end" style="width: 100px; height: 20px"
                                              xmlns="http://www.w3.org/1999/xhtml">6:00PM</span></foreignObject>
                                    <foreignObject style="overflow: visible;" x="450" y="215" width="100" height="20">
                                        <span class="ct-label ct-horizontal ct-end" style="width: 100px; height: 20px"
                                              xmlns="http://www.w3.org/1999/xhtml">9:00PM</span></foreignObject>
                                    <foreignObject style="overflow: visible;" x="550" y="215" width="100" height="20">
                                        <span class="ct-label ct-horizontal ct-end" style="width: 100px; height: 20px"
                                              xmlns="http://www.w3.org/1999/xhtml">12:00PM</span></foreignObject>
                                    <foreignObject style="overflow: visible;" x="650" y="215" width="100" height="20">
                                        <span class="ct-label ct-horizontal ct-end" style="width: 100px; height: 20px"
                                              xmlns="http://www.w3.org/1999/xhtml">3:00AM</span></foreignObject>
                                    <foreignObject style="overflow: visible;" x="750" y="215" width="100" height="20">
                                        <span class="ct-label ct-horizontal ct-end" style="width: 100px; height: 20px"
                                              xmlns="http://www.w3.org/1999/xhtml">6:00AM</span></foreignObject>
                                    <foreignObject style="overflow: visible;" y="185.625" x="10" height="24.375"
                                                   width="30"><span class="ct-label ct-vertical ct-start"
                                                                    style="height: 24px; width: 30px"
                                                                    xmlns="http://www.w3.org/1999/xhtml">0</span>
                                    </foreignObject>
                                    <foreignObject style="overflow: visible;" y="161.25" x="10" height="24.375"
                                                   width="30"><span class="ct-label ct-vertical ct-start"
                                                                    style="height: 24px; width: 30px"
                                                                    xmlns="http://www.w3.org/1999/xhtml">100</span>
                                    </foreignObject>
                                    <foreignObject style="overflow: visible;" y="136.875" x="10" height="24.375"
                                                   width="30"><span class="ct-label ct-vertical ct-start"
                                                                    style="height: 24px; width: 30px"
                                                                    xmlns="http://www.w3.org/1999/xhtml">200</span>
                                    </foreignObject>
                                    <foreignObject style="overflow: visible;" y="112.5" x="10" height="24.375"
                                                   width="30"><span class="ct-label ct-vertical ct-start"
                                                                    style="height: 24px; width: 30px"
                                                                    xmlns="http://www.w3.org/1999/xhtml">300</span>
                                    </foreignObject>
                                    <foreignObject style="overflow: visible;" y="88.125" x="10" height="24.375"
                                                   width="30"><span class="ct-label ct-vertical ct-start"
                                                                    style="height: 24px; width: 30px"
                                                                    xmlns="http://www.w3.org/1999/xhtml">400</span>
                                    </foreignObject>
                                    <foreignObject style="overflow: visible;" y="63.75" x="10" height="24.375"
                                                   width="30"><span class="ct-label ct-vertical ct-start"
                                                                    style="height: 24px; width: 30px"
                                                                    xmlns="http://www.w3.org/1999/xhtml">500</span>
                                    </foreignObject>
                                    <foreignObject style="overflow: visible;" y="39.375" x="10" height="24.375"
                                                   width="30"><span class="ct-label ct-vertical ct-start"
                                                                    style="height: 24px; width: 30px"
                                                                    xmlns="http://www.w3.org/1999/xhtml">600</span>
                                    </foreignObject>
                                    <foreignObject style="overflow: visible;" y="15" x="10" height="24.375" width="30">
                                        <span class="ct-label ct-vertical ct-start" style="height: 24px; width: 30px"
                                              xmlns="http://www.w3.org/1999/xhtml">700</span></foreignObject>
                                    <foreignObject style="overflow: visible;" y="-15" x="10" height="30" width="30">
                                        <span class="ct-label ct-vertical ct-start" style="height: 30px; width: 30px"
                                              xmlns="http://www.w3.org/1999/xhtml">800</span></foreignObject>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Open
                            <i class="fa fa-circle text-danger"></i> Click
                            <i class="fa fa-circle text-warning"></i> Click Second Time
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> Updated 3 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection

@section('extra-script')
<script>
    // Initialize a Line chart in the container with the ID chart1


    var data = {
        labels: [
            @foreach($recipients as $recipient)
            '{{strtok($recipient->name, " ")}}',
            @endforeach
        ],
        series: [
            @foreach($recipients as $key=>$recipient)
                {{$recipient->transactionsSum()}},
            @endforeach
        ]
    };

    var options = {
        labelInterpolationFnc: function(value) {
            return value[0]
        }
    };

    var responsiveOptions = [
        ['screen and (min-width: 640px)', {
            chartPadding: 30,
            labelOffset: 100,
            labelDirection: 'explode',
            labelInterpolationFnc: function(value) {
                return value;
            }
        }],
        ['screen and (min-width: 1024px)', {
            labelOffset: 80,
            chartPadding: 20
        }]
    ];




    new Chartist.Pie('#chart1', data, options, responsiveOptions);

</script>
@endsection