<div>
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input toggle-class" id="customSwitch{{ $user->id }}" role="switch" wire:model.lazy="isActive" {{ $isActive ? 'checked' : '' }}>
        <label class="custom-control-label" for="customSwitch{{ $user->id }}">{{ $isActive ? 'Aktif' : 'Non-Aktif' }}</label>
    </div>
</div>
