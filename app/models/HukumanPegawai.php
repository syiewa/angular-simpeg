<?php

class HukumanPegawai extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_data_hukuman';
    protected $primaryKey = 'id_hukuman';
    protected $fillable = array('id_pegawai', 'id_master_hukuman', 'tanggal_sk', 'nomor_sk', 'uraian', 'tanggal_mulai', 'tanggal_selesai', 'masa_berlaku', 'pejabat_menetapkan');
    public $timestamps = false;
    protected $appends = ['nama_hukuman'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function getNamaHukumanAttribute() {
        $name = $this->attributes['id_master_hukuman'];
        $data = Hukuman::find($name);
        if ($data) {
            return $data->nama_hukuman;
        }
        return '-';
    }

    public function pegawai() {
        return $this->belongsTo('pegawai', 'id_pegawai');
    }

    public function getTanggalSkAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }

    public function setTanggalSkAttribute($value) {
        $this->attributes['tanggal_sk'] = date('Y-m-d', strtotime($value));
    }

    public function getTanggalMulaiAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }

    public function setTanggalMulaiAttribute($value) {
        $this->attributes['tanggal_mulai'] = date('Y-m-d', strtotime($value));
    }

    public function getTanggalSelesaAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }

    public function setTanggalSelesai($value) {
        $this->attributes['tanggal_selesai'] = date('Y-m-d', strtotime($value));
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
