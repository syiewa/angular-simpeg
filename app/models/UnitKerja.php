<?php

class UnitKerja extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_master_unit_kerja';
    protected $primaryKey = 'id_unit_kerja';
    protected $fillable = array('nama_unit_kerja', 'eselon', 'parent_unit');
    public $timestamps = false;
    protected $appends = ['nama_eselon', 'nama_parent_unit'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
// loads only direct children - 1 level
    public function child() {
        return $this->hasMany('UnitKerja', 'parent_unit');
    }

    public function parents() {
        return $this->belongsTo('UnitKerja', 'parent_unit');
    }

    public function eselons() {
        return $this->belongsTo('Eselon', 'eselon');
    }

    public function getNamaEselonAttribute() {
        $name = $this->attributes['eselon'];
        $data = Eselon::find($name);
        if ($data) {
            return $data->nama_eselon;
        }
        return '-';
    }

    public function getNamaParentUnitAttribute() {
        $name = $this->attributes['parent_unit'];
        $data = UnitKerja::find($name);
        if ($data) {
            return $data->nama_unit_kerja;
        }
        return '-';
    }

    public function scopeDropdownUnit($query, $where = null) {
        $data = array();
        if ($where != null) {
            $unitkerja = $query->select(array('id_unit_kerja', 'nama_unit_kerja'))->where('id_unit_kerja', '!=', $where)->get();
        } else {
            $unitkerja = $query->select(array('id_unit_kerja', 'nama_unit_kerja'))->get();
        }
        foreach ($unitkerja as $unit) {
            $data[] = array('id' => $unit->id_unit_kerja, 'label' => $unit->nama_unit_kerja);
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
            if ($col->COLUMN_NAME == 'eselon')
                $col->COLUMN_NAME = 'nama_eselon';
            if ($col->COLUMN_NAME == 'parent_unit')
                $col->COLUMN_NAME = 'nama_parent_unit';
            $data[] = $col->COLUMN_NAME;
        }
        return $data;
    }

    // recursive, loads all descendants
//    public function children()
//    {
//       return $this->child()->with('children')->orderBy('sort_order');
//    }
}
