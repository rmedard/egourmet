
<div class="md-form">
    {{Form::text('name', isset($dish) ? $dish->name : null, ['class' => 'form-control validate', 'id' => 'dish-name-id', 'placeholder' => trans('gui.model.name')])}}
</div>
<div class="md-form">
    {{Form::select('cuisine', $dishes_list, isset($dish) ? $dish->cuisine->id : null, ['class' => 'mdb-select colorful-select dropdown-dark', 'id' => 'dish-cuisine-id', 'placeholder' => trans('gui.select.cuisine')])}}
</div>