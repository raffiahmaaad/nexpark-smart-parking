@if(isset($user))
    <form class="forms-sample" method="POST" action="{{ route('backend.admins.update', $user->id) }}"
        enctype="multipart/form-data">
        @method('PUT')
@else
        <form class="forms-sample" method="POST" action="{{ route('backend.admins.store') }}" enctype="multipart/form-data">
    @endif
        @csrf
        <div class="form-group">
            <label for="exampleInputName1">Nama</label>
            <input type="text" name="name" value="{{ isset($user) ? $user->name : old('name') }}" class="form-control"
                id="exampleInputName1" placeholder="Masukan Nama Anda" required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail3">Alamat Email</label>
                    <input type="email" name="email" value="{{ isset($user) ? $user->email : old('email') }}"
                        class="form-control" id="exampleInputEmail3" placeholder="Masukan Alamat Email" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleSelectGender">Jenis Kelamin</label>
                    <select class="form-control" id="exampleSelectGender" name="gender" required>
                        <option value="Laki-laki" {{ (isset($user) && $user->gender == 'Laki-laki') ? 'selected' : '' }}>
                            Laki-laki</option>
                        <option value="Perempuan" {{ (isset($user) && $user->gender == 'Perempuan') ? 'selected' : '' }}>
                            Perempuan</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword4">Sandi</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword4"
                placeholder="Masukan Sandi Anda" {{ isset($user) ? '' : 'required' }}>
            @if(isset($user))
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
            @endif
        </div>

        <div class="form-group">
            <label>Unggah Foto</label>
            @if(isset($user))
                <div class="mb-2">
                    @if($user->avatar)
                        <img src="{{ asset($user->avatar) }}" alt="Current Avatar" class="img-thumbnail"
                            style="max-height: 150px; border: 2px solid #ddd;">
                        <p class="text-muted mt-1 mb-2">Foto Profil Saat Ini</p>
                    @else
                        @php
                            $colors = ['#1abc9c', '#2ecc71', '#3498db', '#9b59b6', '#34495e', '#16a085', '#27ae60', '#2980b9', '#8e44ad', '#2c3e50'];
                            $randomColor = $colors[array_rand($colors)];
                        @endphp
                        <div class="img-thumbnail"
                            style="width: 100px; height: 100px; border-radius: 5px; background-color: {{ $randomColor }}; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 40px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
            @endif
            <div class="input-group col-xs-12">
                <input type="file" name="avatar" class="file-upload-default" accept="image/*">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Unggah Foto">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
                </span>
            </div>
            <div id="preview"></div>
        </div>

        <button type="submit" class="btn btn-primary mr-2">{{ isset($user) ? 'Update' : 'Ajukan' }}</button>
        <a href="{{ route('backend.admins.index') }}" class="btn btn-light">Batal</a>
    </form>

    @push('styles')
        <style>
            #preview img {
                max-width: 200px;
                max-height: 200px;
                margin-top: 10px;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function () {
                // Fungsi untuk menangani klik tombol Unggah
                $('.file-upload-browse').on('click', function () {
                    var file = $(this).parents('.input-group').find('.file-upload-default');
                    file.trigger('click');
                });

                // Fungsi untuk menampilkan nama file yang dipilih
                $('.file-upload-default').on('change', function () {
                    var fileName = $(this).val().split('\\').pop();
                    $(this).parents('.input-group').find('.file-upload-info').val(fileName);

                    // Preview gambar
                    var preview = document.getElementById('preview');
                    preview.innerHTML = '';

                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail';
                            preview.appendChild(img);
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });
        </script>
    @endpush