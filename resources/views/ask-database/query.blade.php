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
SQLResult: "
@if(!empty($result))
    @if(is_array($result))
        {{ json_encode($result, JSON_PRETTY_PRINT) }}
    @elseif(is_string($result))
        {{ $result }}
    @else
        No results found or query execution failed.
    @endif
@else
    Query execution returned no results or encountered an error.
@endif
"
Answer: "
@if(!empty($result))
    @if(is_array($result))
        Final Answer: 
        <ul>
            @foreach ($result as $row)
                <li>
                    @foreach ($row as $key => $value)
                        {{ $key }}: {{ $value }};
                    @endforeach
                </li>
            @endforeach
        </ul>
    @elseif(is_string($result))
        Final Answer: {{ $result }}
    @else
        No results found or query execution failed.
    @endif
@else
    Sorry, no answer could be generated.
@endif
"

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


@php
// Log the final rendered answer
Log::info('Final Answer:', [
    'question' => $question,
    'query' => $query,
    'result' => $result
]);
@endphp