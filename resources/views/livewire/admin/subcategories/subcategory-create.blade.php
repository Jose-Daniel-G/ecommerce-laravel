    <form wire:submit="save">
        <div class="card">
            <x-validation-errors class="mb-4" />
            <div class="mb-4">
                <x-label class="mb-2">Familias</x-label>
                <x-select name="family_id" class="w-full" wire:model.live="subcategory.family_id">
                    <option value="" disabled>Selecione una familia</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">
                            @selected(old('family_id') == $family->id)
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>
                <x-label class="mb-2">Categorias</x-label>
                <x-select name="category_id" class="w-full" wire:model.live="subcategory.category_id">
                    <option value="" disabled>Selecione una categoria</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">
                            @selected(old('category_id') == $category->id)
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
                <x-label class="mb-2">Nombre</x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la familia" name="name"
                    value="{{ old('name') }}" wire:model="subcategory.name"></x-input>
            </div>
        </div>
        <div class="flex justify-end">
            <x-button>Guardar</x-button>
        </div>

    </form>
