<?php
namespace Renderrer;

class OrderTable {
    protected $table;    

    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    public function showTable()
    {
        echo $this->table->render()
    }

    public function buildTable()
    {
        $this->showTable();
        $this->table;
    }
}
