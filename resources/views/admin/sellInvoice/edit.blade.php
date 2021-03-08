@if( is_permited('sellInvoice','edit') == 1 ) 

@extends('admin.shared.master')
@section('content')
  <!-- Modal Edit -->
        <div class="modal-content">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Edit {{ $buttonsRoutsname }} ( تعديل بيانات الفاتورة )</h3>
              </div>
              <form method="POST" action="{{route('sellInvoice.update',$row->id)}}" class="form-horizontal" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('put') }}
              @include('admin.'.$buttonsRoutsname.'.components.EditFormComponent')
              </form>  
                
                <!-- /.box-footer -->
              
            </div>
            <!-- /.box -->
        </div>
    <!-- End of Modal Edit -->
@endsection
@else
{{ dd('not Permitied ( ليس لديك الصلاحيات لرؤية هذا المحتوي )') }}
@endif