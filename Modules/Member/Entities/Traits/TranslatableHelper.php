<?php

namespace Modules\Member\Entities\Traits;

/**
 * 
 */
trait TranslatableHelper
{
    public function SmartTranslation($_COL_ = null, $_LOCALE_ = null, $_STRICT_ = true)
    {
        if ($this->relationLoaded('SmartTranslation')) {
            return is_null($_COL_) ? $this->SmartTranslation : (! is_null($this->SmartTranslation) ? $this->SmartTranslation->{ $_COL_ } : null);
        }

        $_LOCALE_ = is_null($_LOCALE_) ? app()->getLocale() : $_LOCALE_;
        
        $this->setRelation(
            'SmartTranslation', $this->translations->where('locale', $_LOCALE_)->first()
        );

        if (is_null($this->SmartTranslation) && !$_STRICT_) {
            $this->setRelation(
                'SmartTranslation', $this->translations->first()
            );
        }

        return is_null($_COL_) ? $this->SmartTranslation : (! is_null($this->SmartTranslation) ? $this->SmartTranslation->{ $_COL_ } : null);
    }
    
    public function __($COL_ = null, $_LOCALE_ = null, $_FORCE_ = false)
    {
        $_LOCALE_ = is_null($_LOCALE_) ? app()->getLocale() : $_LOCALE_;

        if (! $this->relationLoaded('translations') ) {
            $this->load('translations');
        } else if ( $_FORCE_ ) {
            $this->setRelation(
                'translations', $this->translations()->get()
            );
        }
        if (! is_null( $__ = $this->translations->where('locale', $_LOCALE_)->first() )) {
            if (!is_null($COL_)) {
                return $__->{ $COL_ };
            }
            return $__;
        }
        if (!is_null($COL_)) {
            return $this->translations->first()->{ $COL_ };
        }
        return $this->translations->first();
    }

    public function __strict($COL_ = null, $_LOCALE_ = null, $_FORCE_ = false)
    {
        $_LOCALE_ = is_null($_LOCALE_) ? app()->getLocale() : $_LOCALE_;

        if (! $this->relationLoaded('translations') ) {
            $this->load('translations');
        } else if ( $_FORCE_ ) {
            $this->setRelation(
                'translations', $this->translations()->get()
            );
        }
        if (! is_null( $__ = $this->translations->where('locale', $_LOCALE_)->first() )) {
            if (!is_null($COL_)) {
                return $__->{ $COL_ };
            }
            return $__;
        }
        return null;
    }

    public function translateOrFirst($locale = null)
    {
        $locale = $locale ?: app()->getLocale();

        if(! $this->relationLoaded('translations'))
        {
            $this->load('translations');
        }

        $translation = $this->translateOrDefault($locale);

        if(empty($translation))
        {
            $translation = $this->translations->first();
        }

        foreach (['image', 'cover', 'link', 'video', 'video2'] as $attribute) {
            $this->getTranslatedAttribute($attribute, $translation);
        }

        return $translation;
    }

    public function getTranslatedAttribute($attribute, $translation)
    {
        $translationAttributes = $translation->getAttributes();

        if(array_key_exists($attribute, $translationAttributes) && is_null($translation->{$attribute}))
        {
            $translation->{$attribute} = !is_null($hasAttribute = $this->translations->whereNotNull($attribute)->first()) ? $hasAttribute->{$attribute} : null;
        }
    }

    public function translateOrNull($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $translation = $this->translate($locale);

        if(empty($translation))
        {
            $translation = NULL;
        }

        return $translation;
    }
}
