@extends('user.layouts.app')

@section('title', 'Home')
{{-- @section('styles') --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" /> --}}
{{-- @endsection --}}
@section('styles')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <style>
        .ui-auticomplete {
            width: 440px !important;
            z-index: 99999999999999999999999999999999999;
        }
    </style>

    <style>
        #chat-circle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #5a5eb9;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            color: white !important;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 3px 16px rgba(0, 0, 0, 0.6),
                0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px rgba(0, 0, 0, 0.12);
        }

        .btn#my-btn {
            background: white;
            padding: 13px 40px;
            border-radius: 45px;
            color: #5865c3;
        }

        #chat-overlay {
            background: rgba(255, 255, 255, 0.1);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            display: none;
        }

        .chat-box {
            display: none;
            background: #fff;
            position: fixed;
            right: 20px;
            bottom: 80px;
            width: 400px;
            max-width: 90vw;
            max-height: 86vh;
            border-radius: 10px;
            box-shadow: 0 5px 35px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            z-index: 999999;
            flex-direction: column;
        }

        .chat-box-toggle {
            float: right;
            margin-right: 15px;
            cursor: pointer;
        }

        .chat-box-header {
            background: #8F3BEB;
            height: 90px;
            color: white !important;
            text-align: center;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 15px;
        }

        .chat-box-body {
            position: relative;
            /* height: calc(100% - 110px); */
            height: 500px;
            padding-bottom: 25px;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            overflow: hidden;
        }

        .chat-logs {
            padding: 15px;
            height: 100%;
            overflow-y: auto;
        }

        .chat-logs::-webkit-scrollbar {
            width: 10px;
        }

        .chat-logs::-webkit-scrollbar-thumb {
            border-radius: 5px;
            background: rgba(0, 0, 0, 0.1);
        }

        .chat {
            display: flex;
            justify-content: flex-end;
            /* Align messages to the right */
            margin-bottom: 10px;
        }

        .chat .user-photo {
            width: 40px;
            height: 40px;
            background: #ccc;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .chat .user-photo img {
            width: 100%;
        }

        .chat .chat-message {
            max-width: 80%;
            padding: 10px;
            margin: 0 10px;
            background: #8F3BEB;
            border-radius: 10px;
            color: black !important;
            font-size: 14px;
            cursor: pointer;
            /* Make message clickable */
        }

        .chat .chat-message p {
            margin: 0;
        }

        .chat.bubble .chat-message {
            /* background: #dddbdf; */
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: black !important;
        }

        .chat-form {
            padding: 10px;
            display: flex;
            align-items: center;
        }

        .chat-form textarea {
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 3px;
            padding: 10px;
            font-size: 14px;
            resize: none;
            outline: none;
            height: 20px;
        }

        .chat-form textarea::placeholder {
            color: #ccc !important;
        }

        .chat-form button {
            background: #8F3BEB;
            padding: 0 15px;
            border: none;
            color: white !important;
            font-size: 16px;
            cursor: pointer;
            border-radius: 3px;
            margin-left: 10px;
            height: 40px;
        }

        .chat-form button:hover {
            background: #8F3BEB;
        }

        .chat-form button:focus {
            outline: none;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .tag {
            /* background-color: #ccc; */
            border: 2px solid #8F3BEB;
            color: #8F3BEB;
            padding: 5px 10px;
            margin-right: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

    <div class="">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <!-- <div class="col-lg-7 col-md-7">
                                                                          <div class="inner-title">
                                                                            <h3>FAQ</h3>
                                                                            <ul>
                                                                              <li>
                                                                                <a href="index.html">Home</a>
                                                                              </li>
                                                                              <li>FAQ</li>
                                                                            </ul>
                                                                          </div>
                                                                        </div> -->
                <div class="col-lg-4 col-md-5 mx-auto">
                    <div class="inner-img">
                        <img src="assets/images/faq.png" alt="Inner Banner" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="inner-banner">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7 col-md-7">
                    <div class="inner-title">
                        <h3>FAQ</h3>
                        <ul>
                            <li>
                                <a href="/">Home</a>
                            </li>
                            <li>FAQ</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="inner-img">
                        <img src="assets/images/faq.png" alt="Inner Banner" />
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="faq-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                @foreach ($faqs->chunk(ceil($faqs->count() / 2)) as $chunk)
                    <div class="col-lg-6">
                        <div class="faq-accordion">
                            <ul class="accordion">
                                @foreach ($chunk as $faq)
                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class="ri-add-fill"></i> {{ $faq->question ?? '' }} </a>
                                        <div class="accordion-content">
                                            {!! $faq->answer ?? '' !!} <!-- Display FAQ answer with preserved line breaks -->
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div id="chat-circle" class="btn btn-raised">
        <div id="chat-overlay"></div>
        <i class="material-icons">chat</i>
    </div>
    <div class="chat-box">
        <div class="chat-box-header">
            Kimih Bot
            <span class="chat-box-toggle"><i class="material-icons">close</i></span>
        </div>
        <div class="chat-box-body">
            <div class="chat-logs">
                <div class="chat bubble">
                    {{-- <div class="user-photo bot-photo">
                        <img src="https://via.placeholder.com/40" alt="bot-photo" />
                    </div> --}}
                    <div class="chat-message text-white" style="color: white !important;">
                        <p class="text-dark">Hello! How can I assist you today?</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="tags p-2">
            @foreach ($botFaqs as $data)
                <div class="tag" data-message="{{ $data ?? '' }}">{{ $data ?? '' }}</div>
            @endforeach
        </div>
        <div class="chat-form">
            <textarea class="form-control" id="chat-input" placeholder="Type a message" rows="8"></textarea>
            <button id="chat-submit"><i class="material-icons">send</i></button>
        </div>
    </div>

@endsection

@section('scripts')

    {{-- <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/667ac27aeaf3bd8d4d143a9a/1i17ofbld';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script> --}}

    {{-- <script>
        (function() {
            var chatCircle = document.getElementById("chat-circle");
            var messAnswer;

            var chatBox = document.querySelector(".chat-box");
            var chatBoxToggle = document.querySelector(".chat-box-toggle");
            var chatSubmit = document.getElementById("chat-submit");
            var chatInput = document.getElementById("chat-input");
            var chatLogs = document.querySelector(".chat-logs");
            var botMessages = [
                "Hello! How can I assist you today?",
                "I am here to help you. Please ask me anything.",
                "What can I do for you? any thing?",
                "Is there anything specific you need assistance with?",
                "Feel free to ask me any questions you have.",
            ];

            chatCircle.addEventListener("click", function() {
                chatBox.style.display = "flex";
            });

            chatBoxToggle.addEventListener("click", function() {
                chatBox.style.display = "none";
            });

            chatSubmit.addEventListener("click", function() {
                sendMessage();
            });

            chatInput.addEventListener("keydown", function(e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                    sendMessage();
                }
            });

            // Event delegation for dynamically added tags
            document
                .querySelector(".tags")
                .addEventListener("click", function(event) {
                    var target = event.target;
                    if (target.classList.contains("tag")) {
                        var messageText = target.getAttribute("data-message");
                        addUserMessage(messageText);
                        scrollToBottom();
                        setTimeout(function() {
                            addBotMessage();
                            scrollToBottom();
                        }, 1000);
                    }
                });

            function sendMessage() {
                var userMessage = chatInput.value.trim();
                if (userMessage === "") {
                    return;
                }
                addUserMessage(userMessage);
                chatInput.value = "";
                scrollToBottom();
                setTimeout(function() {
                    addBotMessage();
                    scrollToBottom();
                }, 1000);
            }

            // function addUserMessage(message) {
            //     var chatBubble = document.createElement("div");
            //     chatBubble.classList.add("chat", "bubble", "user-message");
            //     var userPhoto = document.createElement("div");
            //     userPhoto.classList.add("user-photo");
            //     userPhoto.innerHTML =
            //         '<img src="https://via.placeholder.com/40" alt="user-photo">';
            //     var chatMessage = document.createElement("div");
            //     chatMessage.classList.add("chat-message");
            //     chatMessage.innerHTML = "<p>" + message + "</p>";
            //     chatBubble.appendChild(userPhoto);
            //     chatBubble.appendChild(chatMessage);
            //     chatLogs.appendChild(chatBubble);
            // }

            function addUserMessage(message) {
                var chatBubble = document.createElement("div");
                chatBubble.classList.add("chat", "bubble", "user-message");
                var userPhoto = document.createElement("div");
                userPhoto.classList.add("user-photo");
                userPhoto.innerHTML =
                    '<img src="https://via.placeholder.com/40" alt="user-photo">';
                var chatMessage = document.createElement("div");

                // AJAX call to send the message to the server and get the response using jQuery
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/get-answer',
                    type: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: JSON.stringify({
                        message: message
                    }),
                    success: function(data) {
                        messAnswer = data
                            .answer; // Assuming the server returns an object with an 'answer' property
                        console.log(messAnswer.answer); // Do something with the response

                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });

                chatMessage.classList.add("chat-message");
                chatMessage.innerHTML = "<p>" + message + "</p>";
                // chatBubble.appendChild(userPhoto);
                chatBubble.appendChild(chatMessage);
                chatLogs.appendChild(chatBubble);

            }

            function addBotMessage() {
                var randomMessage =
                    botMessages[Math.floor(Math.random() * botMessages.length)];
                var chatBubble = document.createElement("div");
                chatBubble.classList.add("chat", "bubble");
                var botPhoto = document.createElement("div");
                botPhoto.classList.add("user-photo", "bot-photo");
                botPhoto.innerHTML =
                    '<img src="https://via.placeholder.com/40" alt="bot-photo">';
                var chatMessage = document.createElement("div");
                chatMessage.classList.add("chat-message");
                chatMessage.classList.add("bg-success");
                chatMessage.classList.add("text-white");
                chatMessage.innerHTML = "<p class='text-white'>" + messAnswer.answer + "</p>";
                // chatBubble.appendChild(botPhoto);
                chatBubble.appendChild(chatMessage);
                chatLogs.appendChild(chatBubble);
            }

            function scrollToBottom() {
                chatLogs.scrollTop = chatLogs.scrollHeight;
            }
        })();
    </script> --}}


    <script>
        $(document).ready(function() {
            var chatCircle = $("#chat-circle");
            var chatBox = $(".chat-box");
            var chatBoxToggle = $(".chat-box-toggle");
            var chatSubmit = $("#chat-submit");
            var chatInput = $("#chat-input");
            var chatLogs = $(".chat-logs");
            var botMessages = [
                "Hello! How can I assist you today?",
                "I am here to help you. Please ask me anything.",
                "What can I do for you? Any thing?",
                "Is there anything specific you need assistance with?",
                "Feel free to ask me any questions you have.",
            ];
            var messAnswer;

            chatCircle.on("click", function() {
                chatBox.css("display", "flex");
            });

            chatBoxToggle.on("click", function() {
                chatBox.css("display", "none");
            });

            chatSubmit.on("click", function() {
                sendMessage();
            });

            chatInput.on("keydown", function(e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                    sendMessage();
                }
            });

            $(".tags").on("click", function(event) {
                var target = $(event.target);
                if (target.hasClass("tag")) {
                    var messageText = target.data("message");
                    addUserMessage(messageText);
                    scrollToBottom();
                    setTimeout(function() {
                        addBotMessage();
                        scrollToBottom();
                    }, 1000);
                }
            });

            function sendMessage() {
                var userMessage = chatInput.val().trim();
                if (userMessage === "") {
                    return;
                }
                addUserMessage(userMessage);
                chatInput.val("");
                scrollToBottom();
                setTimeout(function() {
                    addBotMessage();
                    scrollToBottom();
                }, 1000);
            }

            function addUserMessage(message) {
                var chatBubble = $("<div>").addClass("chat bubble user-message");
                var userPhoto = $("<div>").addClass("user-photo").html(
                    '<img src="https://via.placeholder.com/40" alt="user-photo">');
                var chatMessage = $("<div>").addClass("chat-message");
                // chatMessage.addClass("text-white");

                let textColor = 'text-dark';
                // AJAX call to send the message to the server and get the response using jQuery
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/get-answer',
                    type: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: JSON.stringify({
                        message: message
                    }),
                    success: function(data) {
                        // if (messAnswer.color)
                        //     textColor = 'text-white'
                        messAnswer = data
                            .answer; // Assuming the server returns an object with an 'answer' property
                        console.log(messAnswer);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });

                chatMessage.html("<p class='text-dark'>" + message + "</p>");
                // chatBubble.append(userPhoto);
                chatBubble.append(chatMessage);
                chatLogs.append(chatBubble);
            }

            function addBotMessage() {
                var randomMessage = botMessages[Math.floor(Math.random() * botMessages.length)];
                var chatBubble = $("<div>").addClass("chat bubble");
                var botPhoto = $("<div>").addClass("user-photo bot-photo").html(
                    '<img src="https://via.placeholder.com/40" alt="bot-photo">');
                var chatMessage = $("<div>").addClass("chat-message text-white").html(
                    "<p class='text-white'>" + messAnswer.answer + "</p>").css({
                    "background-color": "#8F3BEB",
                });
                // chatBubble.append(botPhoto);
                chatBubble.append(chatMessage);
                chatLogs.append(chatBubble);
            }

            function scrollToBottom() {
                chatLogs.scrollTop(chatLogs[0].scrollHeight);
            }
        });
    </script>



@endsection
