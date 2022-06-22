<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller = Product::orderBy('time', 'DESC')->get();
        $response = [
            'code' => "200",
            'message' => 'Your request has been processed successfully',
            'data' => $seller 
        ];

        return response()->json($response, Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_seller'   => ['required','numeric'],
            'product_name'       => ['required'],
            'product_total'         => ['required','numeric'],
            'product_price'      => ['required','numeric'],
            'availablity'          =>['required','in:ready,sold'],


        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $seller = Product::create($request->all());
            $response = [
                'code' => "200",
                'message' => 'Product Created',
                'data' => $seller
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QuearyException $e) {
            return response()->json([
                'code' => "400",
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $seller = Product::findOrFail($id);
        $response = [
            'code' => "200",
            'message' => 'Detail or Data Resource',
            'data' => $seller
        ];

        return response()->json($response, Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seller = Product::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'id_seller'   => ['numeric'],
            'product_name'       => [],
            'product_total'         => ['numeric'],
            'product_price'      => ['numeric'],
            'availablity'          =>['required','in:ready, sold'],
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $seller->update($request->all());
            $response = [
                'code' => "200",
                'message' => 'Product updated',
                'data' => $seller
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QuearyException $e) {
            return response()->json([
                'code' => "400",
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seller = Product::findOrFail($id);
        try {
            $seller->delete();
            $response = [
                'code' => "200",
                'message' => 'Success deleted',
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QuearyException $e) {
            return response()->json([
                'code' => "400",
                'message' => "Failed" . $e->errorInfo
            ]);
        }

                
    }
}
