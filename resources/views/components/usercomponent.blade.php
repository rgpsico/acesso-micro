<div class="form-group col-6">
    <label for="" class="form-label m-0">Usuário:</label>
    <select name="user" id="user" class="form-control">
        @foreach ($user as $value )
         <option value="{{$value->id }}">{{ $value->name }}</option>
        @endforeach
    </select>
</div>
