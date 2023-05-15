<div class="row">
  <h4 class="mb-3">Сотрудники</h4>

  @if(sizeof($employees) == 0)
    <div class="col-6">
      Никого не найдено
    </div>
  @endif

  @foreach($employees as $employee)
    <div class="col-12">
      <div class="card_custom">
        <p class="card-title">{{ $employee->name }}</p>
        <p class="card-title">{{ $employee->email }}</p>
        <div class="card_custom_buttons">
          <a href="{{ route('employee.edit', ['id' => $employee->id]) }}" class="btn btn-outline-primary">Изменить сотрудника</a>
          <form action="{{ route('employee.destroy', ['id' => $employee->id]) }}" method="post"
                onsubmit="return confirm('Точно удалить этого сотрудника?')">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-outline-danger" value="Удалить сотрудника">
          </form>
        </div>
      </div>
    </div>
  @endforeach
</div>