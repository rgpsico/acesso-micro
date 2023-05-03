<div class="form-group col-12 my-2">
    <label for="" class="form-label m-0">Justificativa:</label>
    <select name="justificativa" id="justificativa" class="form-control">
        @foreach ($model as $value )
         <option value="{{$value->id }}">{{ $value->descricao }}</option>
        @endforeach
    </select>
</div>
