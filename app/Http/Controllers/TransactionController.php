<?php

namespace App\Http\Controllers;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Validator;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transactions::orderBy('time', 'DESC')->get();
        $response = [
            'message' => 'Your request has been processed successfully',
            'data' => $transactions
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
            'seller_name'   => ['required'],
            'buyer_name'       => ['required'],
            'buyer_address'         => ['required'],
            'product_name'      => ['required'],
            'nominal_payment'      => ['required','numeric'],
            'delivery_fee'      => ['required','numeric'],
            'total_payment'      => ['required','numeric'],
            'status_payment'          =>['required','in:paid,unpaid'],


        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $transactions = Transactions::create($request->all());
            $response = [
                'message' => 'Transactions Created',
                'data' => $transactions
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QuearyException $e) {
            return response()->json([
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


        $transactions = Transactions::findOrFail($id);
        $response = [
            'message' => 'Detail or Data resource',
            'data' => $transactions
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
        $transactions = Transactions::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'seller_name'   => [],
            'buyer_name'       => [],
            'buyer_address'         => [],
            'product_name'      => [],
            'nominal_payment'      => ['numeric'],
            'delivery_fee'      => ['numeric'],
            'total_payment'      => ['numeric'],
            'status_payment'          =>['in:paid,unpaid'],
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $transactions->update($request->all());
            $response = [
                'message' => 'Transaction updated',
                'data' => $transactions
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
     * @param  int  $id_transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_transactions)
    {
        $transactions = Transactions::findOrFail($id_transactions);
        try {
            $transactions->delete();
            $response = [
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
