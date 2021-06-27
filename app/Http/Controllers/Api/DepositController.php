<?php

namespace App\Http\Controllers\Api;

use App\Deposit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{

    public function deposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rekening_tujuan'   => 'required|string|max:50',
            'rekening_asal'     => 'required|string|max:50',
            'jumlah'            => 'required|integer',
            'catatan'           => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $deposit = Deposit::create([
            'rekening_tujuan'  => $request->get('rekening_tujuan'),
            'rekening_asal'    => $request->get('rekening_asal'),
            'jumlah'           => $request->get('jumlah'),
            'catatan'          => $request->get('catatan'),
        ]);

        return response()->json([
            'message' => 'The deposit has been sent',
            'Data'    => $deposit
        ]);
    }

    public function depositMember()
    {
        $data = Deposit::orderBy('created_at', 'desc')->get();
        if ($data != null) {
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message'   => 'no data found'
            ]);
        }
    }
}
