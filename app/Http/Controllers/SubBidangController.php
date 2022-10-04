<?php

namespace App\Http\Controllers;

use App\Models\SubBidang;
use Illuminate\Http\Request;

class SubBidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subBidang = SubBidang::all();

        return view('admin.subBidang.index', ['subBidang' => $subBidang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SubBidang::create($request->all());

        notify()->success("Success notification test", "Success", "topRight");

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubBidang  $subBidang
     * @return \Illuminate\Http\Response
     */
    public function show(SubBidang $subBidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubBidang  $subBidang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subBidang = SubBidang::find($id);

        return view('admin.subBidang.form-ubah', ['subBidang' => $subBidang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubBidang  $subBidang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subBidang = SubBidang::where('id', $id)->update(['nama' => $request->nama]);
        
        if($subBidang)
        {
            return response()->json(['code' => 0, 'msg' => 'Data Sub Bidang Berhasil Dihapus.']);
        }else{
            return response()->json(['code' => 1, 'msg' => 'Data Sub Bidang Gagal Dihapus.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubBidang  $subBidang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subBidang = SubBidang::find($id);
        $subBidang->delete();
        notify()->success("Data Berhasil Dihapus", "Success", "topRight");
        return back();
    }
}
