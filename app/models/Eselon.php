<?php

class Eselon extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_master_eselon';
    protected $primaryKey = 'id_eselon';
    protected $fillable = array('nama_eselon', 'level');
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function scopeDropdownEselon($query) {
        $data = array();
        $eselon = $query->select(array('id_eselon', 'nama_eselon'))->get();
        if (count($eselon) > 0) {
            foreach ($eselon as $ese) {
                $data[] = array('id' => $ese->id_eselon, 'label' => $ese->nama_eselon);
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
