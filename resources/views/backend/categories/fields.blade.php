<form action="{{ route('backend.categories.store') }}" class="forms-sample" method="POST">
    @csrf
    <div class="form-group">
        <label for="exampleInputName1">Nama</label>
        <input type="text" name="name" value="{{ isset($category) ? $category->name : '' }}" class="form-control"
            id="exampleInputName1" placeholder="Nama Kategori">
        @if (isset($category))
            <input type="hidden" name="category_id" value="{{ $category->id }}">
        @endif
    </div>
    <div class="form-group">
        <label for="fee_per_hour">Biaya per Jam</label>
        <input type="number" name="fee_per_hour" value="{{ isset($category) ? $category->fee_per_hour : '' }}"
            class="form-control" id="fee_per_hour" placeholder="Biaya per Jam (contoh: 5000)">
    </div>
    <button type="submit" class="btn btn-primary mr-2">Ajukan</button>
    <button class="btn btn-light">Batal</button>
</form>