@extends('admin.shared.master')
@section('content')
@if( is_permited('dashboard','view') == 1 )
<div class="row">

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
    <div class="inner text-center">
        <h3>{{ $users->count() }}</h3>

        <p>Users ( المستخدمين )</p>

    </div>
    <a href="{{ route('users.index') }}" class="small-box-footer">More info </a>
    </div>
</div>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
    <div class="inner text-center">
        <h3>{{ $suppliers->count() }}</h3>

        <p>Suppliers/Clients ( الزباين/الموردين )</p>

    </div>
    <a href="{{ route('suppliers.index') }}" class="small-box-footer">More info </a>
    </div>
</div>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
    <div class="inner text-center">
        <h3>{{ $products->count() }}</h3>

        <p>Products ( الاصناف )</p>

    </div>
    <a href="{{ route('products.index') }}" class="small-box-footer">More info </a>
    </div>
</div>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
    <div class="inner text-center">
        <h3>{{ $purchaseInvoice->count() }}</h3>

        <p>Purchase Invoices ( فواتير المشتريات )</p>

    </div>
    <a href="{{ route('purchaseInvoice.index') }}" class="small-box-footer">More info </a>
    </div>
</div>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-black">
    <div class="inner text-center">
        <h3>{{ $sellInvoice->count() }}</h3>

        <p> Sell Invoices ( فواتير المبيعات )</p>

    </div>
    <a href="{{ route('sellInvoice.index') }}" class="small-box-footer">More info </a>
    </div>
</div>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
    <div class="inner text-center">
        <h3>{{ round($box->totl_value,5) }}</h3>

        <p> Box ( اجمالي المبلغ بالصندوق  )</p>

    </div>
    <a href="{{ route('boxes.index') }}" class="small-box-footer">More info </a>
    </div>
</div>

<div class="col-lg-12 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-red">
    <div class="inner text-center">
        <h3>{{ $totalAlert }}</h3>

        <p> Alert ( النواقص بالمخزن  )</p>

    </div>
    <a href="{{ route('products.index') }}" class="small-box-footer">More info </a>
    </div>
</div>

<div class="col-lg-12 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
    <div class="inner text-center">
        <h3>{{ round($totalGard,5) }} LE</h3>

        <p> Total ( اجمالي  جرد المخزن بالسعر التجاري  ) </p>

    </div>
    <a href="#" class="small-box-footer">No More info </a>
    </div>
</div>

<div class="col-lg-12 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-black">
    <div class="inner text-center">
        <h3>{{ round($todayTotalGain,5) }} LE</h3>

        <p> Total Gain Today ( اجمالي الربح اليوم  ) </p>

    </div>
    <a href="#" class="small-box-footer">No More info </a>
    </div>
</div>

</div>
@else
 <h1> Not Permitied ( ليس لديك الصلاحيات لرؤية هذا المحتوي ) </h1>
@endif
@endsection
