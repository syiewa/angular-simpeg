<?php

class  GajiPokok extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_data_gaji_pokok';
    protected $primaryKey = 'id_gaji_pokok';
    protected $fillable = array('id_pegawai', 'id_golongan','tanggal_sk','nomor_sk','dasar_perubahan','gaji_pokok','tanggal_mulai','tanggal_selesai','masa_kerja','pejabat_menetapkan');
    public $timestamps = false;
    protected $appends = ['nama_golongan'];

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

    public function pegawai() {
        return $this->belongsTo('pegawai', 'id_pegawai');
    }

    public function scopeDropdownRiwayatPangkat($query) {
        $data = array();
        $jabatan = $query->select(array('id_gaji_pokok', 'nama_anggota_gaji_pokok'))->get();
        if (count($jabatan) > 0) {
            foreach ($jabatan as $ese) {
                $data[] = array('id' => $ese->id_jabatan, 'label' => $ese->nama_jabatan);
            }
        }
        return $data;
    }

    public function getTanggalSkAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }

    public function setTanggalSkAttribute($value) {
        $this->attributes['tanggal_sk'] = date('Y-m-d', strtotime($value));
    }

    public function getTanggalMulaiAttribute($value) {
        if ($value == '') {
            return $value;
        }
        return date('d/m/Y', strtotime($value));
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
        return date('d/m/Y', strtotime($value));
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
