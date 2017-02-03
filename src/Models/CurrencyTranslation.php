<?php

namespace TypiCMS\Modules\Currencies\Models;

use TypiCMS\Modules\Core\Shells\Models\BaseTranslation;

class CurrencyTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Currencies\Shells\Models\Currency', 'currency_id')->withoutGlobalScopes();
    }
}
