<?php

class StatusPegawaiController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
//    protected $layout = 'backend.layouts.index';

    public function index() {
        //
        $data = array(
            'field' => StatusPegawai::getColumn(),
            'values' => StatusPegawai::orderBy('nama_status')->get()
        );
        return Response::json($data);
    }

    public function getStatusPegawai() {
        // data array yang menampung data berupa nama field tabel dan values dari tabel.
        $data = array(
            'field' => StatusPegawai::getColumn(),
            'values' => StatusPegawai::get()
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
        // membuat object baru dari StatusPegawai() dengan input nama_status
        $statuspegawai = new StatusPegawai();
        $statuspegawai->nama_status = Input::get('nama_status');
        // bila proses memasukan data berhasil maka akan mengirimkan response dalam bentuk json
        if ($statuspegawai->save()) {
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
        $statuspegawai = StatusPegawai::find($id);
        return Response::json($statuspegawai);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
        $statuspegawai = StatusPegawai::find($id);
        $statuspegawai->nama_status = Input::get('nama_status');
        if ($statuspegawai->save()) {
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
        $statuspegawai = StatusPegawai::find($id);
        if ($statuspegawai->delete()) {
            return Response::json(array('success' => TRUE));
        }
    }

}
