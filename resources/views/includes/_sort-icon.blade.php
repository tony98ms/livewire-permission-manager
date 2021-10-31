@if ($orderBy !== $field)
    <i class="text-muted fas fa-sort sort"></i>
@elseif ($orderAsc)
    <i class="fas fa-sort-up sort"></i>
@else
    <i class="fas fa-sort-down sort"></i>
@endif
