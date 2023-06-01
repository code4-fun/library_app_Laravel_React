<div class="mb-3">
  <input class="form-control"
         name="name"
         type="text"
         placeholder="Имя"
         autocomplete="off"
         value="{{ old('name') ?? $employee->name ?? '' }}">
</div>
<div class="mb-3">
  <input class="form-control"
         name="email"
         type="text"
         placeholder="email"
         autocomplete="off"
         value="{{ old('email') ?? $employee->email ?? '' }}">
</div>
@if(isset($employee))
  <div class="mb-3">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" id="change_password">
      <label class="form-check-label" for="change_password">Изменить пароль</label>
    </div>
  </div>
@else
  <div class="mb-3" id="password_block">
    <input class="form-control"
           name="password"
           type="text"
           placeholder="Пароль"
           autocomplete="off">
  </div>
@endif