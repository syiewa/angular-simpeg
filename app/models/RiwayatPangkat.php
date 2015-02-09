<?php

class RiwayatPangkat extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_data_riwayat_pangkat';
    protected $primaryKey = 'id_riwayat_pangkat';
    protected $fillable = array('id_pegawai', 'id_golongan', 'status', 'nomor_sk', 'tanggal_sk', 'tanggal_mulai', 'tanggal_selesai', 'masa_kerja');
    public $timestamps = false;
    protected $appends = ['nama_golongan', 'nama_status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function getNamaGolonganAttribute() {
        $name = $this->attributes['id_golongan'];
        $data = Golongan::find($name);
        if ($data) {
            return $data->golongan;
        }
        return '-';
    }

    public function getNamaStatusAttribute() {
        $name = $this->attributes['status'];
        $data = StatusPegawai::find($name);
        if ($data) {
            return $data->nama_status;
        }
        return '-';
    }

    public function pegawai() {
        return $this->belongsTo('pegawai', 'id_pegawai');
    }

    public function scopeDropdownRiwayatPangkat($query) {
        $data = array();
        $jabatan = $query->select(array('id_riwayat_pangkat', 'nama_anggota_riwayat_pangkat'))->get();
        if (count($jabatan) > 0) {
            foreach ($jabatan as $ese) {
                $data[] = array('id' => $ese->id_jabatan, 'label' => $ese->nama_jabatan);
            }
        }
        return $data;
    }

    public function getTanggalSkAttribute($value) {
        return date('m/d/Y', strtotime($value));
    }

    public function setTanggalLahirAttribute($value) {
        $this->attributes['tanggal_sk'] = date('Y-m-d', strtotime($value));
    }

    public function getTanggalMulaiAttribute($value) {
        if ($value == '') {
            return $value;
        }
        return date('m/d/Y', strtotime($value));
    }

    public function setTanggalMulaiAttribute($value) {
        if ($value == '') {
            $this->attributes['tanggal_mulai'] = $value;
        } else {
            $this->attributes['tanggal_mulai'] = date('Y-m-d', strtotime($value));
        }
    }

    public function getTanggalSelesaAttribute($value) {
        if ($value == '') {
            return $value;
        }
        return date('m/d/Y', strtotime($value));
    }

    public function setTanggalSelesai($value) {
        if ($value == '') {
            $this->attributes['tanggal_cerai_meninggal'] = $value;
        } else {
            $this->attributes['tanggal_cerai_meninggal'] = date('Y-m-d', strtotime($value));
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
