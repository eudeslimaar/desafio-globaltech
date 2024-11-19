<?php

namespace controllers;

use services\DashboardService;

class DashboardController
{
    private DashboardService $dashboardService;

    public function __construct()
    {
        $this->dashboardService = new DashboardService();
    }

    public function index(): void
    {
        try {
            $data = $this->dashboardService->getDashboardData();
            echo view('index', ['data' => $data]);
        } catch (\Exception $e) {
            http_response_code(500);
        }
    }
}
