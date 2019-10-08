@extends('akademik.akademik_view')

@section('judul_header')
	Buat SK Skripsi
@endsection

@section('content')
	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama Mahasiswa</th>
                  <th>Nim</th>
                  <th>Jurusan</th>
                  <th>Judul</th>
                  <th>Dosen Pembimbing I</th>
                  <th>Dosen Pembimbing II</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td><span id="nama-1" contenteditable></span></td>
                  <td><span id="nim-1" contenteditable></span></td>
                  <td><span id="jurusan-1" contenteditable></span></td>
                  <td><span id="judul-1" contenteditable></span></td>
                  <td>
                      <span id="pembimbing-1-1" contenteditable></span>
                  </td>
                  <td><span id="pembimbing-2-1" contenteditable></span>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-xs-9"></div>
        <div class="col-xs-3">
            <div class="text-align-right">
                <a class="btn btn-primary">Tambah Mahasiswa</a>
                <a class="btn btn-primary">Buat SK Skripsi</a>
            </div>
        </div>
        <!-- /.col -->
      </div>
      <script type="text/javascript">
   
    // $("form").submit(function(e){
    //     e.preventDefault();
    //     var name = $("input[name='name']").val();
    //     var email = $("input[name='email']").val();
     
    //     $(".data-table tbody").append("<tr data-name='"+name+"' data-email='"+email+"'><td>"+name+"</td><td>"+email+"</td><td><button class='btn btn-info btn-xs btn-edit'>Edit</button><button class='btn btn-danger btn-xs btn-delete'>Delete</button></td></tr>");
    
    //     $("input[name='name']").val('');
    //     $("input[name='email']").val('');
    // });
   
    // $("body").on("click", ".btn-delete", function(){
    //     $(this).parents("tr").remove();
    // });
    
    // $("body").on("click", ".btn-edit", function(){
    //     var name = $(this).parents("tr").attr('data-name');
    //     var email = $(this).parents("tr").attr('data-email');
    
    //     $(this).parents("tr").find("td:eq(0)").html('<input name="edit_name" value="'+name+'">');
    //     $(this).parents("tr").find("td:eq(1)").html('<input name="edit_email" value="'+email+'">');
    
    //     $(this).parents("tr").find("td:eq(2)").prepend("<button class='btn btn-info btn-xs btn-update'>Update</button><button class='btn btn-warning btn-xs btn-cancel'>Cancel</button>")
    //     $(this).hide();
    // });
   
    // $("body").on("click", ".btn-cancel", function(){
    //     var name = $(this).parents("tr").attr('data-name');
    //     var email = $(this).parents("tr").attr('data-email');
    
    //     $(this).parents("tr").find("td:eq(0)").text(name);
    //     $(this).parents("tr").find("td:eq(1)").text(email);
   
    //     $(this).parents("tr").find(".btn-edit").show();
    //     $(this).parents("tr").find(".btn-update").remove();
    //     $(this).parents("tr").find(".btn-cancel").remove();
    // });
   
    // $("body").on("click", ".btn-update", function(){
    //     var name = $(this).parents("tr").find("input[name='edit_name']").val();
    //     var email = $(this).parents("tr").find("input[name='edit_email']").val();
    
    //     $(this).parents("tr").find("td:eq(0)").text(name);
    //     $(this).parents("tr").find("td:eq(1)").text(email);
     
    //     $(this).parents("tr").attr('data-name', name);
    //     $(this).parents("tr").attr('data-email', email);
    
    //     $(this).parents("tr").find(".btn-edit").show();
    //     $(this).parents("tr").find(".btn-cancel").remove();
    //     $(this).parents("tr").find(".btn-update").remove();
    // });
    
</script>
@endsection