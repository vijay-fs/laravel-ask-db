@php
// Import the helper function and necessary classes
use Illuminate\Support\Facades\Schema;

// Define models and their corresponding classes
$models = [
    'Lead' => \App\Models\Lead::class,
    'Customer' => \App\Models\Customer::class,
];

// Initialize an array to hold table schemas
$tableSchemas = [];
foreach ($models as $name => $modelClass) {
    // Use the helper function to fetch table schema dynamically
    $tableSchemas[$name] = getTableSchema($modelClass);
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
    Answer: "
@else
(Your answer HERE must be a syntactically correct MySQL query with no extra information or quotes. Omit SQLQuery: from your answer)
@endif
