<?php

use App\Livewire\Auth\Register;
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
        ->assertHasNoErrors('/');


    assertDatabaseHas('users', [
        'name' => 'André',
        'email' => 'andre@domingues.com'
    ]);

    assertDatabaseCount('users', 1);


});
