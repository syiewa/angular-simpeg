<?php

class PegawaiController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $data = array(
            'field' => array('nip', 'nama_pegawai', 'golongan', 'nama_status_pegawai'),
            'values' => Pegawai::orderBy('nama_pegawai')->get()
        );
        return Response::json($data);
    }

    public function getKeluarga($id = null) {
        $data = array(
            'field' => array('nama_anggota_keluarga', 'tanggal_lahir', 'status_kawin', 'pekerjaan'),
            'values' => Keluarga::orderBy('nama_anggota_keluarga')->where('id_pegawai', '=', $id)->get()
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
            'status' => StatusPegawai::DropdownStatusPegawai(),
            'golongan' => Golongan::DropdownGolongan(),
            'jabatan' => Jabatan::DropdownJabatan(),
            'unitkerja' => UnitKerja::DropdownUnit(),
            'satuankerja' => SatuanKerja::DropdownSatKer(),
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
        $destinationPath = public_path() . '/upload';
        $data = Input::except('file');
        $data['tanggal_lahir'] = formatDate($data['tanggal_lahir']);
        $data['tanggal_pengangkatan_cpns'] = formatDate($data['tanggal_pengangkatan_cpns']);
        $data["tanggal_sk_pangkat"] = formatDate($data['tanggal_sk_pangkat']);
        $data["tanggal_mulai_pangkat"] = formatDate($data['tanggal_mulai_pangkat']);
        $data["tanggal_selesai_pangkat"] = formatDate($data['tanggal_selesai_pangkat']);
        $pegawai = new Pegawai($data);
        if (Input::hasFile('file')) {
            Input::file('file')->move($destinationPath);
            $pegawai->foto = Input::file('file')->getClientOriginalName();
        }
        if ($pegawai->save()) {
            return Response::json(array('success' => TRUE));
        };
    }

    private function formatDate($array) {
        $telo = explode(' ', $array);
        $kampret = $telo[2] . ' ' . $telo[1] . ' ' . $telo[3];
        $string = date('d/m/Y', strtotime($kampret));
        return $string;
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
        $pegawai = Pegawai::find($id);
        return Response::json($pegawai);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
        $destinationPath = public_path() . '/upload';
        $data = Input::except('file');
        $pegawai = Pegawai::find($id);
        if (Input::hasFile('file')) {
            Input::file('file')->move($destinationPath);
            $pegawai->foto = Input::file('file')->getClientOriginalName();
        }
        if ($pegawai->update($data)) {
            return Response::json(array('success' => TRUE));
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        $pegawai = Pegawai::find($id);
        if ($pegawai->delete()) {
            return Response::json(array('success' => TRUE));
        }
    }

}
