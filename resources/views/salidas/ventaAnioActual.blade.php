@extends('layouts.app')
@section('content')

<label id="enero" style="display:none">{{$sumEne}}</label>
<label id="febrero" style="display:none">{{$sumFeb}}</label>
<label id="marzo" style="display:none">{{$sumMar}}</label>
<label id="abril" style="display:none">{{$sumAbr}}</label>
<label id="mayo" style="display:none">{{$sumMay}}</label>
<label id="junio" style="display:none">{{$sumJun}}</label>
<label id="julio" style="display:none">{{$sumJul}}</label>
<label id="agosto" style="display:none">{{$sumAgo}}</label>
<label id="septiembre" style="display:none">{{$sumSep}}</label>
<label id="octubre" style="display:none">{{$sumOct}}</label>
<label id="noviembre" style="display:none">{{$sumNov}}</label>
<label id="diciembre" style="display:none">{{$sumDic}}</label>

<div class="container-grafica">

    <canvas id="bar-chart" width="800" height="350" class="grafica"></canvas>

</div>
@section('script')

<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/chart-conf.js') }}"></script>
@endsection
@endsection