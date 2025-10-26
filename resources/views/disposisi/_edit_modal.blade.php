<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="forn-group">
              <label for="">Kode</label>
              <input type="text" class="form-control" id="kode" placeholde="masukan Kode Wilayah">
              <span class="text-danger" id="kodeError"></span>
          </div>
          <div class="forn-group">
            <label for="">Wilayah</label>
            <input type="text" class="form-control" id="nama_wilayah" placeholde="masukan nama Wilayah">
            <span class="text-danger" id="nama_wilayahError"></span>
          </div>
          <div class="forn-group">
            <label for="">Cabang</label>
            <input type="text" class="form-control" id="cabang" placeholde="masukan nama Cabang">
            <span class="text-danger" id="cabangError"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="addButton" onclick="addData()" class="btn btn-secondary" data-dismiss="modal">Add</button>
          <button type="button" id="updateButton" class="btn btn-primary">Update</button>
        </div>
      </div>
    </div>
  </div>
  