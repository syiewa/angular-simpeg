<?php

class Pegawai extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_data_pegawai';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function scopePegawaiDataTable($query) {
        return Pegawai::leftJoin('tbl_master_golongan', 'tbl_data_pegawai.id_golongan', '=', 'tbl_master_golongan.id_golongan')
                ->leftJoin('tbl_master_status_pegawai', 'tbl_data_pegawai.status_pegawai', '=', 'tbl_master_status_pegawai.id_status_pegawai')
                ->select(array('tbl_data_pegawai.nip', 'tbl_data_pegawai.nama_pegawai', 'tbl_master_golongan.golongan', 'tbl_master_status_pegawai.nama_status'));
    }

}
