<div class="row">
    <div class="col-md-12">
    <form action="{{ route($buttonsRoutsname.'.index') }}" method="GET">
        @php

            $input = "category_id";
            isset($filterData[$input]) ? $inputValue = $filterData[$input] : $inputValue = '';
            filterSelectForm(['class' => 'form-control','name' => $input ] ,2,$databind['categories'],$inputValue);

            $input ="datefrom";
            isset($filterData[$input]) ? $inputValue = $filterData[$input] : $inputValue = '';
            filterInputForm(['type' => 'date', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input , 'value' => $inputValue ] , 3 );

            $input ="dateto";
            isset($filterData[$input]) ? $inputValue = $filterData[$input] : $inputValue = '';
            filterInputForm(['type' => 'date', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input , 'value' => $inputValue ] , 3 );

        @endphp

        <button class="btn btn-sm btn-info btn-flat center"><i class="fa fa-search"></i> Search ( بحث ) </button>

    </form>
    </div>
</div>