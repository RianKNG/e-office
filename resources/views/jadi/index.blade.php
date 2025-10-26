@extends('layout.v_template')
@section('title','Disposisi')
@section('bawah','Kelola Disposisi Surat Masuk')
@section('content')
<!-- Button trigger modal -->

<h5>Contoh Form Horizontal</h5>
<form>
	<div class="form-group row">
		<label for="nama" class="col-sm-2 col-form-label">Nama</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="nama" placeholder="Nama">
		</div>
	</div>
 
	<div class="form-group row">
		<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="alamat" placeholder="Alamat">
		</div>
	</div>
 
	<button type="submit" class="btn btn-primary">Tombol</button>
</form>
@endsection