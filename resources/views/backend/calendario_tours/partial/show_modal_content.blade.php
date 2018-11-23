<div class='row'>
    <div class='col-md-3'><b>Tour:</b></div>
    <div class='col-md-9'><p>{{$calendario->tour->nb}}</p></div>
</div>
<div class='row'>
    <div class='col-md-3'><b>Desde el:</b></div>
    <div class='col-md-9'><p>{{$calendario->desde}}</p></div>
</div>
<div class='row'>
    <div class='col-md-3'><b>Hasta el:</b></div>
    <div class='col-md-9'><p>{{$calendario->hasta}}</p></div>
</div>
<div class='row'>
    <div class='col-md-3'><b>Precio Single:</b></div>
    <div class='col-md-9'><p>${{$calendario->precio_s_pax}}</p></div>
</div>
<div class='row'>
    <div class='col-md-3'><b>Precio Double:</b></div>
    <div class='col-md-9'><p>${{$calendario->precio_d_pax}}</p></div>
</div>
{{--<div class='row'>--}}
    {{--<div class='col-md-3'><b>Valores:</b></div>--}}
{{--</div>--}}
{{--@foreach (json_decode($calendario->text) as $key => $value)--}}
    {{--<div class='row'>--}}
        {{--<div class='col-md-3'><b>{!! $key !!}</b></div>--}}
        {{--<div class='col-md-9'><p>{!! $value !!}</p></div>--}}
    {{--</div>--}}
{{--@endforeach--}}
