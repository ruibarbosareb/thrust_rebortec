@component('thrust::components.formField', ["field" => $field, "title" => $title, "description" => $description ?? null, "inline" => $inline])
    <input type="hidden" name="{{$field}}" value="">
    <template id="template-{{$field}}">
        <div id="keyValue-template" class="mb2 keyValueField-{{$field}}" style="height:30px">
            <div class="inline" id="keyValueFields-template">
                {!! $keyValueField->generateKeyField('template') !!}
                {!! $keyValueField->generateValueField('template') !!}
            </div>
            <span>
                <a class="button secondary" onclick="keyValueRemove(this)">@icon(times)</a>
            </span>
        </div>
    </template>

    <div id="keyValue-{{$field}}">
        @if (! empty($value))
            @foreach($value as $v)
                <div id="keyValue-{{$loop->iteration}}" class="mb2 keyValueField-{{$field}}" style="height:30px">
                    <div class="inline" id="keyValueFields-{{$loop->iteration}}">
                        {!! $keyValueField->generateKeyField($loop->iteration, $v->key) !!}
                        {!! $keyValueField->generateValueField($loop->iteration, $v->value) !!}
                    </div>
                    <span>
                        <a class="button secondary" onclick="keyValueRemove(this)">@icon(times)</a>
                    </span>
                </div>
            @endforeach
        @endif
    </div>
    <div>
        <a class="button secondary" onclick="keyValueAdd()" class="pointer"> @icon(plus) {{ __('admin.add') }}</a>
    </div>

    @push('edit-scripts')
        <script>
            function keyValueRemove(element){
                $(element).parent().parent().find('div').remove();
                $(element).parent().parent().hide();
            }

            function keyValueAdd(){
                var template    = $("#template-{{$field}}").html();
                var newKeyValue = $(template);

                let n = 100 + Math.floor(Math.random() * 50);

                newKeyValue.prop('id', 'keyValue-' + n);
                newKeyValue.find('div').first('div').prop('id', 'keyValueFields-' + n);

                newKeyValue.find('div').first('div').find('input').first().prop('id', '{{$field}}['+ n +'][key]');
                newKeyValue.find('div').first('div').find('input').first().prop('name', '{{$field}}['+ n +'][key]');
                newKeyValue.find('div').first('div').find('select').first().prop('id', '{{$field}}['+ n +'][key]');
                newKeyValue.find('div').first('div').find('select').first().prop('name', '{{$field}}['+ n +'][key]');

                newKeyValue.find('div').first('div').find('input').last().prop('id', '{{$field}}['+ n +'][value]');
                newKeyValue.find('div').first('div').find('input').last().prop('name', '{{$field}}['+ n +'][value]');
                newKeyValue.find('div').first('div').find('select').last().prop('id', '{{$field}}['+ n +'][value]');
                newKeyValue.find('div').first('div').find('select').last().prop('name', '{{$field}}['+ n +'][value]');
                $('#keyValue-{{$field}}').append(newKeyValue);
            }
        </script>
    @endpush
@endcomponent