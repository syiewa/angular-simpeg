<?php

class PelatihanPegawai extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_data_pelatihan';
    protected $primaryKey = 'id_pelatihan';
    protected $fillable = array('id_pegawai', 'id_master_pelatihan', 'uraian', 'lokasi', 'tanggal_sertifikat', 'jam_pelatihan', 'negara');
    public $timestamps = false;
    protected $appends = ['nama_pelatihan'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function pegawai() {
        return $this->belongsTo('pegawai', 'id_pegawai');
    }

    public function getNamaPelatihanAttribute() {
        $value = $this->attributes['id_master_pelatihan'];
        $data = Pelatihan::find($value);
        if ($data) {
            return $data->nama_pelatihan;
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

    public function getTanggalSttbAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }

    public function setTanggalSttbAttribute($value) {
        $this->attributes['tanggal_sttb'] = date('Y-m-d', strtotime($value));
    }

    public function getTanggalLulusAttribute($value) {
        if ($value == '') {
            return $value;
        }
        return date('d/m/Y', strtotime($value));
    }

    public function setTanggalLulusAttribute($value) {
        if ($value == '') {
            $this->attributes['tanggal_lulus'] = $value;
        } else {
            $this->attributes['tanggal_lulus'] = date('Y-m-d', strtotime($value));
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
