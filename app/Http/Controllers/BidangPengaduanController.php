<?php

namespace App\Http\Controllers;

use App\Models\BidangPengaduan;
use Illuminate\Http\Request;

class BidangPengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bidang = BidangPengaduan::all();

        return view('admin.bidangPengaduan.index', ['bidang' => $bidang]);
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
        // $data = new BidangPengaduan;
        // $data->name = $request->name;

        // $data->save();

        BidangPengaduan::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BidangPengaduan  $bidangPengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(BidangPengaduan $bidangPengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BidangPengaduan  $bidangPengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bidang = BidangPengaduan::find($id);

        return view('admin.bidangPengaduan.form-ubah', ['bidang' => $bidang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BidangPengaduan  $bidangPengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validation($request);
        // BidangPengaduan::where('id',$id)->update(['name' => $request->name]);
        // notify()->success("Success notification test", "Success", "topRight");
        // return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BidangPengaduan  $bidangPengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = BidangPengaduan::find($id);
        $users->delete();
        notify()->success("Success notification test", "Success", "topRight");
        return back();
    }
}
