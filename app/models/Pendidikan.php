<?php

class Pendidikan extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_data_pendidikan';
    protected $primaryKey = 'id_pendidikan';
    protected $fillable = array('id_pegawai', 'tingkat_pendidikan', 'jurusan', 'uraian', 'teknik_non_teknik', 'sekolah', 'tempat_sekolah', 'nomor_sttb', 'tanggal_sttb', 'tanggal_lulus');
    public $timestamps = false;
    protected $appends = ['teknik'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function pegawai() {
        return $this->belongsTo('pegawai', 'id_pegawai');
    }

    public function getTeknikAttribute() {
        $name = $this->attributes['teknik_non_teknik'];
        if ($name == 1) {
            return 'Teknik';
        }
        return 'Non Teknik';
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
