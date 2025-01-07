@php
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

// Automatically detect all models in the `app/Models` directory
$models = [];
$path = app_path('Models');
$files = File::allFiles($path);

foreach ($files as $file) {
    $namespace = "App\\Models\\";
    $className = $namespace . Str::replaceLast('.php', '', $file->getFilename());
    
    if (class_exists($className)) {
        $models[basename($file->getFilename(), '.php')] = $className;
    }
}

// Initialize an array to hold table schemas
$tableSchemas = [];
foreach ($models as $name => $modelClass) {
    $modelInstance = app($modelClass);
    $table = $modelInstance->getTable();
    $columns = Schema::getColumnListing($table);
    $tableSchemas[$name] = ['table' => $table, 'columns' => $columns];
}
@endphp
---

Guidelines:

Question: "User question here"
SQLQuery: "SQL Query used to generate the result (if applicable)"
SQLResult: "Result of the SQLQuery (if applicable)"
Answer: "Final answer here (You fill this in with the SQL query only)"

---

Context:

Only use the following tables and columns:  

@foreach ($tableSchemas as $modelName => $schema)
"{{ $schema['table'] }}" has columns: {{ implode(', ', $schema['columns']) }}
@endforeach

Question: "{!! $question !!}"
SQLQuery: "@if($query){!! $query !!}"
SQLResult: "@if($result){!! $result !!}"
@endif
@endif

@if($query)
    SQLQuery: "{{ $query }}"
    SQLResult: "{{ json_encode($result, JSON_PRETTY_PRINT) }}"
    Answer: "
@else
(Your answer HERE must be a syntactically correct MySQL query with no extra information or quotes. Omit SQLQuery: from your answer)
@endif
