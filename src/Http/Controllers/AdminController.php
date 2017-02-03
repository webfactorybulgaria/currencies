<?php

namespace TypiCMS\Modules\Currencies\Http\Controllers;

use TypiCMS\Modules\Core\Shells\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Currencies\Shells\Http\Requests\FormRequest;
use TypiCMS\Modules\Currencies\Shells\Models\Currency;
use TypiCMS\Modules\Currencies\Shells\Repositories\CurrencyInterface;

class AdminController extends BaseAdminController
{
    public function __construct(CurrencyInterface $currency)
    {
        parent::__construct($currency);
    }

    /**
     * List models.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('currencies::admin.index');
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();

        return view('currencies::admin.create')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Currencies\Shells\Models\Currency $currency
     *
     * @return \Illuminate\View\View
     */
    public function edit(Currency $currency)
    {
        return view('currencies::admin.edit')
            ->with(['model' => $currency]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Currencies\Shells\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $currency = $this->repository->create($request->all());

        return $this->redirect($request, $currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Currencies\Shells\Models\Currency            $currency
     * @param \TypiCMS\Modules\Currencies\Shells\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Currency $currency, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $currency);
    }
}
