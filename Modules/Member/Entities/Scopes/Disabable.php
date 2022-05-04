<?php

namespace Modules\Member\Entities\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Disabable implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereNull($this->getDisabledAtColumn($builder));
    }

    /**
     * Extend the query builder with the needed functions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    public function extend(Builder $builder)
    {
        $builder->macro('withDisabled', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });

        $builder->macro('withoutDisabled', function (Builder $builder) {
            $model = $builder->getModel();

            $builder->withoutGlobalScope($this)->whereNull(
                $model->getQualifiedDisabledAtColumn()
            );

            return $builder;
        });

        $builder->macro('onlyDisabled', function (Builder $builder) {
            $model = $builder->getModel();

            $builder->withoutGlobalScope($this)->whereNotNull(
                $model->getQualifiedDisabledAtColumn()
            );

            return $builder;
        });

        $builder->macro('enable', function (Builder $builder) {
            $builder->withDisabled();

            return $builder->update([$builder->getModel()->getDisabledAtColumn() => null]);
        });
    }

    /**
     * Get the "disabled at" column for the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return string
     */
    protected function getDisabledAtColumn(Builder $builder)
    {
        if (count((array) $builder->getQuery()->joins) > 0) {
            return $builder->getModel()->getQualifiedDisabledAtColumn();
        }

        return $builder->getModel()->getDisabledAtColumn();
    }
}