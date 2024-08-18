@props(["minHeight" => null])
<div {{$attributes->merge(['class' => 'return content-card', 'style' => "min-height: {$minHeight};"])}}>
    {{$slot}}
</div>