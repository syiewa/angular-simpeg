<?php

class PenghargaanController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
//    protected $layout = 'backend.layouts.index';

    public function index() {
        //
        $data = array(
            'field' => Penghargaan::getColumn(),
            'values' => Penghargaan::orderBy('nama_penghargaan')->get()
        );
        return Response::json($data);
    }

    public function getPenghargaan() {
        // data array yang menampung data berupa nama field tabel dan values dari tabel.
        $data = array(
            'field' => Penghargaan::getColumn(),
            'values' => Penghargaan::get()
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
        // membuat object baru dari Penghargaan() dengan input nama_penghargaan
        $penghargaan = new Penghargaan();
        $penghargaan->nama_penghargaan = Input::get('nama_penghargaan');
        // bila proses memasukan data berhasil maka akan mengirimkan response dalam bentuk json
        if ($penghargaan->save()) {
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
        $penghargaan = Penghargaan::find($id);
        return Response::json($penghargaan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
        $penghargaan = Penghargaan::find($id);
        $penghargaan->nama_penghargaan = Input::get('nama_penghargaan');
        if ($penghargaan->save()) {
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
        $penghargaan = Penghargaan::find($id);
        if ($penghargaan->delete()) {
            return Response::json(array('success' => TRUE));
        }
    }

}
