<?php
namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;

class Affiliate extends BaseController
{
        public function affiliate()
    {
        $data = [
            'title' => 'Affiliate Dashboard',
            'stats' => [
                'referrals' => ['value' => '45,2 rb', 'growth' => '+12.5%', 'icon' => 'users'],
                'conversion' => ['value' => '3.24%', 'growth' => '+0.8%', 'icon' => 'chart-line'],
                'visits' => ['value' => '128,4 rb', 'growth' => '+23.1%', 'icon' => 'eye']
            ],
            'chartData' => [
                'labels' => ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'],
                'revenue' => [12, 19, 15, 27, 22, 34],
                'conversion' => [2.1, 2.5, 2.3, 3.1, 2.8, 3.5]
            ],
            'affiliates' => [
                ['name' => 'John Doe', 'campaign' => 'Promo Diskon Besar', 'earnings' => 12450, 'growth' => 12, 'progress' => 75, 'avatar' => 'user'],
                ['name' => 'Jane Smith', 'campaign' => 'Promo Akhir Bulan', 'earnings' => 8900, 'growth' => 8, 'progress' => 60, 'avatar' => 'user-circle'],
                ['name' => 'Mike Johnson', 'campaign' => 'Promo Spesial Mingguan', 'earnings' => 15600, 'growth' => 15, 'progress' => 85, 'avatar' => 'user-tie'],
                ['name' => 'Sarah Williams', 'campaign' => 'Flash Sale 12.12', 'earnings' => 21300, 'growth' => 25, 'progress' => 95, 'avatar' => 'user-graduate']
            ],
            'topVisitors' => [
                ['name' => 'Adeline', 'earnings' => 18450, 'growth' => 32, 'avatar' => 'crown'],
                ['name' => 'Benjamin', 'earnings' => 12400, 'growth' => 18, 'avatar' => 'user-astronaut'],
                ['name' => 'Charlotte', 'earnings' => 9800, 'growth' => 22, 'avatar' => 'user-ninja'],
                ['name' => 'Daniel', 'earnings' => 7600, 'growth' => 14, 'avatar' => 'user-secret']
            ]
        ];

        return view('dashboard/affiliate', $data);
    }
}