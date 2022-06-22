<?php
namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Validator;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller = Order::orderBy('time', 'DESC')->get();
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
            'id_product'   => ['required','numeric'],
            'id_seller'       => ['required','numeric'],
            'id_delivery'       => ['required','numeric'],
            'id_transactions'       => ['required','numeric'],
            'buyer_name'       => ['required'],
            'buyer_address'       => ['required'],
            'contact'       => ['required'],
            'city'       => ['required'],
            'postalcode'       => ['required'],
            'status_payment'       => ['required','in:paid,unpaid'],
            'status_delivery'       => ['required','in:delivered,onprocess'],

        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $seller = Order::create($request->all());
            $response = [
                'code' => "200",
                'message' => 'Order Created',
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


        $seller = Order::findOrFail($id);
        $response = [
            'code' => "200",
            'message' => 'Detail or Order Resource',
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
        $seller = Order::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'id_product'   => ['numeric'],
            'id_seller'       => ['numeric'],
            'id_delivery'       => ['numeric'],
            'id_transactions'       => ['numeric'],
            'buyer_name'       => [],
            'buyer_address'       => [],
            'contact'       => [],
            'city'       => [],
            'postalcode'       => [],
            'status_payment'       => ['in:paid,unpaid'],
            'status_delivery'       => ['in:delivered,onprocess'],
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $seller->update($request->all());
            $response = [
                'code' => "200",
                'message' => 'Order updated',
                'data' => $seller
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QuearyException $e) {
            return response()->json([
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
        $seller = Order::findOrFail($id);
        try {
            $seller->delete();
            $response = [
                'code' => "200",
                'message' => 'Success deleted',
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QuearyException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }

                
    }
}
