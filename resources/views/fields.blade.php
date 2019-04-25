<div class="mb-3 text-danger" id="all-pages" data-pages="{{$allPages}}" data-currentp="{{$currentPage}}">
    Searched fields: {{$allFields}}
</div>
<table class="table table-condensed table-bordered table-hover">
    <tbody>
    <tr>
        <th>Id</th>
        <th>String Field</th>
        <th>Boolean Field</th>
        <th>Decimal Field</th>
        <th>Timestamp Field</th>
    </tr>


        @if(isset($fields))

            @foreach($fields as $field)

                <tr class="filtered-fields">
                    <td>{{$field->id}}</td>
                    <td>{{$field->string_field}}</td>
                    <td>{{$field->boolean_field == 1 ? 'True' : 'False'}}</td>
                    <td>{{$field->decimal_field}}</td>
                    <td>{{date('d-m-Y H:i', strtotime($field->timestamp_field))}}</td>
                </tr>


            @endforeach
        @endif

    </tbody>
</table>



