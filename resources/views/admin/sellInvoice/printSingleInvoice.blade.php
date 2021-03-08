
@if( is_permited('sellInvoice','print') == 1 ) 
<html>
<head>

    <style>
        #invoice-POS{
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding:2mm;
  margin: 0 auto;
  width: 44mm;
  background: #FFF;
  
        }
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-size: 1.5em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
 
#top, #mid,#bot{ /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}

#top{min-height: 100px;}
#mid{min-height: 80px;} 
#bot{ min-height: 50px;}

#top .logo{
  //float: left;
	height: 60px;
	width: 60px;
	background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
	background-size: 60px 60px;
}
.clientlogo{
  float: left;
	height: 60px;
	width: 60px;
	background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
	background-size: 60px 60px;
  border-radius: 50px;
}
.info{
  display: block;
  //float:left;
  margin-left: 0;
}
.title{
  float: right;
}
.title p{text-align: right;} 
table{
  width: 100%;
  border-collapse: collapse;
}
td{
  //padding: 5px 0 5px 15px;
  //border: 1px solid #EEE
}
.tabletitle{
  //padding: 5px;
  font-size: .5em;
  background: #EEE;
}
.service{border-bottom: 1px solid #EEE;}
.item{width: 24mm;}
.itemtext{font-size: .5em;}

#legalcopy{
  margin-top: 5mm;
}

@page {
  size: auto;
  margin: 0;
       }

    </style>
</head>
<body onload="window.print()">


    <div id="invoice-POS">
    
        <center id="top">
          <div class="logo"></div>
          <div class="info"> 
            <h2>ICE CREAM</h2>
          </div><!--End Info-->

        
        <div id="bot">
    
                        <div id="table">
                            <table>
                                <tr class="tabletitle">
                                    <td class="item"><h2>القسم</h2></td>
                                    <td class="item"><h2>المنتج</h2></td>
                                    <td class="Hours"><h2>الكمية</h2></td>
                                    <td class="Hours"><h2>سعر الوحدة</h2></td>
                                    <td class="Rate"><h2>الاجمالي</h2></td>
                                </tr>

                                  @php
                                   $i = 1;
                                 @endphp
                                 @foreach($row->getInvoiceProducts as $inPro)
    
                                    <tr class="service">
                                        <td class="tableitem"><p class="itemtext">{{ $inPro->getProduct->getCategory->name }}</p></td>
                                        <td class="tableitem"><p class="itemtext">{{ $inPro->getProduct->name }}</p></td>
                                        <td class="tableitem"><p class="itemtext">{{ round($inPro->quantity,3) }}</p></td>
                                        <td class="tableitem"><p class="itemtext">{{ round($inPro->sell_price,3) }}</p></td>
                                        <td class="tableitem"><p class="itemtext">{{ round($inPro->total_price,3) }}</p></td>
                                    </tr>
                                    @php
                                    $i = $i + 1;
                                   @endphp
                                   @endforeach
                            
                               
                                <tr class="tabletitle">
                                    <td></td>
                                    <td class="Rate"><h2>الاجمالي </h2></td>
                                    <td class="payment"><h2>{{ round($row->total_value,5) }} LE</h2></td>
                                </tr>
    
                            </table>
                        </div><!--End Table-->
    
                        <div id="legalcopy">
                            <p class="legal"><strong>شكرا لك لزيارة محل ايس كريم</strong>  فاتورة مشتريات فورية. 
                            </p>
                        </div>
    
                    </div><!--End InvoiceBot-->
      </div><!--End Invoice-->


</html>
@else
{{ dd('not Permitied ( ليس لديك الصلاحيات لرؤية هذا المحتوي )') }}
@endif