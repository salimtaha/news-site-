<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:home');
    }

    public function index()
    {
        $chart_options = [
            'chart_title' => 'Posts by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Post',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',

            'filter_field' => 'created_at',
            'filter_days' => 3600, // show only last 30 days
        ];

        $posts_chart = new LaravelChart($chart_options);

        $chart_options_users = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',

            'filter_field' => 'created_at',
            'filter_days' => 360, // show only last 30 days
        ];

        $users_chart = new LaravelChart($chart_options_users);

        return view('admin.index', compact('posts_chart' , 'users_chart'));
    }

}
