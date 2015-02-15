<?php

class HukumanPegawaiController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        //
        $data = array(
            'field' => array('nama_hukuman', 'nomor_sk', 'tanggal_sk','tanggal_mulai', 'tanggal_selesai','masa_berlaku'),
            'values' => HukumanPegawai::orderBy('id_master_hukuman')->where('id_pegawai', '=', $id)->get()
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
            'hukuman' => Hukuman::DropdownHukuman(),
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
        $diff = getDateDiff($data['tanggal_mulai'], $data['tanggal_selesai']);
        if ($diff->y > 0) {
            $data['masa_berlaku'] = $diff->y . ' Tahun ' . $diff->m . ' Bulan';
        }
        $riwayat = new HukumanPegawai($data);
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
        $riwayat = HukumanPegawai::find($id);
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
        $riwayat = HukumanPegawai::find($id);
        $diff = getDateDiff($data['tanggal_mulai'], $data['tanggal_selesai']);
        if ($diff->y > 0) {
            $data['masa_berlaku'] = $diff->y . ' Tahun ' . $diff->m . ' Bulan';
        }
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
        $riwayat = HukumanPegawai::find($id);
        if ($riwayat->delete()) {
            return Response::json(array('success' => TRUE));
        }
    }

}
