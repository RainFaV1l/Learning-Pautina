<div class="users-table" wire:poll.visible.1s>
    <div class="admin-panel-info-new-users__table new-users-table new-users-table-group">
        <div class="new-users-table__item new-users-table__header">
            <p class="new-users-table__name">id</p>
            <p class="new-users-table__name">Название</p>
            <p class="new-users-table__name">Количество</p>
            <p class="new-users-table__name">Преподаватель</p>
        </div>
        @foreach($groups as $group)
            <div class="new-users-table__item">
                <p class="new-users-table__name">{{ $group['id'] }}</p>
                <p class="new-users-table__name">{{ $group['name'] }}</p>
                <p class="new-users-table__name">25</p>
                <p class="new-users-table__name">{{ $group->teacher->surname . ' ' . $group->teacher->name }}</p>
            </div>
        @endforeach
    </div>
</div>
