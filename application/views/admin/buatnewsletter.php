<section class="home-section">
<div class="text">Newsletter</div>
<div class="container-fluid">
  <form method="post" action="<?=base_url('admin/buatNewsletter');?>" enctype="multipart/form-data">
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group row">
          <label for="subjek" class="col-sm-2 col-form-label">Subjek</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="subjek" name="subjek" placeholder="Masukkan subjek disini..">
              <?=form_error('subjek','<small class="text-danger pl-3">','</small>');?>
          </div>
        </div>
        <div class="form-group row">
          <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
          <div class="col-sm-10">            
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="gambar" name="gambar">
              <label class="custom-file-label" for="gambar">Choose File</label>
            </div>
          </div>
        </div>
        <div class="control-group after-add-more">
        <div class="form-group row">
                <label for="teks" class="col-sm-2 col-form-label">Teks</label>
                <div class="col-sm-8">
                  <textarea class="form-control" id="teks[]" name="teks[]" rows="4" placeholder="Teks paragraf disini.."><?=set_value('teks[0]')?></textarea>
                </div>
                <div class="col-sm-2">
                    <button class="add-more btn btn-primary mt-3 text-white" style="float: right;" type="button">Tambah</button>
                </div>
              </div>
            </div>
            <br><?=form_error('teks[0]','<small class="text-danger pl-1">','</small>');?>
        <div class="form-group">
          <button class="btn btn-info" type="submit">Kirim</button>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="copy invisible">
    <div class="control-group my-3">
      <div class="form-group row">
      <label for="teks" class="col-sm-2 col-form-label">Teks</label>
      <div class="col-sm-8">
        <textarea class="form-control" id="teks[]" name="teks[]" rows="4" placeholder="Teks paragraf disini.."><?=set_value('teks')?></textarea>
      </div>
      <div class="col-sm-2">
        <a class="remove btn btn-danger mt-2 text-white">Hapus</a>
      </div>
    </div>
    </div>
  </div>
</section>

