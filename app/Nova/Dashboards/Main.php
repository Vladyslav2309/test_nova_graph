<?php

namespace App\Nova\Dashboards;
use App\Nova\Metrics\RegisteredUsers;
use App\Nova\Metrics\UserPerRole;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{


    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new UserPerRole(),
            new RegisteredUsers(),

        ];
    }

    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Dashboard';
    }
}
