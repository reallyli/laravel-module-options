<?php

namespace Reallyli\Options;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var [type]
     */
    protected $fillable = [
        'key',
        'value',
        'comment',
        'module'
    ];

    /**
     * Determine if the given option value exists.
     *
     * @param mixed $module
     * @param  string  $key
     * @return bool
     */
    public function exists($module, $key)
    {
        return self::where([
            'module' => $module,
            'key' => $key
        ])->exists();
    }

    /**
     * Get the specified option value.
     *
     * @param mixed $module
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     */
    public function get($module, $key, $default = null)
    {
        $option = self::where([
            'module' => $module,
            'key' => $key
        ])->first();

        return $option ? $option->value : $default;
    }

    /**
     * Set a given option value.
     *
     * @param mixed $module
     * @param array|string  $key
     * @param mixed $value
     * @param mixed $comment
     * @return void
     */
    public function set($module, $key, $value = null, $comment = null)
    {
        $keys = is_array($key) ? $key : [$key => $value];

        $data = [
            'module' => $module,
            'comment' => $comment
        ];

        foreach ($keys as $key => $value) {
            $data['value'] = $value;

            self::updateOrCreate(['key' => $key, 'module' => $module], $data);
        }
    }

    /**
     * Remove/delete the specified option value.
     *
     * @param mixed $module
     * @param  string  $key
     * @return bool
     */
    public function remove($module, $key)
    {
        return (bool) self::where([
            'module' => $module,
            'key' => $key
        ])->delete();
    }

    /**
     * Increase the specified option value.
     *
     * @param mixed $module
     * @param  string  $key
     * @param int $step
     * @return mixed
     */
    public function increase($module, $key, $step = 1)
    {
        $option = self::where([
            'module' => $module,
            'key' => $key
        ])->first();

        return $option ? $option->increment('value', $step) : null;
    }

    /**
     * Decrease the specified option value.
     *
     * @param mixed $module
     * @param  string  $key
     * @param int $step
     * @return bool
     */
    public function decrease($module, $key, $step = 1)
    {
        $option = self::where([
            'module' => $module,
            'key' => $key
        ])->first();

        return $option ? $option->decrement('value', $step) : null;
    }
}
