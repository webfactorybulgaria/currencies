<?php

namespace TypiCMS\Modules\Currencies\Http\Controllers;

use TypiCMS\Modules\Core\Shells\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Currencies\Shells\Repositories\CurrencyInterface;

class PublicController extends BasePublicController
{
    public function __construct(CurrencyInterface $currency)
    {
        parent::__construct($currency);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('currencies::public.index')
            ->with(compact('models'));
    }

    /**
     * Show news.
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $model = $this->repository->bySlug($slug);

        return view('currencies::public.show')
            ->with(compact('model'));
    }
}
