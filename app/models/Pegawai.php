<?php

class Pegawai extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_data_pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $fillable = array("nip", "nip_lama", "no_kartu_pegawai", "nama_pegawai", "jenis_kelamin", "agama", "status_pegawai", "tempat_lahir", "tanggal_lahir", "usia", "no_npwp", "kartu_askes_pegawai", "tanggal_pengangkatan_cpns", "alamat", "id_golongan", "nomor_sk_pangkat", "tanggal_sk_pangkat", "tanggal_mulai_pangkat", "tanggal_selesai_pangkat", "id_status_jabatan", "id_unit_kerja", "id_jabatan", "id_satuan_kerja", "lokasi_kerja", "id_eselon", "foto");
    protected $appends = ['golongan', 'nama_status_pegawai'];
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function keluarga() {
        return $this->hasMany('keluarga', 'id_pegawai');
    }

    public function riwayatpangkat() {
        return $this->hasMany('riwayatpangkat', 'id_pegawai');
    }

    public function getGolonganAttribute() {
        $name = $this->attributes['id_golongan'];
        $data = Golongan::find($name);
        if ($data) {
            return $data->golongan;
        }
        return '-';
    }

    public function getNamaStatusPegawaiAttribute() {
        $name = $this->attributes['status_pegawai'];
        $data = StatusPegawai::find($name);
        if ($data) {
            return $data->nama_status;
        }
        return '-';
    }

    public function scopePegawaiDataTable($query) {
        return Pegawai::leftJoin('tbl_master_golongan', 'tbl_data_pegawai.id_golongan', '=', 'tbl_master_golongan.id_golongan')
                        ->leftJoin('tbl_master_status_pegawai', 'tbl_data_pegawai.status_pegawai', '=', 'tbl_master_status_pegawai.id_status_pegawai')
                        ->select(array('tbl_data_pegawai.nip', 'tbl_data_pegawai.nama_pegawai', 'tbl_master_golongan.golongan', 'tbl_master_status_pegawai.nama_status'));
    }

}
