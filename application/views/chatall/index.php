<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
var from = null,
    start = 0,
    url = 'http://localhost/myvoqu/Chat/chat.php';
$(document).ready(function() {
    from = "Anon"
    load();
    $('form').submit(function(e) {
        $.post(url, {
            message: $('#message').val(),
            from: from
        });
        $('#message').val('');
        return false;

    })
});

function load() {
    $.get(url + '?start=' + start, function(result) {
        if (result.items) {
            result.items.forEach(item => {
                start = item.id;
                $('#messages').append(renderMessage(item));
            });
            $('#messages').animate({
                scrollTop: $('#messages')[0].scrollHeight
            });

        };
        load();

    });
}

function renderMessage(item) {
    let time = new Date(item.created);
    time = `${time.getHours()}:${time.getMinutes() < 10 ? '0' :''}${time.getMinutes()}`;
    return `<div class="msg"><p>${item.from}</p>${item.message}<span>${time}</span></div>`;
}
</script>

<div id="messages"></div>
<form class="form-chat">

    <input type="text" id="message" autocomplete="off" autofocus placeholder="Tulis pesan..">
    <input type="submit" value="Kirim">

</form>

</div>

<style>
#messages {
    height: 50vh;
    overflow-x: hidden;
    padding: 10px;
    background-image: url('https://i.pinimg.com/originals/7e/13/6c/7e136c377c5dc09260b50b490ac1f9b1.jpg');
    /* background-size: ; */
}

.form-chat {
    display: flex;
}

.form-chat input {
    font-size: 1.2rem;
    padding: 10px;
    margin: 10px 5px;
    appearance: none;
    -webkit-appearance: none;
    border: 1px solid #ccc;
    border-radius: 5px;

}

#message {
    flex: 2
}

.msg {
    background-color: #dcf8c6;
    padding: 5px 10px;
    border-radius: 5px;
    margin-bottom: 8px;
    width: fit-content;
}

.msg p {
    margin: 0;
    font-weight: bold;
}

.msg span {
    font-size: 1rem;
    margin-left: 15px;
}
</style>