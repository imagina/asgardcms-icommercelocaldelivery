<?php

namespace Modules\Icommercelocaldelivery\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIcommercelocaldeliverySidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        //$sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('icommercelocaldelivery::icommercelocaldeliveries.title.icommercelocaldeliveries'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('icommercelocaldelivery::icommercelocaldeliveries.title.icommercelocaldeliveries'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.icommercelocaldelivery.icommercelocaldelivery.create');
                    $item->route('admin.icommercelocaldelivery.icommercelocaldelivery.index');
                    $item->authorize(
                        $this->auth->hasAccess('icommercelocaldelivery.icommercelocaldeliveries.index')
                    );
                });
// append

            });
        });

        return $menu;
    }
}
