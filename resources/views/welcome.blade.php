@extends('layouts.app')

@section('content')

    <div id="msgSuccess" class="alert alert-success"></div>
    <div id="msgErrors" class="alert alert-danger"></div>

    <form id="msgForm">
        @csrf

        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name" value="">
        </div>

        <div class="form-group">
            <textarea class="form-control" rows="5" name="msg" placeholder="Message"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Send</button>
    </form>

@endsection


@section('script')
<script>

    $('#msgSuccess').hide()
    $('#msgErrors').hide()

    $('#msgForm').submit(function(e) {
        e.preventDefault() //dah 3shan awa2f el default bet3 el action wel method

        $('#msgSuccess').hide()
        $('#msgErrors').hide()
        $('#msgErrors').empty()

        //3shan akhod el data mn el form b create object mn class el FormData w bb3tlo fel constract id el form w hia btcreate array mn gowa fa ba2olo of zero
        let msgData = new FormData($('#msgForm')[0])

        //console.log(msgData);
        //console.log(msgData.get('name'));
        //console.log(msgData.get('msg'));

        $.ajax({
            type: "POST",
            url: "{{ route('message.send') }}",
            data: msgData,
            contentType: false,
            processData: false,

            success:function(data)
            {
                //console.log(data.success);
                $('#msgSuccess').show()
                $('#msgSuccess').text(data.success);
            },
            error: function (xhr, status, error)
            {
                $('#msgErrors').show()
                $.each(xhr.responseJSON.errors, function (key, item)
                {
                    $('#msgErrors').append("<p class='mb-0'>" + item + "</p>")
                })
            }
        })
    })
</script>


@endsection
