@extends('admin.shared.mastercasher')
@section('content')
@if( is_permited('casher','view') == 1 )
    <form method="POST" action="{{route('sellInvoice.store')}}" >
        {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title text-center">Main Info ( بيانات اساسية )</h3>
                </div>
                <div class="box-body">
                    <input type="hidden" name="code"/>
                    <input type="hidden" name="date" value="{{ date('Y-m-d')  }}"/>
                    <input type="hidden" name="total_gain" id="totale_gain"/>
                    <input type="hidden" name="due" value="0"/>
                    <input type="hidden" name="invoice_type" value="0" />
                    <input type="hidden" name="casherinvoice" value="1" />
                    <input type="hidden" id="itrator" value="0" name="itrator"/>
                    @php
                        $input = "supplier_id";
                        selectform("Client ( العميل )",[ 'class' => 'form-control','name' => $input ],isset($row->$input) ? $row->$input : '',$databind['suppliers'], isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : []);
                        echo"<br>";

                        $input = "total_value";
                        inputForm('Total Price ( اجمالي الفاتورة )',['type' => 'number', 'step' => 'any' ,'class' => 'form-control','name' => $input ,'readonly' =>'readonly' , 'id' => 'totale_price'] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

                    @endphp
                </div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-md-6">
        <!-- DIRECT CHAT -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Categories ( الاقسام )</h3>

                <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages">{{ $databind['categories']->count()  }}</span>
                </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    <ul class="users-list clearfix">
                     @foreach($databind['categories'] as $category)
                            <li>
                                <a href="javascript:;" onclick="categoryProducts({{ $category->id  }})">
                                    <h4 class="users-list-name"> {{ $category['name']  }} </h4>
                                    <div style="margin-left: 30%;border-radius: 20%;max-width: 100px;height: 100px;background-color: {{ $category->color  }};"></div>
                                </a>
                            </li>
                     @endforeach
                    </ul>

                </div>
                <!--/.direct-chat-messages-->
            </div>

        </div>
        <!--/.direct-chat -->
    </div>

    <div class="col-md-6">
        <!-- DIRECT CHAT -->
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Products  ( المنتجات )</h3>

                <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="" class="badge bg-yellow" id="productsCount" data-original-title="3 New Messages">0</span>
                </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    <ul class="users-list clearfix" id="cat_products">

                    </ul>

                </div>
                <!--/.direct-chat-messages-->
            </div>

        </div>
        <!--/.direct-chat -->
    </div>
</div>
<div class='row'>


    <div class="col-md-12">
    <!-- DIRECT CHAT -->
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title text-center">Invoice ( الفاتورة )</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">

                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>Product ( المنتج )</th>
                            <th>َQuantity ( الكمية )</th>
                            <th>Pr/Of/Unit ( سعر الوحدة )</th>
                            <th>Total( الاجمالي )</th>
                            <th>Options( خيارات )</th>
                        </tr>
                        </thead>

                        <tbody id="tablebody">

                        </tbody>
                    </table>
                </div>

            </div>
            <!--/.direct-chat-messages-->
        </div>
        <div class="box-footer clearfix">
            <div class='form-group col-md-3'>
                <div class='col-sm-12'>
                    <select class="form-control" name="due">
                        <option  value="0"> تسديد الفاتورة </option>      
                        <option  value="1">  حفظ بدون تسديد </option>      
                    </select>
                </div>
            </div>
            <button class="btn btn-sm btn-info btn-flat pull-left">save ( حفظ  )</button>
        </div>

    </div>
    <!--/.direct-chat -->
    </div>

</div>
 </form>
@else
 <h1> Not Permitied ( ليس لديك الصلاحيات لرؤية هذا المحتوي ) </h1>
@endif
@endsection
<script>
    function categoryProducts(catId){
        $('#cat_products').html("");
        $('#productsCount').html("0");
        var csrfToken = '{{csrf_token()}}';
        $.ajax({
            url      : "{{route('getCategoryProducts')}}",
            type     : 'POST',
            dataType : 'JSON',
            data     :  {_token: csrfToken, catId: catId},
            success: function (data) {
                if (data) {
                    var numofpro = Object.keys(data).length ;
                    $('#productsCount').html(numofpro);
                    if(numofpro > 0 ){
                        data.forEach(productsDisplayFunction.bind(null, 0)) ;
                    }else{
                        $('#cat_products').html("<h3 class='text-center'> No Data ( لايوجد منتجات ) </h3>");
                    }
                }
            }
        });
    }


    function productsDisplayFunction(formProNum,item){
        var products = "<li> <a href='javascript:;' onclick='productsInfo("+item.id+")'> <h4 class='users-list-name'>"+item.name+"</h4> <div style='margin-left: 10%;border-radius: 50%;max-width: 100px;height: 100px;background-color: "+item.color+";'></div></a></li>";
        $('#cat_products').append(products);
    }

    function productsInfo(ProId){

        var itrator = $('#itrator').val();
        var i ;
        for( i = 0 ; i <= itrator ; i++ ){
            var latproduct = $('#product_id'+i).val();

            if(ProId == latproduct){
                var quantity  = $('#quantity'+i).val();
                quantity = +quantity+1;
                $('#quantity'+i).val(quantity);
                countTotalPrice(i);
                alert('يرجي العلم ان هذا الصنف مضاف مسبقا وتم اضافة وحده في الفاتورة');
                return ;
            }
        }
        var csrfToken = '{{csrf_token()}}';
        $.ajax({
            url      : "{{route('getProductInfo')}}",
            type     : 'POST',
            dataType : 'JSON',
            data     :  {_token: csrfToken, ProId: ProId},
            success: function (data) {
                if (data) {
                    var hiddensellprice = " <input type='hidden' step=any id='sellprice"+itrator+"' name='sellprice"+itrator+"' value='"+data.pay_price+"' /> ";
                    var hiddenpayprice = " <input type='hidden' step=any id='payprice"+itrator+"' name='payprice"+itrator+"' value='"+data.sell_price+"' /> ";
                    var hiddentotalgain = "<input type='hidden' step=any id='totaleGain"+itrator+"' name='total_gain"+itrator+"' /> ";
                    var hiddentproductid = "<input type='hidden' id='product_id"+itrator+"' value='"+data.id+"' name='product_id"+itrator+"' /> ";
                    var row = " <tr id='row"+itrator+"'> "+ hiddentproductid + hiddensellprice + hiddenpayprice + hiddentotalgain+" <td>"+data.name+"</td>  <td> ("+ data.get_unit.name +" ) <input type='number' step=any style='max-width: 100px;' value='1' onchange='countTotalPrice("+itrator+")' id='quantity"+itrator+"' name='quantity"+itrator+"' /></td> <td> "+data.pay_price+" </td>  <td> <input style='width: 100px;' type='number' readonly='readonly' step=any id='totalePrice"+itrator+"' name='total_price"+itrator+"' /> </td> <td> <button onclick='removeitemrow("+itrator+")' class='btn btn-sm btn-danger'> X </button> </td> </tr> ";
                    $("#tablebody").append(row);
                    countTotalPrice(itrator);
                    itrator = +itrator + 1 ;
                    $('#itrator').val(itrator);
                }
            }
        });
    }

    function countTotalPrice(itrator) {

        var rowTotal = $('#totalePrice'+itrator).val();
        var invoiceTotalPrice = $('#totale_price').val();
        invoiceTotalPrice = +invoiceTotalPrice - rowTotal;
        $('#totale_price').val(invoiceTotalPrice);

        var rowTotalGain = $('#totaleGain'+itrator).val();
        var invoiceTotalGain = $('#totale_gain').val();
        invoiceTotalGain = +invoiceTotalGain - rowTotalGain;

        $('#totale_gain').val(invoiceTotalGain);

        var quantity  = $('#quantity'+itrator).val();
        var sellprice  = $('#sellprice'+itrator).val();
        var payprice  = $('#payprice'+itrator).val();

        var total     = quantity * sellprice;

        var totalGain = quantity * (sellprice - payprice);

        $('#totalePrice'+itrator).val(total);
        $('#totaleGain'+itrator).val(totalGain);

        invoiceTotalPrice = $('#totale_price').val();
        invoiceTotalPrice = +invoiceTotalPrice + total;

        $('#totale_price').val(invoiceTotalPrice);

        invoiceTotalGain = $('#totale_gain').val();
        invoiceTotalGain = +invoiceTotalGain + totalGain;
        $('#totale_gain').val(invoiceTotalGain);
    }

    function removeitemrow(itrator){

        var rowTotal = $('#totalePrice'+itrator).val();
        var rowTotalGain = $('#totaleGain'+itrator).val();

        $('#row'+itrator).remove();

        var invoiceTotalPrice = $('#totale_price').val();
        invoiceTotalPrice = +invoiceTotalPrice - rowTotal;
        $('#totale_price').val(invoiceTotalPrice);

        var invoiceTotalGain = $('#totale_gain').val();
        invoiceTotalGain = +invoiceTotalGain - rowTotalGain;
        $('#totale_gain').val(invoiceTotalGain);
    }

</script>