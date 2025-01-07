    <?php

use Illuminate\Support\Facades\Schema;

if (!function_exists('getTableSchema')) {
    function getTableSchema($modelClass) {
        $model = app($modelClass); // Dynamically instantiate the model
        $table = $model->getTable(); // Get table name
        $columns = Schema::getColumnListing($table); // Get all columns for the table
        return ['table' => $table, 'columns' => $columns]; // Return table name and columns
    }
}
