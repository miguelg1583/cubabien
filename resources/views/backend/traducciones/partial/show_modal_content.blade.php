<div class='row'>
    <div class='col-md-3'><b>Grupo:</b></div>
    <div class='col-md-9'><p>{{$trad->group}}</p></div>
</div>
<div class='row'>
    <div class='col-md-3'><b>Llave:</b></div>
    <div class='col-md-9'><p>{{$trad->key}}</p></div>
</div>
<div class='row'>
    <div class='col-md-3'><b>Valores:</b></div>
</div>
@foreach (json_decode($trad->text) as $key => $value)
    <div class='row'>
        <div class='col-md-3'><b>{!! $key !!}</b></div>
        <div class='col-md-9'><p>{!! $value !!}</p></div>
    </div>
@endforeach
