<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laravel Ajax CRUD Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css)}}">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 card-header text-center font-weight-bold">
                <h2>Laravel Ajax Book CRUD Tutorial</h2>
            </div>
            <div id="message"></div>
            <div class="col-md-12 mt-1 mb-2"><button type="button" id="addNewBook" class="btn btn-success">Add</button></div>
            <div class="col-md-12">
                <table id="Table1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">#</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Book Code</th>
                            <th scope="col">Book Author</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                        <tr>
                            <td><input type="checkbox" /></td>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->code }}</td>
                            <td>{{ $book->author }}</td>
                        </tr>
                    </tbody>
                </table>
                <input id="btnGet" type="button" value="Get Selected" />
                
            </div>
        </div>
        <div><textarea id="message" rows="10" cols="100">Selection</textarea> <button type="button" id="copy">Copy</button></div>
    </div>
    <!-- boostrap model -->
    <div class="modal fade" id="ajax-book-model" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxBookModel"></h4>
                </div>
                <div class="modal-body">
                    <ul id="msgList"></ul>
                    <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" class="form-horizontal" method="POST">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Book Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Book Name" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Book Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="code" name="code" placeholder="Enter Book Code" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Book Author</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="author" name="author" placeholder="Enter author Name" value="" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-add" value="addNewBook">Save
                            </button>
                            <button type="submit" class="btn btn-primary" id="btn-save" value="UpdateBook">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- end bootstrap model -->
    <script src="{{asset('js/app.js')}}"></script>
    <!-- <script>
        $(document).ready(function($) {
            fetchBook(); // Get the table from the dB to start 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function fetchBook() {
                // ajax 
                $.ajax({
                    type: "GET",
                    url: "fetch-books",
                    dataType: 'json',
                    success: function(res) {
                        // console.log(res); 
                        $('tbody').html("");
                        $.each(res.books, function(key, item) {
                            $('tbody').append('<tr>\
                                                <td></td>\
                                                <td> ' + item.id + ' </td>\
                                                <td> ' + item.title + ' </td>\
                                                <td> ' + item.code + ' </td>\
                                                <td> ' + item.author + ' </td>\
                                                <td> <button type="button" data-id="' + item.id + '" class="btn btn-primary edit btn-sm"> Edit </button>\
                                                <button type="button" data-id="' + item.id + '" class="btn btn-danger delete btn-sm"> Delete </button></td>\
                                                </tr>');
                        });
                    },
                    complete: function() {
                        isChecked();
                    }
                });
            }
            $('#addNewBook').click(function(evt) {
                evt.preventDefault();
                $('#addEditBookForm').trigger("reset");
                $('#ajaxBookModel').html("Add Book");
                $('#btn-add').show();
                $('#btn-save').hide();
                $('#ajax-book-model').modal('show');
            });
            $('body').on('click', '#btn-add', function(event) {
                event.preventDefault();
                var title = $("#title").val();
                var code = $("#code").val();
                var author = $("#author").val();
                $("#btn-add").html('Please Wait...');
                $("#btn-add").attr("disabled", true);
                // ajax 
                $.ajax({
                    type: "POST",
                    url: "save-book",
                    data: {
                        title: title,
                        code: code,
                        author: author,
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        if (res.status == 400) {
                            $('#msgList').html("");
                            $('#msgList').addClass('alert alert-danger');
                            $.each(res.errors, function(key, err_value) {
                                $('#msgList').append('<li>' + err_value + '</li>');
                            });
                            $('#btn-save').text('Save changes');
                        } else {
                            $('#message').html("");
                            $('#message').addClass('alert alert-success');
                            $('#message').text(res.message);
                            fetchBook();
                        }
                    },
                    complete: function() {
                        $("#btn-add").html('Save');
                        $("#btn-add").attr("disabled", false);
                        $("#btn-add").hide();
                        $('#ajax-book-model').modal('hide');
                        $('#message').fadeOut(4000);
                    }
                });
            });
            $('body').on('click', '.edit', function(evt) {
                evt.preventDefault();
                var id = $(this).data('id');
                // ajax 
                $.ajax({
                    type: "GET",
                    url: "edit-book/" + id,
                    dataType: 'json',
                    success: function(res) {
                        console.dir(res);
                        $('#ajaxBookModel').html("Edit Book");
                        $('#btn-add').hide();
                        $('#btn-save').show();
                        $('#ajax-book-model').modal('show');
                        if (res.status == 404) {
                            $('#msgList').html("");
                            $('#msgList').addClass('alert alert-danger');
                            $('#msgList').text(res.message);
                        } else {
                            // console.log(res.book.xxx); 
                            $('#title').val(res.book.title);
                            $('#code').val(res.book.code);
                            $('#author').val(res.book.author);
                            $('#id').val(res.book.id);
                        }
                    }
                });
            });
            $('body').on('click', '.delete', function(evt) {
                evt.preventDefault();
                if (confirm("Delete Book?") == true) {
                    var id = $(this).data('id');
                    // ajax 
                    $.ajax({
                        type: "DELETE",
                        url: "delete-book/" + id,
                        dataType: 'json',
                        success: function(res) {
                            // console.log(res); 
                            if (res.status == 404) {
                                $('#message').addClass('alert alert-danger');
                                $('#message').text(res.message);
                            } else {
                                $('#message').html("");
                                $('#message').addClass('alert alert-success');
                                $('#message').text(res.message);
                            }
                            fetchBook();
                        }
                    });
                }
            });
            $('body').on('click', '#btn-save', function(event) {
                event.preventDefault();
                var id = $("#id").val();
                var title = $("#title").val();
                var code = $("#code").val();
                var author = $("#author").val();
                // alert("id="+id+" title=" + title); 
                $("#btn-save").html('Please Wait...');
                $("#btn-save").attr("disabled", true);
                // ajax 
                $.ajax({
                    type: "PUT",
                    url: "update-book/" + id,
                    data: {
                        title: title,
                        code: code,
                        author: author,
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        if (res.status == 400) {
                            $('#msgList').html("");
                            $('#msgList').addClass('alert alert-danger');
                            $.each(res.errors, function(key, err_value) {
                                $('#msgList').append('<li>' + err_value + '</li>');
                            });
                            $('#btn-save').text('Save changes');
                        } else {
                            $('#message').html("");
                            $('#message').addClass('alert alert-success');
                            $('#message').text(res.message);
                            fetchBook();
                        }
                    },
                    complete: function() {
                        $("#btn-save").html('Save changes');
                        $("#btn-save").attr("disabled", false);
                        $('#ajax-book-model').modal('hide');
                        $('#message').fadeOut(4000);
                    }
                });
            });
            $("#btnGet").click(function() {
                var message = "";
                //Loop through all checked CheckBoxes in GridView. 
                $("#Table1 input[type=checkbox]:checked").each(function() {
                    var row = $(this).closest("tr")[0];
                    // message += row.cells[2].innerHTML; 
                    message += " " + row.cells[3].innerHTML;
                    // message += " " + row.cells[4].innerHTML; 
                    message += "\n-----------------------\n";
                });
                //Display selected Row data in Alert Box. 
                $("#messageList").html(message);
                return false;
            });
            $("#copy").click(function() {
                $("#messageList").select();
                document.execCommand("copy");
                alert("Copied On clipboard");
            });

            function isChecked() {
                $("#Table1 input[type=checkbox]").each(function() {
                    if ($(this).val() == 1) {
                        $(this).prop("checked", true);
                    } else {
                        $(this).prop("checked", false);
                    }
                });
            }
        });
    </script> -->
</body>

</html>