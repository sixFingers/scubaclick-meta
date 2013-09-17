<?php namespace ScubaClick\Meta;

use ScubaClick\Meta\Helpers;

class Meta extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meta';

    /**
     * No timestamps for meta data
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Defining fillable attributes on the model
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'metable_id'   => 'required|integer',
        'metable_type' => 'required',
        'key'          => 'required|max:100',
        'value'        => 'required',
   ];

    /**
     * Connect the models
     */
    public function metable()
    {
        return $this->morphTo();
    }

    /**
     * Maybe decode a meta value
     *
     * @return mixed
     */
    public function getValueAttribute($value)
    {
        return Helpers::maybeDecode($value);
    }

    /**
     * Maybe encode a value for saving
     *
     * @return null
     */
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = Helpers::maybeEncode($value);
    }
}
