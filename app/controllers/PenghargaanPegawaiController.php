<?php

class PenghargaanPegawaiController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        //
        $data = array(
            'field' => array('nama_penghargaan', 'nomor_sk', 'tanggal_sk'),
            'values' => PenghargaanPegawai::where('id_pegawai', '=', $id)->get()
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
        $data = array(
            'penghargaan' => Penghargaan::DropdownPenghargaan(),
        );
        return Response::json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
        $data = Input::All();
        $data['tanggal_sk'] = formatDate($data['tanggal_sk']);
        $riwayat = new PenghargaanPegawai($data);
        if ($riwayat->save()) {
            return Response::json(array('success' => true));
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
        $data = PenghargaanPegawai::find($id);
        return Response::json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
        $data = Input::All();
        $riwayat = PenghargaanPegawai::find($id);
        if ($riwayat->update($data)) {
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
        $data = Input::All();
        $riwayat = PenghargaanPegawai::find($id);
        if ($riwayat->delete()) {
            return Response::json(array('success' => TRUE));
        }
    }

}
