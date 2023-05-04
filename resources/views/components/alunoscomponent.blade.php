
<link rel="stylesheet" href="{{ asset('css/se') }}">
<div class="form-group col-6">
    <label for="" class="form-label m-0">Usuário:</label>
    <select name="aluno" id="aluno" class="form-control js-states">
        @foreach ($model as $value )
         <option value="{{$value->id_fornecedores_despesas }}" >  {{ $value->razao_social }}</option>
        @endforeach
    </select>
</div>



