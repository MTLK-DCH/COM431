@extends('baseview')

@section('title')
Comments
@endsection

@section('css')
@endsection

@section('main')
<div class="container mt-2">
        <div class="row">
            <div class="col-md-12 card-header text-center font-weight-bold">
                <h2>Comments Bank</h2>
            </div>
            <div id="message"></div>
            <div class="col-md-12">
                    <?php
                    foreach ($categories as $kind) {
                        echo "
                        <h3 class=\"text-center\">$kind->fullname Comments</h3>
                        <table class=\"table\">
                            <thead>
                                <tr>
                                    <th scope=\"col\"></th>
                                    <th scope=\"col\">#</th>
                                    <th scope=\"col\">Comment</th>
                                    <th scope=\"col\">ID</th>
                                </tr>
                            </thead>
                            <tbody>";
                        foreach ($comments as $comment){
                            if ($comment->kind == $kind->abbr)
                            {echo " 
                                <tr>
                                    <td><input type=\"checkbox\" /></td>
                                    <td>$comment->id</td>
                                    <td>$comment->text</td>
                                    <td>$comment->comment_id</td>
                                </tr>";}
                        }
                        echo "</tbody></table>";
                    }
                    ?>
                <input id="btnGet" type="button" value="Get Selected" />

            </div>
        </div>
        <div>
            <textarea id="messageList" rows="10" cols="100">Selection</textarea> 
            <button type="button" id="copy">Copy</button>
        </div>
    </div>
@endsection

@section('js')
<script src="{{asset('js/bank.js')}}"></script>
@endsection
    