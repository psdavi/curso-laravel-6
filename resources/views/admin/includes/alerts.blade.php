
@if ($errors->any())
<div class="alert alert-warning">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif



{{--
<!-- caso o alerta passe algo vazio, não vai dar erro por causa da ??''-->
<div class="alert">Alert - {{ $content ?? '' }}</div>
--}}
