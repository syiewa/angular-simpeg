<?php

class Organisasi extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_data_organisasi';
    protected $primaryKey = 'id_organisasi';
    protected $fillable = array('id_pegawai', 'uraian', 'lokasi', 'tanggal');
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function getTanggalAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }

    public function setTanggalAttribute($value) {
        $this->attributes['tanggal'] = date('Y-m-d', strtotime($value));
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
