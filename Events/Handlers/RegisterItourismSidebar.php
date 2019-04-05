<?php

namespace Modules\Itourism\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterItourismSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('itourism::common.title.itourisms'), function (Item $item) {
                $item->icon('fa fa-bus');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('itourism::plans.title.plans'), function (Item $item) {
                    $item->icon('fa fa-tasks');
                    $item->weight(0);
                    $item->append('admin.itourism.plan.create');
                    $item->route('admin.itourism.plan.index');
                    $item->authorize(
                        $this->auth->hasAccess('itourism.plans.index')
                    );
                });
                $item->item(trans('itourism::persontypes.title.persontypes'), function (Item $item) {
                    $item->icon('fa fa-user');
                    $item->weight(0);
                    $item->append('admin.itourism.persontypes.create');
                    $item->route('admin.itourism.persontypes.index');
                    $item->authorize(
                        $this->auth->hasAccess('itourism.persontypes.index')
                    );
                });
                $item->item(trans('itourism::roomtypes.title.roomtypes'), function (Item $item) {
                    $item->icon('fa fa-bed');
                    $item->weight(0);
                    $item->append('admin.itourism.roomtypes.create');
                    $item->route('admin.itourism.roomtypes.index');
                    $item->authorize(
                        $this->auth->hasAccess('itourism.roomtypes.index')
                    );
                });
                // $item->item(trans('itourism::planprices.title.planprices'), function (Item $item) {
                //     $item->icon('fa fa-money');
                //     $item->weight(0);
                //     $item->append('admin.itourism.planprice.create');
                //     $item->route('admin.itourism.planprice.index');
                //     $item->authorize(
                //         $this->auth->hasAccess('itourism.planprices.index')
                //     );
                // });
// append




            });
        });

        return $menu;
    }
}
