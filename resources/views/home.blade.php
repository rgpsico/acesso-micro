@extends('layouts.app')

@section('content')


    <x-notificationbox/>
    <x-cardacessocomponent/>


<script>
    const empresaId = '306';
</script>

    @vite('resources/js/app.js')


@endsection
