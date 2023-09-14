<?php

class Model {

    protected object|int $db = 1;

    public function __construct() {
        $this->db = new MysqliDb(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT, DB_CHARSET, DB_SOCKET);
    }
    
    /**
     * @param string|array $columns     'column_name' or ['column1'=>'name', 'column_name2=>'name']
     * @param array $where              where condition ['column_name'=>'value'] -> can add multiple where conditions
     * @return array|bool               return table data or false
     */
    public function getTableData(string $table_name, string|array $columns='*', array $where=null, int $num_rows=null, string $order_by_column=null, string $order_by_direction = "ASC", string $where_operator='=', string $where_condition='AND'): array|bool {
        if ($where != null) {
            foreach ($where as $column=>$value) {
                $this->db->where($column, $value, $where_operator, $where_condition);
            }
        }

        if ($order_by_column != null) {
            $this->db->orderBy($order_by_column, $order_by_direction);
        }
        
        return $this->db->get($table_name, $num_rows, $columns);
    }

    public function insertToTable(string $table, array $data_to_insert) {
        return $this->db->insert($table, $data_to_insert);
    }

    /**
     * @param array $where    ['column_name'=>'value'] -> can add multiple where conditions
     */
    public function updateTableRow(string $table, array $where, array $data_to_update, string $where_operator='=', string $where_condition='AND'): bool {
        foreach ($where as $column=>$value) {
            $this->db->where($column, $value, $where_operator, $where_condition);
        }
        return $this->db->update($table, $data_to_update);
    }
    
}