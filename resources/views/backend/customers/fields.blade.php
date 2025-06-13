<form action="{{ route('backend.customers.store') }}" class="forms-sample" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputName1">Nama</label>
        <input type="text" name="name" value="{{ isset($customer) ? $customer->name : '' }}" class="form-control"
            id="exampleInputName1" placeholder="Masukan Nama Anda">
        @if (isset($customer))
            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
        @endif
    </div>
    <div class="form-group">
        <label for="exampleInputEmail3">Alamat Email</label>
        <input type="email" name="email" value="{{ isset($customer) ? $customer->email : '' }}"
            class="form-control w-100" id="exampleInputEmail3" placeholder="Masukan Alamat Email Anda"
            style="width: 100%;">
    </div>


    <div class="form-group mb-4">
        <label for="avatar" class="font-weight-medium">Foto Profil</label>
        <div style="max-width: 100%;">
            <div class="custom-file mb-2 w-100">
                <input type="file" name="avatar" class="custom-file-input" id="avatar" accept="image/*">
                <label class="custom-file-label" for="avatar">Pilih file</label>
            </div>
            @if(isset($customer) && $customer->avatar)
                <img src="{{ asset($customer->avatar) }}" alt="Current Avatar"
                    style="width: 72px; height: 72px; border-radius: 50%; object-fit: cover; box-shadow: 0 2px 12px rgba(0,0,0,0.10); border: 2px solid #f1f1f1; background: #fff; margin-top: 8px;">
            @endif
        </div>
    </div>
    <button type="submit" class="btn btn-primary mr-2">Ajukan</button>
    <button class="btn btn-light">Batal</button>
</form>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var input = document.querySelector('.custom-file-input');
            if (input) {
                input.addEventListener('change', function (e) {
                    var fileName = document.getElementById('avatar').files[0]?.name || 'Pilih file';
                    var nextSibling = e.target.nextElementSibling;
                    nextSibling.innerText = fileName;
                });
            }
        });
    </script>
@endpush
<style>
    .custom-file-label {
        height: 37px;
        line-height: 37px;
        padding-top: 0;
        padding-bottom: 0;
    }
</style>