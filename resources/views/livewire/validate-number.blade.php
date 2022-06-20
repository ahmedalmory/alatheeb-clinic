<form wire:submit.prevent="submit">
    <input type="text" wire:model="civil" placeholder="رقم الهوية ( 10 ارقام )">
    @if($errors->has('civil'))
        <span>{{ $errors->first('civil') }}</span>
    @endif
    <button type="submit">تحقق</button>
</form>
