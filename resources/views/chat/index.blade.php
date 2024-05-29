@extends('layouts.index')
@section('css')
@endsection
@section('content')
<!--begin::Layout-->
<div class="d-flex flex-column flex-lg-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
        <!--begin::Contacts-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Form-->
                <form class="w-100 position-relative" autocomplete="off">
                    <!--begin::Icon-->
                    <i class="ki-outline ki-magnifier fs-3 text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></i>
                    <!--end::Icon-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid px-13" name="search" value="" placeholder="Search by username or email........." />
                    <!--end::Input-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5" id="kt_chat_contacts_body">
                <!--begin::List-->
                <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px">
                    <!--begin::Separator-->
                    {{-- <div class="separator separator-dashed d-none"></div> --}}
                    <!--end::Separator-->
                    <!--begin::User-->
                    {{-- <div class="d-flex flex-stack py-4"> --}}
                        <!--begin::Input group-->
                        {{-- <div class="input-group mb-5">
                            <input type="text" name="room_id" id="room_id" class="form-control" placeholder="Identitas ID" aria-describedby="btn-join"/>
                            <button class="btn btn-primary btn-sm" id="btn-join">Join</button>
                        </div> --}}
                        <!--end::Input group-->
                    {{-- </div> --}}
                    <!--end::User-->
                    <!--begin::Separator-->
                    {{-- <div class="separator separator-dashed d-none"></div> --}}
                    <!--end::Separator-->
                    <!--begin::User-->
                    {{-- <div class="d-flex flex-stack py-4"> --}}
                        {{-- <input type="text" name="sender_id" id="sender_id" class="form-control" placeholder="ID Penerima"> --}}
                    {{-- </div> --}}
                    <!--end::User-->
                    <input type="hidden" name="room_id" id="room_id">
                    <input type="hidden" name="sender_id" id="sender_id">
                    @foreach ($users as $user)
                        <!--begin::Separator-->
                        <div class="separator separator-dashed d-none"></div>
                        <!--end::Separator-->
                        <!--begin::User-->
                        <div class="d-flex flex-stack py-4">
                            <!--begin::Details-->
                            <div class="d-flex align-items-center">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-45px symbol-circle">
                                    @if ($user->foto != '')
                                        <img alt="Pic" src="{{ asset('storage/users/images/'. $user->foto) }}">
                                    @else
                                        <img alt="Pic" src="{{ asset('assets/media/avatars/blank.png') }}">
                                    @endif
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Details-->
                                <div class="ms-5">
                                    <a href="#" onclick="tampilChat({{ $user->id }}, '{{ $user->name }}')" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">{{ $user->name }}</a>
                                    <div class="fw-semibold text-muted">{{ $user->email }}</div>
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Details-->
                            <!--begin::Lat seen-->
                            <div class="d-flex flex-column align-items-end ms-2">
                                {{-- <span class="text-muted fs-7 mb-1">2 weeks</span> --}}
                                <span class="badge badge-sm badge-circle badge-light-warning">{{ $user->unreadChat->count() }}</span>
                            </div>
                            <!--end::Lat seen-->
                        </div>
                        <!--end::User-->
                    @endforeach

                </div>
                <!--end::List-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Contacts-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
        <!--begin::Messenger-->
        <div class="card" id="kt_chat_messenger">
            <!--begin::Card header-->
            <div class="card-header" id="kt_chat_messenger_header">
                <!--begin::Title-->
                <div class="card-title">
                    <!--begin::User-->
                    <div class="d-flex justify-content-center flex-column me-3">
                        <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1" id="judul-chat"></a>
                        <!--begin::Info-->
                        <div class="mb-0 lh-1">
                            {{-- <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                            <span class="fs-7 fw-semibold text-muted">Active</span> --}}
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body" id="kt_chat_messenger_body">
                <!--begin::Messages-->
                <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto chat-box" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body" data-kt-scroll-offset="5px">
                    <!--begin::Message(in)-->
                    {{-- <div class="d-flex justify-content-start mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column align-items-start">
                            <!--begin::User-->
                            <div class="d-flex align-items-center mb-2">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-35px symbol-circle">
                                    <img alt="Pic" src="{{ asset('assets/media/avatars/300-25.jpg') }}" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Details-->
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::User-->
                            <!--begin::Text-->
                            <div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">Test</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Wrapper-->
                    </div> --}}
                    <!--end::Message(in)-->
                    <!--begin::Message(out)-->
                    {{-- <div class="d-flex justify-content-end mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column align-items-end">
                            <!--begin::User-->
                            <div class="d-flex align-items-center mb-2">
                                <!--begin::Details-->
                                <div class="me-3">
                                    <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
                                </div>
                                <!--end::Details-->
                                <!--begin::Avatar-->
                                <div class="symbol symbol-35px symbol-circle">
                                    <img alt="Pic" src="{{ asset('assets/media/avatars/300-1.jpg') }}" />
                                </div>
                                <!--end::Avatar-->
                            </div>
                            <!--end::User-->
                            <!--begin::Text-->
                            <div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-400px text-end" data-kt-element="message-text">Testing</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Wrapper-->
                    </div> --}}
                    <!--end::Message(out)-->
                </div>
                <!--end::Messages-->
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->
            <div class="card-footer pt-4 d-none" id="kt_chat_messenger_footer">
                <!--begin::Input-->
                <textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input" placeholder="Type a message" id="chatInput"></textarea>
                <!--end::Input-->
                <!--begin:Toolbar-->
                <div class="d-flex flex-stack">
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center me-2">
                    </div>
                    <!--end::Actions-->
                    <!--begin::Send-->
                    <button id="btn-send" class="btn btn-primary" type="button" data-kt-element="send">Send</button>
                    <!--end::Send-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card footer-->
        </div>
        <!--end::Messenger-->
    </div>
    <!--end::Content-->
</div>
<!--end::Layout-->
@endsection
@section('js')
<script>
    //blockui
    var target = document.querySelector("#kt_chat_messenger");
    var chat_block = new KTBlockUI(target);

    $(function() {

        $("#btn-join").on( "click", function() {
            let room_id = $('#room_id').val();
            socket.emit('joinRoom', room_id);
        });

        $("#btn-send").on( "click", function(e) {
            let msg = $('#chatInput').val();

            if(msg === null){
                alert('Pesan Tidak Boleh Kosong');
                return true;
            }

            if(msg == ""){
                alert('Pesan Tidak Boleh Kosong');
                return true;
            }

            var message = {
                room_id: 'room-' + $('#room_id').val(),
                penerima_id: $('#sender_id').val(),
                msg: msg
            }
            socket.emit('sendChatToServer', message);

            $('#chatInput').val('');
            var msgOut = '<div class="d-flex justify-content-end mb-10">'+
                        '<div class="d-flex flex-column align-items-end">'+
                            '<div class="d-flex align-items-center mb-2">'+
                                '<div class="me-3">'+
                                    '<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>'+
                                '</div>'+
                            '</div>'+
                            '<div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-400px text-end" data-kt-element="message-text">' + msg +'</div>'+
                        '</div>'+
                    '</div>';
            $('.chat-box').append(msgOut);

            //insert to db
            $.ajax({
                method: "GET",
                url: "{{ route('chat.kirim-pesan') }}",
                data: { data: message }
            })
            .done(function(val) {
                console.log(val.message);
            });
        });

        socket.on('sendChatToClient', (message) => {

            var nama_pengirim = $('#judul-chat').text();

            var msgIn = '<div class="d-flex justify-content-start mb-10">'+
                            '<div class="d-flex flex-column align-items-start">'+
                                '<div class="d-flex align-items-center mb-2">'+
                                    '<div class="me-3">'+
                                        '<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">'+ nama_pengirim +'</a>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">' + message.msg +'</div>'+
                            '</div>'+
                        '</div>';

            var id_user = '{{ Auth::user()->id }}';

            if(id_user == message.penerima_id){
                $('.chat-box').append(msgIn);
            }
        });
    });

    function tampilChat(id_penerima, nama_user){
        //setting tampil
        $('.chat-box').empty();
        $('#kt_chat_messenger_footer').addClass('d-none');
        $('#judul-chat').text(nama_user);
        $('#kt_chat_messenger_footer').removeClass('d-none');

        var id_pengirim = '{{ Auth::user()->id }}';

        //setting room_id
        $.ajax({
            method: "GET",
            url: "{{ route('room.cek') }}",
            data: { id_pengirim: id_pengirim, id_penerima: id_penerima },
            beforeSend: function() {
                chat_block.block();
            },
        })
        .done(function(val) {
            chat_block.release();

            //join room
            socket.emit('joinRoom', 'room-' + val.room_id);
            $('#room_id').val(val.room_id);

            //Tampil Chat
            $('.chat-box').append(val.pesan);
        });

        // setting id penerima
        $('#sender_id').val(id_penerima);
    }
</script>
@endsection
