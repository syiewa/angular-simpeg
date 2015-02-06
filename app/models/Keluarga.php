<?php

class Keluarga extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_data_keluarga';
    protected $primaryKey = 'id_data_keluarga';
    protected $fillable = array('id_pegawai', 'nama_anggota_keluarga', 'tanggal_lahir', 'status_kawin', 'tanggal_nikah', 'uraian', 'tanggal_cerai_meninggal', 'pekerjaan');
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    
    public function pegawai(){
        return $this->belongsTo('pegawai','id_pegawai');
    }
    
    public function scopeDropdownKeluarga($query) {
        $data = array();
        $jabatan = $query->select(array('id_data_keluarga', 'nama_anggota_keluarga'))->get();
        if (count($jabatan) > 0) {
            foreach ($jabatan as $ese) {
                $data[] = array('id' => $ese->id_jabatan, 'label' => $ese->nama_jabatan);
            }
        }
        return $data;
    }

    public function getTanggalLahirAttribute($value) {
        return date('m/d/Y', strtotime($value));
    }

    public function setTanggalLahirAttribute($value) {
        $this->attributes['tanggal_lahir'] = date('Y-m-d', strtotime($value));
    }

    public function getTanggalNikahAttribute($value) {
        if ($value == '') {
            return $value;
        }
        return date('m/d/Y', strtotime($value));
    }

    public function setTanggalNikahAttribute($value) {
        if ($value == '') {
            $this->attributes['tanggal_nikah'] = $value;
        } else {
            $this->attributes['tanggal_nikah'] = date('Y-m-d', strtotime($value));
        }
    }

    public function getTanggalCeraiMeninggalAttribute($value) {
        if ($value == '') {
            return $value;
        }
        return date('m/d/Y', strtotime($value));
    }

    public function setTanggalCeraiMeninggal($value) {
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
