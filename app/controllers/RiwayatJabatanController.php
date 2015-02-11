<?php

class RiwayatJabatanController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        //
        $data = array(
            'field' => array('nama_status', 'penempatan', 'nama_jabatan', 'nama_unit_kerja', 'nama_eselon'),
            'values' => RiwayatJabatan::orderBy('status')->where('id_pegawai', '=', $id)->get()
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
            'jabatan' => Jabatan::DropdownJabatan(),
            'unitkerja' => UnitKerja::DropdownUnit(),
            'lokasikerja' => LokasiKerja::DropdownLokasiKerja(),
            'eselon' => Eselon::DropdownEselon(),
            'statusjabatan' => StatusJabatan::DropdownStatusJabatan()
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
        $data['tanggal_mulai'] = formatDate($data['tanggal_mulai']);
        $data['tanggal_selesai'] = formatDate($data['tanggal_selesai']);
        $riwayat = new RiwayatJabatan($data);
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
        $riwayat = RiwayatJabatan::find($id);
        return Response::json($riwayat);
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
        $riwayat = RiwayatJabatan::find($id);
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
        $riwayat = RiwayatJabatan::find($id);
        if ($riwayat->delete()) {
            return Response::json(array('success' => TRUE));
        }
    }

}
