<!DOCTYPE html>
<html>
<head>
    <title>Edit Aspirasi</title>
</head>
<body>
    <h2>Edit Data Aspirasi</h2>
    
    <form method="POST" action="{{ route('aspirasi.update', $data->id) }}">
        @csrf
        @method('PUT')
        
        <label>Kategori</label><br>
        <select name="kategori_id" required>
            @foreach($kategori as $k)
                <option value="{{ $k->id }}" {{ $data->kategori_id == $k->id ? 'selected' : '' }}>
                    {{ $k->ket_kategori }}
                </option>
            @endforeach
        </select><br><br>
        
        <label>Lokasi</label><br>
        <input type="text" name="lokasi" value="{{ $data->lokasi }}" required><br><br>
        
        <label>Keterangan / Keluhan</label><br>
        <textarea name="keterangan" rows="4" cols="30" required>{{ $data->keterangan }}</textarea><br><br>
        
        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('aspirasi.index') }}">
            <button type="button">Batal</button>
        </a>
    </form>
</body>
</html>
