<?php

namespace TypiCMS\Modules\Currencies\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('shop::global.name'), function (SidebarGroup $group) {
            $group->id = 'shop';
            $group->addItem(trans('currencies::global.name'), function (SidebarItem $item) {
                $item->id = 'currencies';
                $item->icon = config('typicms.currencies.sidebar.icon');
                $item->weight = config('typicms.currencies.sidebar.weight');
                $item->route('admin::index-currencies');
                $item->append('admin::create-currency');
                $item->authorize(
                    Gate::allows('index-currencies')
                );
            });
        });
    }
}
