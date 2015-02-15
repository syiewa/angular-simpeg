<?php

class Dp3 extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_data_dp3';
    protected $primaryKey = 'id_dp3';
    protected $fillable = array('id_pegawai', 'tanggung_jawab', 'ketaatan', 'kejujuran',
        'tahun', 'kesetiaan', 'prestasi', 'kerjasama', 'prakarsa', 'kepemimpinan',
        'rata_rata', 'atasan', 'penilai', 'mengetahui'
    );
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    

    public function pegawai() {
        return $this->belongsTo('pegawai', 'id_pegawai');
    }

}
