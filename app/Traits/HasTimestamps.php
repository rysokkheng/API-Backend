<?php

namespace App\Traits;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

trait HasTimestamps
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Update the model's update timestamp.
     *
     * @return bool
     */
    public function touch()
    {
        if (! $this->usesTimestamps()) {
            return false;
        }

        $this->updateTimestamps();

        return $this->save();
    }

    /**
     * Update the creation and update timestamps.
     *
     * @return void
     */
    protected function updateTimestamps()
    {
        $time           = $this->freshTimestamp();
        $user_id        = $this->freshAuthUser();
        $defult_status  = $this->freshRecordStatus();

        if (! is_null(static::UPDATED_AT_FIELD) && ! $this->isDirty(static::UPDATED_AT_FIELD)) {
            $this->setUpdatedAt($time);
            $this->setUpdatedBy($user_id);
        }

        if (! $this->exists && ! is_null(static::CREATED_AT_FIELD) &&
            ! $this->isDirty(static::CREATED_AT_FIELD)) {
            $this->setCreatedAt($time);
            $this->setCreatedBy($user_id);
            $this->setRecordStatus($defult_status);
        }
    }

    /**
     * Set the value of the "created at" attribute.
     *
     * @param  mixed  $value
     * @return $this
     */
    public function setCreatedAt($value)
    {
        $this->{static::CREATED_AT_FIELD} = $value;

        return $this;
    }

    /**
     * Set the value of the "updated at" attribute.
     *
     * @param  mixed  $value
     * @return $this
     */
    public function setUpdatedAt($value)
    {
        $this->{static::UPDATED_BY_FIELD} = $value;

        return $this;
    }

    /**
     * Set the value of the "created by" attribute.
     *
     * @param  mixed  $value
     * @return $this
     */
    public function setCreatedBy($value)
    {
        $this->{static::CREATED_BY_FIELD} = $value;

        return $this;
    }

    /**
     * Set the value of the "updated by" attribute.
     *
     * @param  mixed  $value
     * @return $this
     */
    public function setUpdatedBy($value)
    {
        $this->{static::UPDATED_BY_FIELD} = $value;

        return $this;
    }

    /**
     * Set the value of the "record status id" attribute.
     *
     * @param  mixed  $value
     * @return $this
     */
    public function setRecordStatus($value)
    {
        $this->{static::RECORD_STATUS_FIELD} = $value;

        return $this;
    }

    /**
     * Get a fresh timestamp for the model.
     *
     * @return \Illuminate\Support\Carbon
     */
    public function freshTimestamp()
    {
        return new Carbon;
    }

    /**
     * Get a fresh timestamp for the model.
     *
     * @return \Illuminate\Support\Carbon
     */
    public function freshAuthUser()
    {
        return Auth::check() ? auth::user()->id:1;
    }

    /**
     * Get a fresh timestamp for the model.
     *
     * @return \Illuminate\Support\Carbon
     */
    public function freshRecordStatus()
    {
        return static::RECORD_STATUS_ACTIVE;
    }

    /**
     * Get a fresh timestamp for the model.
     *
     * @return string
     */
    public function freshTimestampString()
    {
        return $this->fromDateTime($this->freshTimestamp());
    }

    /**
     * Determine if the model uses timestamps.
     *
     * @return bool
     */
    public function usesTimestamps()
    {
        return $this->timestamps;
    }

    /**
     * Get the name of the "created at" column.
     *
     * @return string
     */
    public function getCreatedAtColumn()
    {
        return static::CREATED_AT_FIELD;
    }

    /**
     * Get the name of the "updated at" column.
     *
     * @return string
     */
    public function getUpdatedAtColumn()
    {
        return static::UPDATED_AT_FIELD;
    }
}
