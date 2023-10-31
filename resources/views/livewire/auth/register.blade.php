<x-card shadow>
    <x-form wire:submit="register">
        <x-input label="Name" wire:model="name" />
        <x-input label="Email" wire:model="email" />
        <x-input label="Confirme seu email" wire:model="email_confirmation" />
        <x-input label="Password" type="password" wire:model="password" />


        <x-slot:actions>
            <x-button label="Reset" type="reset"/>
            <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="register" />
        </x-slot:actions>
    </x-form>
</x-card>
