<div class="users-table" wire:poll.visible.1s>
    <div class="admin-panel-info-new-users__table new-users-table new-users-table-users">
        <div class="new-users-table__item new-users-table__header">
            <p class="new-users-table__name">id</p>
            <p class="new-users-table__name">Фамилия</p>
            <p class="new-users-table__name">Имя</p>
            <p class="new-users-table__name">Отчество</p>
            <p class="new-users-table__name">Email</p>
        </div>
        @foreach($users as $user)
            <div class="new-users-table__item">
                <p class="new-users-table__name">{{ $user['id'] }}</p>
                <p class="new-users-table__name">{{ $user['surname'] }}</p>
                <p class="new-users-table__name">{{ $user['name'] }}</p>
                <p class="new-users-table__name">{{ $user['patronymic'] }}</p>
                <p class="new-users-table__name">{{ $user['email'] }}</p>
            </div>
        @endforeach
    </div>
</div>
