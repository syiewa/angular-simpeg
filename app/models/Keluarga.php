<?php

class Keluarga extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_data_keluarga';
    protected $primaryKey = 'id_data_keluarga';
    protected $fillable = array('id_pegawai','nama_anggota_keluarga', 'tanggal_lahir','status_kawin','tanggal_nikah','uraian','tanggal_cerai_meninggal','pekerjaan');
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
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
