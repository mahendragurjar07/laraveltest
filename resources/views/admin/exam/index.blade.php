@extends('admin.layouts.app')
    @section('head')
    <title>Manage Exams</title>
    @endsection
@section('content')
    <main class="admin-main manageSubadmin">
    	<div class="admin_pageContent">
            
            <!-- page title -->
            <div class="adminPageTitle d-sm-flex align-items-sm-center justify-content-sm-between">
                <div class="adminPageTitle__left">
                    <h1>Manage Exams</h1>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Manage Exams</li>
                      </ol>
                    </nav>
                </div>
                <div class="adminPageTitle__right">
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm ripple-effect importExams" id="showImportModal" style="float: right;
margin-left: 13px;">Import Exams</a>
                    <a href="{{ route('admin/exam/export') }}" class="btn btn-danger btn-sm ripple-effect">Export Data</a>
                </div>

            </div>
            <div class="table-responsive commonTable bg-white">
                <table class="table" id="examList">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Exam Title</th>
                            <th>No of Questions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
    	</div>
    </main>

    <!-- Import Exam Model -->
    <div class="modal fade addLanguage importExamModal" data-backdrop="static" id="importExamModal" tabindex="-1" role="dialog" aria-labelledby="addTeamLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addTeamLabel">Import Exams</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i class="icon-close"></i></span>
            </button>
          </div>
          <div class="modal-body">
            <form id="import-exam-form">
                <div class="input-group form-group">
                    <div class="">
                        <input type="file" class="custom-file-input form-control" id="inputGroupFile02"  name="file" aria-describedby="inputGroupFileAddon02" accept=".xlsx" required="">
                        <label class="custom-file-label form-control" for="inputGroupFile02">Choose Excel File</label>                        
                    </div>
                    <br/>
                    <div class="error-help-block text-danger"></div>
                </div>

                <button type="submit" id="submitBtn" class="btn btn-danger btn-lg ripple-effect w-100 btn-add-exam">Import<span class="spinner-border" role="status" style="display:none"></span></button>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
@section('js')
<script>
    function listExam() {
        $('#examList').DataTable({ 
            pageLength: 10,
            order: [
                [0, "desc"]
            ],
            processing: true,
            bFilter: false,
            lengthChange: false,
            bInfo: false,
            language: {
                processing: '<div class="listloader text-center"><span class="spinner-border" role="status"></span></div>',
                emptyTable: 'No record found.'
            },
            serverSide: true,
            ajax: {
                url: "{{ route('admin/getExamList') }}",
                type: "GET",
                data: function(d) {
                    d.name = $('#searchKey').val();
                    currentPage = d.start 
                }
            },
            columns: [
                {
                    data: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'title',
                    name: 'Exam Title'
                },
                {
                    data: 'questions',
                    name: 'No of Question'
                }
            ]
        });
    }
    listExam();

    $('#showImportModal').click(function(event) {
        $('#importExamModal').modal('show');
    });

    $(document).on('click','.btn-add-exam',function(e){
        e.preventDefault();
        var button = $(this);
        button.attr('disabled', true);
        button.find('span').show();

        var form = $("#import-exam-form").get(0);
        var datas = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{ route('admin/exam/import') }}",
            data: datas,
            processData: false,
            contentType: false,
            success: function(data) {
                button.attr('disabled', false);
                button.find('span').hide();
                if (data.success) {
                    _toast.success(data.message);
                    $('#import-exam-form').trigger('reset');
                    $('#importExamModal').modal('hide');
                    $('#examList').DataTable().ajax.reload(null, false);                   
                }
            },
            error: function(data) {
                button.attr('disabled', false);
                button.find('span').hide();
               if (data.status === 422) {
                    var obj = data.responseJSON;
                    for (var x in obj.errors) {
                        $('#import-exam-form [name=' + x + ']')
                            .closest('.form-group')
                            .find('.error-help-block')
                            .html(obj.errors[x].join('<br>'));
                      
                            if(x=="menus"){
                                $(".error-help-block-"+x).html(obj.errors[x].join('<br>'));
                            }
                    }
                } else if (data.status === 400) {
                    _toast.error(data.message);
                }
            }
        });
    });
</script>
@endsection