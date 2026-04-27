<?php

namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;
class Dashboard extends BaseController
{



public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'daily_sales' => 35000,
            'daily_percent' => 12.5,
            'monthly_sales' => 850000,
            'monthly_percent' => 8.3,
            'yearly_sales' => 8500000,
            'yearly_percent' => 0.4,
            'total_earnings' => 1250000,
            'total_ideas' => 1247,
            'total_location' => 48,
            'rating' => 4.8,
            'rating_details' => [5 => 320, 4 => 150, 3 => 60, 2 => 20, 1 => 4],
            'recent_users' => [
                ['name' => 'John Doe', 'role' => 'Administrator', 'time' => '2 minutes ago'],
                ['name' => 'Jane Smith', 'role' => 'Editor', 'time' => '15 minutes ago'],
                ['name' => 'Mike Johnson', 'role' => 'User', 'time' => '1 hour ago'],
                ['name' => 'Sarah Williams', 'role' => 'Moderator', 'time' => '3 hours ago'],
                ['name' => 'David Brown', 'role' => 'User', 'time' => '5 hours ago']
            ]
        ];

        return view('dashboard/index', $data);
    }
}