<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function import(Request $request){
        $file = $request->file('file');
    $fileContents = file($file->getPathname());

    foreach ($fileContents as $key => $value) {
        
        if($key){
            $data = str_getcsv($value);
            Product::create([
                'first_name' => $data[2],
                'last_name' => $data[3],
                'company' => $data[4],
                'city' => $data[5],
                'country' => $data[6],
                'email' => $data[9],
                'subscription_date' => $data[10],
            ]);

        }
    }

    return redirect()->back()->with('success', 'CSV file imported successfully.');
    }
    public function export()
    {
        $products = Product::all();
        $csvFileName = 'products.csv';

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Full Name', 'Country']); // Add more headers as needed

        foreach ($products as $product) {
            fputcsv($handle, [$product->first_name.'-'.$product->last_name, $product->country]); // Add more fields as needed
        }

        fclose($handle);

        return response('', 200)->header('Content-Type','text/csv')->header( 'Content-Disposition','attachment; filename="' . $csvFileName . '"');
    }
}
