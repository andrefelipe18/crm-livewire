<?php

use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;

test('O componente deve estar sendo renderizado', function () {

    Livewire::test(Register::class)
        ->assertOk();

});

test('O componente deve conseguir cadastrar um novo user no sistema', function() {

    Livewire::test(Register::class)
        ->set('name', 'André')
        ->set('email', 'andre@domingues.com')
        ->set('email_confirmation', 'andre@domingues.com')
        ->set('password', 'password')
        ->call('register')
        ->assertHasNoErrors('/')
        ->assertRedirect('/');


    assertDatabaseHas('users', [
        'name' => 'André',
        'email' => 'andre@domingues.com'
    ]);

    assertDatabaseCount('users', 1);

    expect(Auth::user()->name)->toBe('André');


});

test('O componente deve validar os campos obrigatórios', function($data) {

    Livewire::test(Register::class)
       ->set($data->field, $data->value)
       ->call('register')
       ->assertHasErrors($data->field);

})->with([ //Dataset para testar os campos obrigatórios, field é o campo, value é o valor que será testado e rule é a regra que será testada
    'name::required' => (object)['field' => 'name', 'value' => '', 'rule' => 'required'],
    'name::max:255' => (object)['field' => 'name', 'value' => str_repeat('*', 256), 'rule' => 'max'],
    'email::required' => (object)['field' => 'email', 'value' => '', 'rule' => 'required'],
    'email::email' => (object)['field' => 'email', 'value' => 'andre', 'rule' => 'email'],
    'email::confirmed' => (object)['field' => 'email', 'value' => 'andre@gmail.com', 'rule' => 'confirmed'],
    'password::required' => (object)['field' => 'password', 'value' => '', 'rule' => 'required'],
]);
