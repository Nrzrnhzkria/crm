<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Product;
use App\Package;
use App\Feature;
use App\Offer;
use App\Collection_id;
use validator;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ProductController
    |--------------------------------------------------------------------------
    |   This controller is for managing event details
    | 
    */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /*-- Product -------------------------------------------------------------*/

    public function viewproduct()
    {
        $offers = Offer::orderBy('id','desc')->get();
        $product = Product::orderBy('id','desc')->paginate(15);
        
        return view('admin.viewproduct', compact('offers', 'product'));
    }

    public function create()
    {
        $offers = Offer::orderBy('id','asc')->get();
        $count = 1;

        return view('admin.addproduct', compact('offers', 'count'));
    }

    public function store(Request $request)
    {
        $product = Product::orderBy('id','desc')->first();

        $auto_inc_prd = $product->id + 1;
        $productId = 'PRD' . 0 . 0 . $auto_inc_prd;

        $check_image = $request->cert_image;
        
        if($check_image == null){
            Product::create([
                'product_id' => $productId,
                'name' => $request->prodname,
                // 'description' => $request->description,
                'date_from' => $request->date1,
                'date_to' => $request->date2,
                'time_from' => $request->time1,
                'time_to' => $request->time2,
                'offer_id' => $request->offer_id,
                'collection_id' => $request->collection_id,
                'survey_form' => $request->survey_form,
                'status' => $request->status,
                'zoom_link' => $request->zoom_link,
                'tq_page' => $request->tq_page,
                'status' => $request->status
            ]);

        } else {

            $imagename = 'img_' . uniqid().'.'.$request->cert_image->extension();
            $cert_image = 'https://mims.momentuminternet.my/assets/images/certificate/' . $imagename;
            $request->cert_image->move(public_path('assets/images/certificate'), $imagename);

            Product::create([
                'product_id' => $productId,
                'name' => $request->prodname,
                // 'description' => $request->description,
                'date_from' => $request->date1,
                'date_to' => $request->date2,
                'time_from' => $request->time1,
                'time_to' => $request->time2,
                'cert_image' => $cert_image,
                'offer_id' => $request->offer_id,
                'collection_id' => $request->collection_id,
                'survey_form' => $request->survey_form,
                'status' => $request->status,
                'zoom_link' => $request->zoom_link,
                'tq_page' => $request->tq_page,
                'status' => $request->status
            ]);
        }

        return redirect('addpackage'.'/'.$productId)->with('success', 'Event Successfully Created');
    }
    
    public function edit($id)
    {
        $product = Product::where('product_id', $id)->first();
        $offers = Offer::orderBy('id','asc')->get();
        $count = 1;

        return view('admin/updateproduct', compact('product', 'offers', 'count'));        
    }

    public function update($id, Request $request)
    {
        $product = Product::where('product_id', $id)->first();    
        $check_image = $request->hasFile('cert_image');
        
        if($check_image == false){

            $product->name = $request->prodname;
            $product->date_from = $request->date1;
            $product->date_to = $request->date2;
            $product->time_from = $request->time1;
            $product->time_to = $request->time2;
            $product->offer_id = $request->offer_id;
            $product->collection_id = $request->collection_id;
            $product->survey_form = $request->survey_form;
            $product->tq_page = $request->tq_page;
            $product->status = $request->status;
            $product->save();

        } else {

            if($request->hasFile('cert_image'))
            {
                $imagename = 'img_' . uniqid().'.'.$request->cert_image->extension();
                $cert_image = 'https://mims.momentuminternet.my/assets/images/certificate/' . $imagename;
                $request->cert_image->move(public_path('assets/images/certificate'), $imagename);
            }

            $product->name = $request->prodname;
            // $product->description = $request->description;
            $product->date_from = $request->date1;
            $product->date_to = $request->date2;
            $product->time_from = $request->time1;
            $product->time_to = $request->time2;
            $product->offer_id = $request->offer_id;
            $product->collection_id = $request->collection_id;
            $product->survey_form = $request->survey_form;
            $product->tq_page = $request->tq_page;
            $product->status = $request->status;

            if($request->hasFile('cert_image'))
            {
                $product->cert_image = $cert_image;
            }

            $product->save();
        }

        return redirect('product')->with('updatesuccess', 'Event Successfully Updated');
    }

    public function destroy($id)
    {
        $feature = Feature::where('product_id', $id);
        $product = Product::where('product_id', $id);
        $package = Package::where('product_id', $id);

        $product->delete();
        $package->delete();
        $feature->delete();

        return back()->with('delete', 'Event Successfully Deleted');
    }

    /*-- Package -------------------------------------------------------------*/
    public function view($id)
    {
        $product = Product::where('product_id', $id)->first();
        $package = Package::where('product_id', $id)->paginate(15);
            
        $link = 'https://mims.momentuminternet.my/pendaftaran/'. $product->product_id . '/';
        
        return view('admin/viewpackage', compact('product', 'package', 'link'));   
    }
    
    public function pack($id)
    {
        $product = Product::where('product_id', $id)->first();
        return view('admin.addpackage', compact('product'));
    }

    public function storepack($id, Request $request)
    {
        $package = Package::orderBy('id','desc')->first();
        $feature = Feature::orderBy('id','desc')->first();

        $auto_inc_pkd = $package->id + 1;
        $packageId = 'PKD' . 0 . 0 . $auto_inc_pkd;
              
        // $imagename = 'img_' . uniqid().'.'.$request->package_image->extension();
        // $request->package_image->move(public_path('assets/images/packages'), $imagename);

        Package::create(array(

            'package_id'=> $packageId,
            'name' => $request->name,
            'price'=> $request->price,
            'product_id'=> $id

        ));  

        foreach($request->feature as $keys => $values) {

            
            $featureId = 'FID' . uniqid();
                    
           Feature::create(array(
                'feat_id'=> $featureId,
                'name'=> $values,
                'product_id'=> $id,
                'package_id'=> $packageId
            ));
        }

        return redirect('package/'.$id)->with('success', 'Package Successfully Created'); 
    }

    public function viewpack($id)
    {
        $feature = Feature::where('package_id', $id)->get();
        $package = Package::where('package_id', $id)->get();
        
        return view('package', compact('feature', 'package'));
    }
        
    public function editpack($id, $productId)
    {
        $product = Product::where('product_id', $productId)->first();
        $package = Package::where('package_id', $id)->first();
        $feature = Feature::where('package_id', $id)->get();

        return view('admin/updatepackage', compact('product', 'package', 'feature'));        
    }

    public function updatepack($packageId, $productId, Request $request){

        $product = Product::where('product_id', $productId)->first();
        $package = Package::where('package_id', $packageId)->first();    
        
        // if($request->hasFile('package_image'))
        // {
        //     $imagename = 'img_' . uniqid().'.'.$request->package_image->extension();
        //     $request->package_image->move(public_path('assets/images/packages'), $imagename);
        // }

        $package->name = $request->name;
        $package->price = $request->price;

        // if($request->hasFile('package_image'))
        // {
        //     $package->package_image = $imagename;
        // }

        $package->save();

        foreach($request->feature as $key => $value)
        {
            $feature = Feature::where('package_id', $packageId)->where('feat_id', $request->feat_id[$key])->first();
            $feature->name = $value;
            $feature->save();
        }

        if ($request->features == null)
        {

        }else{

            foreach($request->features as $keys => $values) 
            {        
                $feature = Feature::orderBy('id','desc')->first(); 
                
                $featureId = 'FID' . uniqid();

                Feature::create(array(
                    'feat_id'=> $featureId,
                    'name'=> $values,
                    'product_id'=> $productId,
                    'package_id'=> $packageId
                ));
            }
        }

        return redirect('package/'.$productId)->with('updatesuccess','Package Successfully Updated!');
    }
    
    public function destroypack($packageId)
    {
        $feature = Feature::where('package_id', $packageId);
        $package = Package::where('package_id', $packageId);

        $package->delete();
        $feature->delete();
        return back()->with('delete','Package Successfully Deleted!');
    }

    
    /*-- Collection ID -------------------------------------------------------------*/
    public function collection_id()
    {
        $billplz = Collection_id::orderBy('id','desc')->paginate(10);

        return view('admin.collection_id', compact('billplz'));
    }

    public function new_collection(Request $request)
    {
        $billplz = Collection_id::orderBy('id','desc')->first();
    
        Collection_id::create([
            'collection_id' => $request->collection_id,
            'name' => $request->name
        ]);

        return redirect('collection-id')->with('add-success', 'Collection ID Successfully Created');
    }

    public function update_collection($collection_id, Request $request)
    {
        $billplz = Collection_id::where('collection_id', $collection_id)->first();

        $billplz->collection_id = $request->collection_id;
        $billplz->name = $request->name;
        $billplz->save();

        return redirect('collection-id')->with('update-success', 'Collection ID Successfully Updated'); 
    }

    public function delete_collection($collection_id)
    {
        $billplz = Collection_id::where('collection_id', $collection_id);
        $billplz->delete();

        return back()->with('delete', 'Collection ID Successfully Deleted');
    }

}
