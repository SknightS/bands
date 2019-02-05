<form method="post" action="{{route('client.update',['id'=>$client->clientId])}}">
    {{csrf_field()}}
    <div class="row">
        <div class="form-group col-md-12">
            <label>Client Name</label>
            <input type="text" name="clientName" placeholder="First Name" class="form-control" value="{{$client->clientName}}" >
        </div>
        <div class="form-group col-md-12">
            <label>email</label>
            <input type="email" name="email" placeholder="Email" class="form-control" value="{{$client->email}}" >
        </div>
        <div class="form-group col-md-12">
            <label>phone</label>
            <input type="text" name="phone" placeholder="phone" class="form-control" value="{{$client->phone}}" >
        </div>
        <div class="form-group col-md-12">
            <label>address</label>
            <input type="text" name="address"  placeholder="address" class="form-control" value="{{$client->address}}" >
        </div>
        <div class="form-group col-md-12">
            <label>Company</label>
            <input type="text" name="company" placeholder="ip" class="form-control" value="{{$client->company}}" >
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-success pull-right">submit</button>
        </div>

    </div>
</form>
<script>
    function getpackage() {
        var id=document.getElementById('packageedit').value;


        $.ajax({
            type: 'POST',
            url: "{!! route('package.getpackage') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}",'id': id},
            success: function (data) {
                // $("#editModalBody").html(data);
                // $('#editModal').modal();
                // console.log(data);
                //   $('bandwidth').val(data.bandwidth);
                //  $('price').val(data.price);

                document.getElementById('bandwidthedit').value = data.bandwidth;
                document.getElementById('priceedit').value = data.price;

            }
        });
    }
</script>