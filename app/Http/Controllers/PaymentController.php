<?php
namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;
use Validator;
use Symfony\Component\HttpFoundation\Response;

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
            'nominal_payment'       => ['required','numeric'],
            'status_payment'          =>['required','in:paid,unpaid'],

        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $seller = Payment::create($request->all());
            $response = [
                'message' => 'Payment Created',
                'data' => $seller
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
            'id_orders'   => ['numeric'],
            'nominal_payment'       => ['numeric'],
            'status_payment'          =>['in:paid,unpaid'],
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $seller->update($request->all());
            $response = [
                'message' => 'Payment updated',
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
        $seller = Payment::findOrFail($id);
        try {
            $seller->delete();
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
