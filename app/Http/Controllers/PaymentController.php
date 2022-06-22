<?php
namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;

class PaymentController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller = Payment::orderBy('time', 'DESC')->get();
        $response = [
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
            'id_orders'         => ['numeric'],
            'price'       => ['required','numeric'],
            'delivery_fee'       => ['required','numeric'],
            'status_payment'          =>['required','in:paid,unpaid'],

        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $deliveryfee = $request -> input('delivery_fee');
        $price = $request -> input('price');
        $nominal = $deliveryfee + $price;
        $seller = Payment::create([
            'id_orders'         => $request->input('id_orders'),
            'price'       =>  $price,
            'delivery_fee'       => $deliveryfee,
            'status_payment'          =>$request->input('status_payment'),
            'nominal' => $nominal
        ]);
        if ($seller) {
            return response()->json([
                'success' => true,
                'message' => 'Payment Created',
                'data' => $seller,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed' 
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


        $seller = Payment::findOrFail($id);
        $response = [
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
        $seller = Payment::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'id_orders'         => ['numeric'],
            'price'       => ['required','numeric'],
            'delivery_fee'       => ['required','numeric'],
            'status_payment'          =>['required','in:paid,unpaid'],
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $deliveryfee = $request -> input('delivery_fee');
        $price = $request -> input('price');
        $nominal = $deliveryfee + $price;
        $seller->update([
            'id_orders'         => $request->input('id_orders'),
            'price'       =>  $price,
            'delivery_fee'       => $deliveryfee,
            'status_payment'          =>$request->input('status_payment'),
            'nominal' => $nominal
        ]);

        if ($seller) {
            return response()->json([
                'success' => true,
                'message' => 'Payment Updated',
                'data' => $seller,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed' 
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
        $seller = Payment::findOrFail($id);
        try {
            $seller->delete();
            $response = [
                'message' => 'Success deleted',
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }

                
    }
}
