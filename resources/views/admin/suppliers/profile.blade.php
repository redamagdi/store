@extends('admin.shared.master')
@section('content')

<section class="content">

<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="{{ $supplier['name'] }} picture">

        <h3 class="profile-username text-center">{{ $supplier['name'] }}</h3>

        <p class="text-muted text-center">{{  $supplier->getType->name  }}</p>


        <a class="btn btn-primary btn-block"><b>Total Balance : <span style="color: red; font-size: 15px;"> {{ round($supplier->getBalance->first()['total_balance'],3) }} LE </span> </b></a>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </div>
  <!-- /.col -->
  <div class="col-md-9">
  <ul>
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Activity ( المعاملات النقدية ) </a></li>
        <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Add ( اضافة معاملة نقدية )</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="activity">
          <!-- table -->
          <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> <span style="color: red;"> {{ $supplier->name  }} </span> Activities </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              @if( $supplier->getBalance->count() > 0 ) 

                <thead>
                <tr>
                  <th>#</th>
                  <th>Date ( التاريخ )</th>
                  <th>Depet Type ( النوع ) </th>
                  <th>Depet Value ( القيمة )</th>
                  <th>Total Palance ( الرصيد الكلي ) </th>
                  <th>Description ( التفاصيل )</th>
                 </tr>
                </thead>
                <tbody>
                @php
                 $i = 1;
                @endphp
                @foreach($supplier->getBalance as $row)
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $row['date'] }}</td>
                  @if($row['payment_type'] == 0)
                   <td><span class="label label-danger">Depet ( سحب ) </span></td>
                  @else
                   <td><span class="label label-info">Credit ( ايداع ) </span></td>
                  @endif
                  <td>{{ round($row['depet_value'],3) }}</td>
                  <td>{{ round($row['total_balance'],3) }}</td>
                  <td>{{ $row['desc'] }}</td>
                </tr>
                @php
                 $i= $i+1;
                @endphp
               @endforeach
              </tbody>
              @else
                 <h3 class="text-center" style="color: red;"> No Activities Yet </h3>
               @endif
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
          <!-- /.table -->
        </div>

        <div class="tab-pane" id="settings">
           @if(count($errors) > 0)
             <div class="alert alert-danger text-center">
                @foreach($errors->all() as $error)
                  <P>{{ $error }}</P>
                @endforeach
              </div>
         <div></div>
                    @endif    
          <form class="form-horizontal" action="{{ route('suppliers.saveBalance') }}" method="post">
               {{ csrf_field() }}
               <input type="hidden" name="supplier_id" value="{{ $supplier->id }}" /> 
            
               <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Balance ( الرصيد ) </label>

              <div class="col-sm-10">
                <input type="number" step=any class="form-control" value="{{ old('depet_value') }}" id="inputEmail" placeholder="Balance Value" name="depet_value">
              </div>
            </div>
            
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Payment Type ( النوع )</label>

              <div class="col-sm-10">
                <select class="form-control" value="{{ old('payment_type') }}" name="payment_type">
                  <option value="0"> Depet ( سحب ) </option>
                  <option value="1"> Credet ( ايداع ) </option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label"> Date ( التاريخ )</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" value="{{ old('date') }}" id="inputName" name="date" placeholder="Date">
              </div>
            </div>

            <div class="form-group">
              <label for="inputExperience" class="col-sm-2 control-label"> Description ( التفاصيل ) </label>

              <div class="col-sm-10">
                <textarea class="form-control" id="inputExperience" placeholder="Descriptoin" name="desc">{{ old('desc') }}</textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">Save ( اضافة )</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

</section>


@endsection