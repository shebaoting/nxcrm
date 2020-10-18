<h1>{{$customer['name']}}<span>（#{{$customer['id']}}）</span></h1>
<div class="row" style="margin-top: 20px; color:#666">
    @if ($customer['fields'])
    @php
    $customer_fields = json_decode($customer['fields'],true);
    @endphp
    @foreach ($customerfields as $field)
    @php
    $field_options = json_decode($field['options'],true);
    @endphp
    <div class="col-md-4 col-sm-4 col-12">
        <i class="fa {{$field['icon']}}"></i>{{$field['name']}}:

        @if (in_array($field['type'],['select','radio']))
        {{$field_options[$customer_fields[$field['field']]]}}


        @elseif (in_array($field['type'],['checkbox','multipleSelect']))
        @foreach ($customer_fields[$field['field']] as $key => $value)
        @if ($value)
        {{$field_options[$value]}}
        @endif
        @endforeach
        @else
        @isset($customer_fields[$field['field']])
           {{$customer_fields[$field['field']]}}
        @endisset
        @endif


    </div>
    @endforeach
    @endif
</div>
