<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BackEndController;
use App\models\Category;
use App\Http\Requests\BackEnd\Category\Store as CategoryStore;
use App\models\InvoiceProducts;
use App\models\Invoice;
use App\models\Product;
class Categories extends BackEndController
{
    public function __construct(Category $model){
       return Parent::__construct($model);
    }

    public function store(CategoryStore $request)
    {
        $row = $this->model;
        
        if($row->create($request->toArray())){
            swal()->button('Close Me')->message('تم','تمت عملية الاضافة بنجاح','info'); 
         }else{
            swal()->button('Close Me')->message('Sorry !!','Your Process Faild !!','info'); 
         }
        return redirect()->back();
       
    }

    public function show($id)
    {
        //
    }


    public function update(CategoryStore $request,$id)
    {
        $row = $this->model->findOrFail($id);

        if($row->update($request->toArray())){
            swal()->button('Close Me')->message('تم','تمت عملية التعديل بنجاح','info'); 
         }else{
            swal()->button('Close Me')->message('Sorry !!','Your Process Faild !!','info'); 
         }
        return redirect()->back();
    }

    protected function filter($rows,$filterData){
        foreach($filterData as $key => $value){
          if($value !=""){
            $rows = $rows->where($key,'=',$value);
          }
        }
        return $rows;
    }

    public function income(Request $request,$id){
        $rows = collect(new InvoiceProducts);
        $categoryinfo = Category::find($id);
        $filterData = $request->all();
        $invoice = Invoice::where('invoice_type','=',1);
        if(isset( $filterData['page'] ) ){
            unset($filterData['page']);
        }
        if(!empty($this->with())){
            $invoice = $invoice->with($this->with());
        }
        if(isset($filterData['datefrom']) && isset($filterData['dateto'])){
            $invoice = $invoice->whereBetween('date',[$filterData['datefrom'], $filterData['dateto']]);
        }
        if(isset($filterData['datefrom']) ){
            $invoice = $invoice->where('date','>=',$filterData['datefrom']);
        }
        if(isset($filterData['dateto']) ){
            $invoice = $invoice->where('date','<=',$filterData['dateto']);
        }

        if( !isset($filterData['datefrom']) && !isset($filterData['dateto'])){
            $invoice = $invoice->where('date','=',date('Y-m-d'));
        }

        $invoice = $invoice->orderBy('id','desc')->get();
        if($invoice->count() > 0){
            $products = collect(new Product);
            $uniqproducts = [];
            foreach($invoice as $invoicepro){
                foreach($invoicepro->getInvoiceProducts as $invoiceproduct){
                    if(!in_array($invoiceproduct->getProduct->id , $uniqproducts)) {
                        if ($invoiceproduct->getProduct->category_id == $id) {
                            $rows = $rows->push($invoiceproduct);
                            array_push($uniqproducts, $invoiceproduct->getProduct->id);
                        }
                    }else{
                        $lastToPrice = $rows->where('product_id','=',$invoiceproduct->getProduct->id)->first()['total_price'];
                        $lastquantity = $rows->where('product_id','=',$invoiceproduct->getProduct->id)->first()['quantity'];

                        $rows->where('product_id','=',$invoiceproduct->getProduct->id)->first()['quantity'] = $lastquantity + $invoiceproduct->quantity;
                        $rows->where('product_id','=',$invoiceproduct->getProduct->id)->first()['total_price'] = $lastToPrice + $invoiceproduct->total_price;

                    }
              }
            }
        }


        $PageTitle = "Income ( ايرادات قسم : ".$categoryinfo->name.")";

        $headerLevelProcessTitle1 = "Income (الايرادات )";
        $headerLevelProcessTitle2 = "All ( الكل )";
        $buttonsRoutsname = $modelViewName = "categories";
        $catid = $id;
        return View('admin.categories.income',compact('catid','filterData','buttonsRoutsname','rows','PageTitle','headerLevelProcessTitle1','headerLevelProcessTitle2'));
    }

}

