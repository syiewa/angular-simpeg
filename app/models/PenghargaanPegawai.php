<?php

class PenghargaanPegawai extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_data_penghargaan';
    protected $primaryKey = 'id_penghargaan';
    protected $fillable = array('id_pegawai', 'id_master_penghargaan', 'uraian', 'nomor_sk','tanggal_sk');
    public $timestamps = false;
    protected $appends = ['nama_penghargaan'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function pegawai() {
        return $this->belongsTo('pegawai', 'id_pegawai');
    }

    public function getNamaPenghargaanAttribute() {
        $value = $this->attributes['id_master_penghargaan'];
        $data = Penghargaan::find($value);
        if ($data) {
            return $data->nama_penghargaan;
        }
        return '-';
    }


    public function scopeDropdownRiwayatPangkat($query) {
        $data = array();
        $jabatan = $query->select(array('id_riwayat_jabatan', 'nama_anggota_riwayat_jabatan'))->get();
        if (count($jabatan) > 0) {
            foreach ($jabatan as $ese) {
                $data[] = array('id' => $ese->id_jabatan, 'label' => $ese->nama_jabatan);
            }
        }
        return $data;
    }

    public function getTanggalSkAttribute($value) {
        if ($value == '') {
            return $value;
        }
        return date('d/m/Y', strtotime($value));
    }

    public function setTanggalSkAttribute($value) {
        if ($value == '') {
            $this->attributes['tanggal_sk'] = $value;
        } else {
            $this->attributes['tanggal_sk'] = date('Y-m-d', strtotime($value));
        }
    }

    public function scopeGetColumn() {
        $data = array();
        $columns = DB::table('information_schema.columns')
                ->select('COLUMN_NAME')
                ->where('table_name', $this->table)
                ->where('column_key', '!=', 'PRI')
                ->get();
        foreach ($columns as $col) {
            $data[] = $col->COLUMN_NAME;
        }
        return $data;
    }

}
