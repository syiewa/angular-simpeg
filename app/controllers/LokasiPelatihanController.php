<?php

class LokasiPelatihanController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
//    protected $layout = 'backend.layouts.index';

    public function index() {
        //
        $data = array(
            'field' => LokasiPelatihan::getColumn(),
            'values' => LokasiPelatihan::orderBy('nama_lokasi')->get()
        );
        return Response::json($data);
    }

    public function getLokasiPelatihan() {
        // data array yang menampung data berupa nama field tabel dan values dari tabel.
        $data = array(
            'field' => LokasiPelatihan::getColumn(),
            'values' => LokasiPelatihan::get()
        );
        return Response::json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        // membuat object baru dari LokasiPelatihan() dengan input nama_lokasi_pelatihan
        $lokasi_pelatihan = new LokasiPelatihan();
        $lokasi_pelatihan->nama_lokasi_pelatihan = Input::get('nama_lokasi_pelatihan');
        // bila proses memasukan data berhasil maka akan mengirimkan response dalam bentuk json
        if ($lokasi_pelatihan->save()) {
            return Response::json(array('success' => TRUE));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
        $lokasi_pelatihan = LokasiPelatihan::find($id);
        return Response::json($lokasi_pelatihan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
        $lokasi_pelatihan = LokasiPelatihan::find($id);
        $lokasi_pelatihan->nama_lokasi_pelatihan = Input::get('nama_lokasi_pelatihan');
        if ($lokasi_pelatihan->save()) {
            return Response::json(array('success' => TRUE));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        $lokasi_pelatihan = LokasiPelatihan::find($id);
        if ($lokasi_pelatihan->delete()) {
            return Response::json(array('success' => TRUE));
        }
    }

}
