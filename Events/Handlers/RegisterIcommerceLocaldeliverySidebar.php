<?php

namespace Modules\IcommerceLocaldelivery\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIcommerceLocaldeliverySidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        /*
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('icommercelocaldelivery::ilocaldeliveries.title.ilocaldeliveries'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     
                );
                $item->item(trans('icommercelocaldelivery::configlocaldeliveries.title.configlocaldeliveries'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.icommercelocaldelivery.configlocaldelivery.create');
                    $item->route('admin.icommercelocaldelivery.configlocaldelivery.index');
                    $item->authorize(
                        $this->auth->hasAccess('icommercelocaldelivery.configlocaldeliveries.index')
                    );
                });
// append

            });
        });
*/
        return $menu;
    }
}
