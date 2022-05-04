<?php

namespace Modules\Member\Entities\Traits;

use Modules\Member\Entities\Scopes\Disabable as DisabableScope;

trait Disabable
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootDisabable()
    {
        static::addGlobalScope(new DisabableScope);
    }

    /**
     * Enable a Disabable model instance.
     *
     * @return bool|null
     */
    public function enable()
    {
        // If the restoring event does not return false, we will proceed with this
        // enabling operation. Otherwise, we bail out so the developer will stop
        // the restore totally. We will clear the deleted timestamp and save.
        if ($this->fireModelEvent('enabling') === false) {
            return false;
        }

        $this->{$this->getDisabledAtColumn()} = null;

        // Once we have saved the model, we will fire the "enabled" event so this
        // developer will do anything they need to after a enabled operation is
        // totally finished. Then we will return the result of the save call.
        $this->exists = true;

        $result = $this->save();

        $this->fireModelEvent('enabled', false);

        return $result;
    }

    /**
     * Enable a Disabable model instance.
     *
     * @return bool|null
     */
    public function disable()
    {
        // If the restoring event does not return false, we will proceed with this
        // enabling operation. Otherwise, we bail out so the developer will stop
        // the restore totally. We will clear the deleted timestamp and save.
        if ($this->fireModelEvent('disabling') === false) {
            return false;
        }

        $time = $this->freshTimestamp();

        $this->{$this->getDisabledAtColumn()} = $this->fromDateTime($time);

        // Once we have saved the model, we will fire the "enabled" event so this
        // developer will do anything they need to after a enabled operation is
        // totally finished. Then we will return the result of the save call.
        $this->exists = true;

        $result = $this->save();

        $this->fireModelEvent('disabled', false);

        return $result;
    }

    /**
     * Determine if the model instance is disabled.
     *
     * @return bool
     */
    public function isDisabled()
    {
        return ! is_null($this->{$this->getDisabledAtColumn()});
    }

    /**
     * Determine if the model instance is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return ! $this->isDisabled();
    }

    /**
     * Register a disabling model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    public static function disabling($callback)
    {
        static::registerModelEvent('disabling', $callback);
    }

    /**
     * Register a disabled model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    public static function disabled($callback)
    {
        static::registerModelEvent('disabled', $callback);
    }

    /**
     * Register a enabling model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    public static function enabling($callback)
    {
        static::registerModelEvent('enabling', $callback);
    }

    /**
     * Register a enabled model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    public static function enabled($callback)
    {
        static::registerModelEvent('enabled', $callback);
    }

    /**
     * Get the name of the "disabled at" column.
     *
     * @return string
     */
    public function getDisabledAtColumn()
    {
        return defined('static::DISABLED_AT') ? static::DISABLED_AT : 'disabled_at';
    }

    /**
     * Get the fully qualified "disabled at" column.
     *
     * @return string
     */
    public function getQualifiedDisabledAtColumn()
    {
        return $this->getTable().'.'.$this->getDisabledAtColumn();
    }
}