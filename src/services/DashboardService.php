<?php

namespace services;

use repositories\DashboardRepository;

class DashboardService
{
    private DashboardRepository $dashboardRepository;

    public function __construct()
    {
        $this->dashboardRepository = new DashboardRepository();
    }

    public function getDashboardData(): array
    {
        return [
            'totalClientes' => $this->dashboardRepository->getTotalClientes(),
            'totalPedidos' => $this->dashboardRepository->getTotalPedidos(),
            'totalDetalles' => $this->dashboardRepository->getTotalDetalles(),
            'estadoPedidos' => $this->dashboardRepository->getCountByEstado()
        ];
    }
}
