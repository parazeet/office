<?php


namespace App\Helpers;


use App\ConnectDB;
use App\Model\Cost;

class PrepareDataCostsServices
{
    private $costs;

    public function __construct()
    {
        $database = new ConnectDB();
        $this->costs = new Cost($database->getConnection());
    }

    public function getData()
    {
        try {
            $lastTen = $this->costs->getLastTen();
            $incomes = $this->costs->getAllIncomes() ? $this->costs->getAllIncomes() : 0;
            $costs = $this->costs->getAllCosts() ? $this->costs->getAllCosts() : 0;
            $difference = $incomes - $costs;
        } catch(\PDOException $exception) {
            echo "Error: " . $exception->getMessage();
            exit;
        }

        return [$lastTen, $incomes, $costs, $difference];
    }

    public function create($request)
    {
        return $this->costs->create($request);
    }
}