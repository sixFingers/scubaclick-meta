<?php namespace ScubaClick\Meta;

use Validator;
use ScubaClick\Meta\Helpers;
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Meta extends Eloquent
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
     * Error message bag
     * 
     * @var Illuminate\Support\MessageBag
     */
    protected $errors;

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
     * Listen for save event
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            return $model->validate();
        });
    }

    /**
     * Validates current attributes against rules
     *
     * @return bool
     */
    public function validate()
    {
        $validator = Validator::make($this->attributes, static::$rules);

        if ($validator->passes()) {
            return true;
        }

        $this->setErrors($validator->messages());

        return false;
    }

    /**
     * Set error message bag
     * 
     * @var Illuminate\Support\MessageBag
     * @return void
     */
    protected function setErrors(MessageBag $errors)
    {
        $this->errors = $errors;
    }

    /**
     * Retrieve error message bag
     *
     * @return Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Connect the models
     *
     * @return 
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
